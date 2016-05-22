@extends('layouts.app')
<!-- 
   this php file will extend from the file 'resources/layouts/app.blade.php' 
-->


@section('other_styles')
<!-- 
    This section is used for adding another stylesheet after extending layouts.app
-->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/profile_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/util.css') }}">

<!-- 
   making space for more stylesheets for children
-->
@yield('other_styles_1')
@endsection





@section('content')
<!-- modals here -->
<!-- modal: advertise book -->
<!-- 
A modal is an html code which appears to be over the page as pop up window
but technically it is not. It justs blurrs the current page contents and 
overdraw a content on that, 
-->
<div id="modal_sell_book_input" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">×</span>
        <h2>Advertise a book to sell</h2>
      </div>
      <form method="POST" action="/advertise_book" enctype="multipart/form-data">
      <div class="modal-body">
      <table style="width:100%;">
        <tr>
            <td>Picture:</td><td><input type="file" name="new_book_pic" accept=".jpg"></td>
        </tr>
        <tr>
            <td>Name:</td><td><input name="new_book_name" ></td>
        </tr>
        <tr>
            <td>Author:</td><td><input name="new_book_author" ></td>
        </tr>
        <tr>
            <td>Price:</td><td><input name="new_book_price" ></td>
        </tr>
        <tr>
            <td>Print:</td><td><select name="new_book_print">
                <option value="Photocopy" selected>Photocopy</option>
                <option value="Printed Copy">Printed Copy</option>
                <option value="Original">Original</option>
            </select></td>
        </tr>
        
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
      <div class="modal-footer">
            <input type="submit" value="Submit"  class="submit_modal_btn"></input>
      </div>
      </form>
    </div>
</div>
<script type="text/javascript" src="{{URL::asset('scripts/modal.js')}}"></script>
<!-- end modal -->




<!-- 
    main division is bottom-most layer. it just contains the child divs
-->

<div class="maindiv">



    <!-- 
    this division is the left most division, it contains ads. it is very thin in width and 100% long in height
    -->
    <div class="left_add_div">
        <label></label>
    </div>




    <!-- 
    this division contains the main components. it has almost 70% of the total size of the page
    -->
    <div class="middle_main_div">



        <!-- 
        this div contains the propic and name and short info, as the cover page of the profile
        -->
        <div class="banner_div">
            <div class="prof_pic">
            @yield('profile_pic')      
            </div>
            <div class="short_info">
            @yield('short_info')    
            </div>
        </div>



        <!-- 
        this division contains the options buttons
        -->
        <div class="options_tab_div">
            @yield('options')
        </div>


        <!-- 
        after clicking to any option of the above division, this div will show
        the details of that options
        -->
        <div class="content_div">
            @yield('main_content')
        </div>

    </div>



    <!-- 
    this division is for adds at rightmost part of the page
    -->
    <div class="right_add_div">
        <!-- i will put cart icons here -->
        <div class="cart_div">
            <div style="width:100%; height: 75%;">
                <img class="cart_img" src="{{URL::asset('images/cart.png')}}">
            </div>
            <div style="width:100%; height: 25%;">
                <center><label class="cart_label">Cart</label></center>
            </div>
        </div>
        <div class="cart_div" onclick="openModal('modal_sell_book_input')">
            <div style="width:100%; height: 75%;">
                <img class="cart_img mid" src="{{URL::asset('images/dollar.png')}}">
            </div>
            <div style="width:100%; height: 25%;">
                <center><label class="cart_label">Sell a Book</label></center>
            </div>
        </div>
        <div class="cart_div" style="border: none;">
            <div style="width:100%; height: 75%;">
                <img class="cart_img mid" src="{{URL::asset('images/auction.png')}}">
            </div>
            <div style="width:100%; height: 25%;">
                <center><label class="cart_label">New Auction</label></center>
            </div>
        </div>
    </div>



    <!-- 
    footer is a space where the site information will be shown, it may contain some info or nothing, 
    mostly its used for decoration
    -->
    <div class="footer">
            @yield('footer')
    </div>  
       

</div>
@endsection