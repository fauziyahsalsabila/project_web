<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SailorDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('sailor.admin-dashboard');
    }

    public function HomeIndex(){
        return view('sailor.home.dashboard');
    }

}
