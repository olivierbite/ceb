<?php

namespace Ceb\Http\Controllers;
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
	}
}
