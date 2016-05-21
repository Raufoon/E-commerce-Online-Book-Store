<?php

namespace App\Http\Controllers\mycontrollers;

use Auth;
use App\UserType;
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
        if(strcmp($page, "office")===0)
        {
            $user_login = Auth::user();
            $user_type = UserType::find($user_login->id);
            if(strcmp($user_type->type, "owner")===0)
            {
                return view('myviews\profile\offices\owner_office');
            }
            if(strcmp($user_type->type, "manager")===0)
            {
                return view('myviews\profile\offices\manager_office_status');
            }
        }
        $newpage = 'myviews\profile\profilepage_';
        $newpage = $newpage.$page;
        return view($newpage);
    }
    public function open_office_page($page,$section)
    {
        $newpage = 'myviews\profile\offices\manager_'.$page.'_'.$section;
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
    public function savePropic()
    {
        $user_id = Auth::user()->id;
        $target_dir = "images/propics/";
        $target_file = $target_dir . $user_id.".jpg";

        if ($_FILES['pp_to_upload']['size'] == 0 )
        {
            return view('myviews\profile\profilepage_about');
        }

        move_uploaded_file($_FILES["pp_to_upload"]["tmp_name"], $target_file);

        $user_info = UserInfo::find($user_id);
        $user_info->haspropic = true;
        $user_info->save();

        return view('myviews\profile\profilepage_about');
    }

}
