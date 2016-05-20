<?php

namespace App\Http\Controllers\mycontrollers;
use View;
use App\Http\Requests;
use Illuminate\Http\Request;

class BooksPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = View::make('myviews\bookpage\bookbrowser')->with('category', 'all')->with('price_range', 'all')->with('sell_type', 'all')->with('lang', 'all')->with('print_type', 'all');
        return $view;
    }

    public function process_filter()
    {
        $view = View::make('myviews\bookpage\bookbrowser')->with('category', $_POST["category"])->with('price_range', $_POST["price_range"])->with('sell_type', $_POST["sell_type"])->with('lang', $_POST["lang"])->with('print_type', $_POST["print_type"]);

        return $view;
    }
}
