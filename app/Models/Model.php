<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

class Model extends Eloquent implements LogsActivityInterface {
	use LogsActivity;
}