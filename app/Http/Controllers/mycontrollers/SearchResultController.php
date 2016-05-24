<?php
namespace App\Http\Controllers\mycontrollers;

use View;
use App\UserInfo;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchResultController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function search()
    {
        /*
        fetch the search key
        */
        $search_key = $_GET["search_word"];

        /*
        return to homepage if the search key has no value
        */
        if(strcmp($search_key, "")===0)
        {
            //return view('/welcome');
        }

        /*
        open the search_results page and pass the value $search_key to it
        */
        $view = View::make('myviews\search\search_results')->with('search_word', $search_key);


        return $view;
    }



}
