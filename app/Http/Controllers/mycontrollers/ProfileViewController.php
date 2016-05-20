<?php

namespace App\Http\Controllers\mycontrollers;

use Auth;
use View;
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
    public function index($profile_id)
    {
        $view;
        if($profile_id == Auth::user()->id)
        {
            $view = View::make('myviews\profile\profilepage_about');
        }
        else $view = View::make('myviews\profile\viewprofile_about')->with('profile_id', $profile_id);
        return $view;
    }

    public function loadSection($profile_id,$page)
    {
        $view;
        if($profile_id == Auth::user()->id)
        {
            $view = View::make('myviews\profile\profilepage_'.$page);
        }
        else $view = View::make('myviews\profile\viewprofile_'.$page)->with('profile_id', $profile_id);
        return $view;
    }



}