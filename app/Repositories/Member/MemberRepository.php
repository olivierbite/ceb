<?php namespace Ceb\Repositories\Member;

use Cartalyst\Sentry\Sentry;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Ceb\Models\User;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Sentinel\DataTransferObjects\BaseResponse;
use Sentinel\DataTransferObjects\ExceptionResponse;
use Sentinel\DataTransferObjects\FailureResponse;
use Sentinel\DataTransferObjects\SuccessResponse;

class MemberRepository implements MemberRepositoryInterface {
	protected $dispatcher;
	protected $user;
	protected $config;
	protected $sentry;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(Sentry $sentry, Repository $config, Dispatcher $dispatcher, User $user) {
		$this->dispatcher = $dispatcher;
		$this->user = $user;
		$this->config = $config;
		$this->sentry = $sentry;

	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return BaseResponse
	 */
	public function store($data) {
		try {
			// Get the unique adhersion number for this member
			$countUsers = $this->user->count() + 1;

			// Format the number to  something like "00001"
			$newAdhersionNumber = date('Y') . sprintf("%05d", $countUsers);

			//Prepare the member data
			//Make sure data passed is array
			$data = (array) $data;

			$data['adhersion_id'] = $newAdhersionNumber;
			// Setting default password
			$data['password'] = e('Test1234');

			// Extract First name and last name
			$data['first_name'] = trim(substr($data['names'], 0, $endOfFirstName = strpos($data['names'], ' ')));
			$data['last_name'] = trim(substr($data['names'], $endOfFirstName, strlen($data['names'])));

			// Let's make sure we are not inserting an empty column in the database;
			foreach ($data as $key => $value) {
				if (is_null($value) || empty($value) || trim($value) == '') {
					unset($data[$key]);
				}
			}

			// Attempt user registration
			$user = $this->user->create($data);

			$user = $this->sentry->getUserProvider()->findById($user->id);

			// If no group memberships were specified, use the default groups from config
			if (array_key_exists('groups', $data)) {
				$groups = $data['groups'];
			} else {
				$groups = $this->config->get('sentinel.default_user_groups', []);
			}

			// Assign groups to this user
			foreach ($groups as $name) {
				$group = $this->sentry->getGroupProvider()->findByName($name);
				$user->addGroup($group);
			}

			// User registration was successful.  Determine response message
			$message = trans('member.created');

			// Response Payload
			$payload = [
				'user' => $user,
				'activated' => 0,
			];

			// Fire the 'user registered' event
			$this->dispatcher->fire('member.registered', $payload);

			// Return a response
			return $message;
		} catch (UserExistsException $e) {
			return $message = trans('member.exists');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  array $data
	 *
	 * @return BaseResponse
	 */
	public function update($data) {
		try {
			// Find the user using the user id
			$user = $this->sentry->findUserById($data['id']);

			// Update User Details
			$user->email = (isset($data['email']) ? e($data['email']) : $user->email);
			$user->username = (isset($data['username']) ? e($data['username']) : $user->username);

			// Extract First name and last name
			$data['first_name'] = trim(substr($data['names'], 0, $endOfFirstName = strpos($data['names'], ' ')));
			$data['last_name'] = trim(substr($data['names'], $endOfFirstName, strlen($data['names'])));
			//Clean data by  Remove tocket and Method and names fields
			unset($data['_method']);
			unset($data['_token']);
			unset($data['names']);

			// Start setting new data and update them here.
			foreach ($data as $key => $value) {
				// if this field is empty go to the next one
				if (is_null($value) || empty($value) || trim($value) == '') {
					continue;
				}

				$user->$key = (isset($data[$key]) ? e($data[$key]) : $user->$key);
			}

			// Update the user
			if ($user->save()) {
				// User information was updated
				$this->dispatcher->fire('member.updated', ['user' => $user]);

				return trans('member.updated');
			}

			return new FailureResponse(trans('Sentinel::users.notupdated'), ['user' => $user]);
		} catch (UserExistsException $e) {
			return $message = trans('Sentinel::users.exists');
		} catch (UserNotFoundException $e) {
			return $message = trans('Sentinel::sessions.invalid');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return BaseResponse
	 */
	public function destroy($id) {
		try {
			// Find the user using the user id
			$user = $this->sentry->findUserById($id);

			// Delete the user
			if ($user->delete()) {
				//Fire the sentinel.user.destroyed event
				$this->dispatcher->fire('sentinel.user.destroyed', ['user' => $user]);

				return new SuccessResponse(trans('Sentinel::users.destroyed'), ['user' => $user]);
			}

			// Unable to delete the user
			return new FailureResponse(trans('Sentinel::users.notdestroyed'), ['user' => $user]);
		} catch (UserNotFoundException $e) {
			$message = trans('Sentinel::sessions.invalid');

			return new ExceptionResponse($message);
		}
	}
	/**
	 * Return the all active user
	 *
	 * @return user object
	 */
	public function all() {
		return $this->all();
	}
	/**
	 * Return the current active user
	 *
	 * @return user object
	 */
	public function getUser() {
		return $this->sentry->getUser();
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed $identifier
	 *
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveById($identifier) {
		return $this->findOrfail($identifier);
	}

}
