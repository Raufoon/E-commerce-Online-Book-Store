<?php

namespace App\Http\Controllers\mycontrollers;

use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $newpage = 'myviews\profile\profilepage_view?';
        $newpage = $newpage.$id;
        return view($newpage);
    }

}