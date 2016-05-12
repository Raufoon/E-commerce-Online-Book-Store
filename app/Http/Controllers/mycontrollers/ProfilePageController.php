<?php

namespace App\Http\Controllers\mycontrollers;

use Auth;
use App\UserInfo;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
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
    public function index($page)
    {
        $newpage = 'myviews\profile\profilepage_';
        $newpage = $newpage.$page;
        return view($newpage);
    }

    public function updateDatabase()
    {
        $user_login = Auth::user();
        $user_info = UserInfo::find($user_login->id);

        $user_info->gender = $_POST["edit_gender"];
        $user_info->dob = $_POST["edit_dob"];
        $user_info->city = $_POST["edit_city"];
        $user_info->country = $_POST["edit_country"];
        $user_info->address = $_POST["edit_address"];
        $user_info->cellphone_1 = $_POST["edit_cellphone_1"];
        $user_login->email = $_POST["edit_email"];

        $user_info->save();
        return view('myviews\profile\profilepage_about');
    }

}
