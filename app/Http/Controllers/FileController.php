<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\File as FileModel;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Request;

class FileController extends Controller {

	public $file;
	public $storage;
	function __construct(FileModel $file, Storage $storage) {
		$this->middleware('sentry.auth');
		$this->file = $file;
		$this->storage = $storage;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$entries = $this->file->all();

		return view('files.index', compact('entries'));
	}

	public function add() {

		$file = Request::file('filefield');

		$extension = $file->getClientOriginalExtension();

		$filename = time() . $file->getFilename();
		$this->storage->disk('local')->put($filename . '.' . $extension, File::get($file));

		$entry = $this->file;

		$entry->mime = $file->getClientMimeType();

		$entry->original_filename = $filename;

		$entry->filename = $filename . '.' . $extension;

		$entry->save();

		return redirect('files');

	}

	public function get($filename) {

		$entry = $this->file->where('filename', '=', $filename)->firstOrFail();
		$file = $this->storage->disk('local')->get($entry->filename);

		return (new Response($file, 200))
			->header('Content-Type', $entry->mime);
	}

}
