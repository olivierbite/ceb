<?php namespace Ceb\Repositories\Member;

use Cartalyst\Sentry\Sentry;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Ceb\Models\User;
use Ceb\Traits\FileTrait;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;
use Sentinel\DataTransferObjects\BaseResponse;
use Sentinel\DataTransferObjects\FailureResponse;
use Str;

class MemberRepository implements MemberRepositoryInterface {

	use FileTrait;

	protected $dispatcher;
	protected $user;
	protected $config;
	protected $sentry;
	protected $storage;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(Sentry $sentry, Storage $storage, Repository $config, Dispatcher $dispatcher, User $user) {
		$this->dispatcher = $dispatcher;
		$this->user = $user;
		$this->config = $config;
		$this->sentry = $sentry;
		$this->storage = $storage;

	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return BaseResponse
	 */
	public function store($formData) {
		try {
			//Prepare the member data
			//Make sure data passed is array
			$data = (array) $formData;

			// Get the unique adhersion number for this member
			$data['adhersion_id'] = $this->generateAdhersionNumber();
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

			// Trying to upload the attached images
			$filename = time() . $this->slug($data['names']) . $data['adhersion_id'];

			$data['photo'] = $this->addImage($formData['photo'], $filename . '-photo');
			$data['signature'] = $this->addImage($formData['signature'], $filename . '-signature');

			// Attempt user registration
			$userModel = $this->user->create($data);

			$user = $this->sentry->getUserProvider()->findById($userModel->id);

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

			// Trim any space
			$data['first_name'] = trim($data['first_name']);
			$data['last_name'] = trim($data['last_name']);

			//Clean data by  Remove tocket and Method and names fields
			unset($data['_method']);
			unset($data['_token']);

			// Trying to upload the attached images
			$filename = time() . $this->slug($data['names']) . $user->adhersion_id;

			$data['photo'] = isset($data['photo']) ? $this->addImage($data['photo'], $filename . '-photo') : null;
			$data['signature'] = isset($data['signature']) ? $this->addImage($data['signature'], $filename . '-signature') : null;

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

				return trans('Sentinel::users.destroyed');
			}

			// Unable to delete the user
			return trans('Sentinel::users.notdestroyed');
		} catch (UserNotFoundException $e) {
			return $message = trans('Sentinel::sessions.invalid');
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
	 * Search against member
	 * @param  string $keyword
	 * @return mixed
	 */
	public function search($keyword) {
     
     $keyword = trim($keyword);
	 $members = $this->user->where(DB::raw('trim(first_name)'), 'LIKE', '%' . $keyword . '%')
		            ->orWhere(DB::raw('trim(last_name)'), 'LIKE', '%' . $keyword . '%')
		            ->orWhere('member_nid', 'LIKE', '%' . $keyword . '%')
		            ->orWhere('adhersion_id', 'LIKE', '%' . $keyword . '%')
		            ->take(5)
		            ->get();

	return $members->transform(function($member){

			return [
					'id'	=> $member->id,
					'photo' => $member->photo,
					'adhersion_id' => $member->adhersion_id,
					'first_name' => $member->first_name,
					'last_name' => $member->last_name,
					'member_nid' => $member->member_nid,
					'service' => $member->service,
					'institution' =>$member->institution_name,
				 ];
	});
		       
	}

	/**
	 * Get member by adhersion
	 * @param  integer $adhersionId adhersionId
	 * @return Eloquent Model
	 */
	public function getByAdhersion($adhersionId) {
		return $This->user->getByAdhersion($adhersionId);
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

	/**
	 * Generate unique Adhersion number
	 */
	protected function generateAdhersionNumber() {
		$countUsers = $this->user->count() + 1;
		$newAdhersionNumber = date('Y') . sprintf("%05d", $countUsers);

		// if we have this adhersion number generate another
		while ($this->user->where('adhersion_id', '=', $newAdhersionNumber)->first() != null) {
			$countUsers++;
			// We assume that CEB can only recruit less than 10K member per year
			$newAdhersionNumber = date('Y') . sprintf("%04d", $countUsers);
		}
		// Format the number to  something like "00001"
		return $newAdhersionNumber;
	}

}
