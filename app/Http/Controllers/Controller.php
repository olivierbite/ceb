<?php

namespace Ceb\Http\Controllers;
use App;
use Ceb\Models\Setting;
use Flash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Sentry;

abstract class Controller extends BaseController {
	use DispatchesJobs, ValidatesRequests;

	public $user;
	public $flash;
	function __construct() {

		$this->middleware('sentry.auth');
		$this->flash = new Flash;
		$this->user = Sentry::getUser();
		$this->setting = new Setting;

		if (!is_null($this->user)) 
		{
		   App::setLocale($this->user->language);
		}
	}
}