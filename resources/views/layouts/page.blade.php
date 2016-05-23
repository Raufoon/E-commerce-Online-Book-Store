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
<!-- 
    main division is bottom-most layer. it just contains the child divs
-->

<div class="maindiv">
<!-- modals here -->



<!-- CART MODAL -->
<script type="text/javascript">
    function openCart()
    {
        openModal('modal_cart');
    }
    function removeBookFromCart(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var resp=xhttp.responseText;
                
                resp = resp.replace(/"/g, "");

                document.getElementById(resp).hidden = true;
                location.reload();
            }
        };
        xhttp.open("POST", "/remove_from_cart", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

        var str1="book_to_remove_cart=";
        var param = str1.concat(id);
        param = param.concat("&view_id=");
        param = param.concat(id);

        xhttp.send(param);
    }
    function addToCart_inv(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var str1 = "btn_";
                var resp=xhttp.responseText;
                
                resp = resp.replace(/"/g, "");
                
                var btn_id = str1.concat(resp);

                document.getElementById(btn_id).innerHTML = "Already added";
                document.getElementById(btn_id).disabled = true;
                location.reload();
            }
        };
        xhttp.open("POST", "/add_to_cart", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

        var str1="book_to_add_cart=";
        var param = str1.concat(id);
        param = param.concat("&sell_from=inventory");
        xhttp.send(param);
        
    }
    function addToCart_ad(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var str1 = "btn_";
                var resp=xhttp.responseText;
                
                resp = resp.replace(/"/g, "");
                
                var btn_id = str1.concat(resp);

                document.getElementById(btn_id).innerHTML = "Already added";
                document.getElementById(btn_id).disabled = true;
                location.reload();
            }
        };
        xhttp.open("POST", "/add_to_cart", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

        var str1="book_to_add_cart=";
        var param = str1.concat(id);
        param = param.concat("&sell_from=advertised");
        xhttp.send(param);   
    }


</script>

<div id="modal_cart" class="modal cart">
    <!-- Modal content -->
    <div class="modal-content cart">
        <div class="modal-header">

        <form action="/pay/direct" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <img src="{{URL::asset('images/cart2.png')}}" style="float: left;width: 5vw;height: 5vw;">
            <h2 id="cart_title" style="margin-left: 2vw;color: #7793b5;float: left;">Your cart</h2>
            <input class="submit_modal_btn" type="submit" style="float: right;" value="Begin Transaction">
        </form>


        </div>
        <div class="modal-body">
        <div style="width:100%;height: 100%;">
        <?php
        $books_in_my_cart = App\Cart::where('user_id',Auth::user()->id)->get();
        if($books_in_my_cart->count()!=0){
            foreach ($books_in_my_cart as $cartbook) {
                if(strcmp($cartbook->status, "unpaid")!=0) continue;

                $book;
                $image_src="images/";

                if(strcmp($cartbook->sell_from, "inventory")==0)
                {
                    $image_src= $image_src."bookpics/";
                    $book = App\Books::find($cartbook->book_id);
                }
                else
                {
                    $image_src= $image_src."advertised_books/";
                    $book = App\AdvertisedBooks::find($cartbook->book_id);
                }
                $image_src= $image_src.$book->id.".jpg";
                ?>
                <div id="{{$cartbook->SL}}" style="width:20vw;height:7vw;float: left;margin: 1vw;box-shadow: 0 0 5px 1px #d6d6d6;">
                    <img src="{{URL::asset($image_src)}}" style="width:35%;height:100%;float:left;margin-right: 5%;">
                    <label style="margin:0;width:60%;height:40%;float:left;">{{$book->name}}</label>
                    <label style="margin:0;width:60%;height:30%;float:left;font-weight:normal;">Price: {{$book->price}} Tk</label>
                    <button onclick="removeBookFromCart('{{$cartbook->SL}}')" style="margin:0;width:30%;height:30%;float:right">Remove</button>
                </div>               
                <?php   
            }        
        }
        ?>

        
        </div>
        </div>

        

        

    </div>
</div>









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
    this division is the left most division, it contains ads. it is very thin in width and 100% long in height
    -->
    <div class="left_add_div">
        @yield('left_add_space')
    </div>




    <!-- 
    this division contains the main components. it has almost 70% of the total size of the page
    -->
    <div class="middle_main_div">
        @yield('main_content')       
    </div>



    <!-- 
    this division is for adds at rightmost part of the page
    -->
    <div class="right_add_div">
        <!-- i will put cart icons here -->
        <div class="cart_div">
            <div style="width:100%; height: 75%;" onclick="openCart()">
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