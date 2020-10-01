<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Session;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('client');
    }

    public function index()
    {
        $client = Client::where('id', Session::get('id'))->first();
        return view('clients-panel.dashboard.index', compact('client'));
    }
}
