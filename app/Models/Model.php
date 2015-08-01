<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

class Model extends Eloquent implements LogsActivityInterface {

	use LogsActivity;
	/**
	 * Get the message that needs to be logged for the given event name.
	 *
	 * @param string $eventName
	 * @return string
	 */
	public function getActivityDescriptionForEvent($eventName) {
		if ($eventName == 'created') {
			return 'Article "' . $this->name . '" was created';
		}

		if ($eventName == 'updated') {
			return 'Article "' . $this->name . '" was updated';
		}

		if ($eventName == 'deleted') {
			return 'Article "' . $this->name . '" was deleted';
		}

		return '';
	}
}