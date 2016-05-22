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
    public function viewBook()
    {
        $id_of_book_to_view = $_POST["view_book_id"];
        $view_mode=$_POST["view_book_mode"];
        $book_type = $_POST["view_book_type"]; // advertised or inventory

        if(strcmp($view_mode, "view")===0)
        {
            return view('myviews\bookpage\book')->with('book_id',$id_of_book_to_view)->with('book_type',$book_type);
        }
        else if(strcmp($view_mode, "view_edit")===0)
        {
            return view('myviews\bookpage\book_edit')->with('book_id',$id_of_book_to_view)->with('book_type',$book_type);
        }
    }
}
