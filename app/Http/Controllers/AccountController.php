<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;
use Ceb\Http\Requests;
use Ceb\Models\Account;
use Ceb\Http\Controllers\Controller;
use Log;

class AccountController extends Controller
{   
    function __construct(Account $account) {
        $this->account = $account;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // First check if the user has the permission to do this
        if (!$this->user->hasAccess('account.list')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' viewed accounts list');
        $accounts = $this->account->paginate(20);
        return view('settings.accountingplan.list',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                // First check if the user has the permission to do this
        if (!$this->user->hasAccess('account.create')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' starts to create accounts');
        return view('settings.accountingplan.form');
    }
}
