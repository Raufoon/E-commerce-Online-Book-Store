@extends('layouts.profilepagelayout')
<!-- 
    this page extends from 'resources/layout/profilepagelayout.blade.php'
-->
<!-- 
   this place is also a template which contains the basic build-up of a profile page 
-->



@section('profile_pic')
<!-- modal -->

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.submit_modal_btn{
	width: 150px;
	height: 50px;
	font-size: 15px;
	border: 3px #f08080 solid;
	border-radius: 5px;
	color: white;
	background-color: #f08080;
}
</style>
<script type="text/javascript">
	function removeBookFromCart(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var resp=xhttp.responseText;
                
                resp = resp.replace(/"/g, "");

                 document.getElementById(resp).hidden = true;
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
<!-- 
A modal is an html code which appears to be over the page as pop up window
but technically it is not. It justs blurrs the current page contents and 
overdraw a content on that,	
-->
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

<div id="myModal" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
	  <div class="modal-header">
	    <span class="close">×</span>
	    <h2>Upload a profile picture</h2>
	  </div>
	  <form method="POST" action="/profile/propic/save" enctype="multipart/form-data">
	  <div class="modal-body">
	    
	    	<input type="file" name="pp_to_upload" accept=".jpg">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  </div>
	  <div class="modal-footer">
	    	<input type="submit" value="Submit"  class="submit_modal_btn"></input>
	  </div>
	  </form>
	</div>
</div>

	<style type="text/css">
		.prof_img{
			border-radius: 5px;
			width: 100%;
			height: 100%;
		}
	</style>

	<!-- 
	loading database    
	-->
	<?php 
		/*
		Auth is a object which can do authentication. it was generated by default.
		Auth can access to a table "USER('id','email','password')" in the database by user() method
		*/
		$user_login = Auth::user(); 
		/*
		App\UserInfo is a class which can access the table "USER_INFO" in databse
		this class was created by me.
		find() is a superclass function which can do databse query
		*/
		$user_info = App\UserInfo::find($user_login->id);
	?>


	<!-- 
    setting the profile picture.
    the profile pictures are saved at 'public/images/propics' and their filenames are set as similar to users id.
	-->
	@if($user_info->haspropic == false)
	<!-- default propic -->
	<img class="prof_img" src="{{URL::asset('images/propics/default_propic.png')}}" onclick="changePicture()">
	@else
	<!-- user has propic -->
	<?php $propicsrc= 'images/propics/'.$user_info->id.'.jpg'; ?>
	<img class="prof_img" src="{{URL::asset($propicsrc)}}"  onclick="changePicture()">
	@endif

	<script type="text/javascript">
	/*
	called after user clicks on his/her profile picture and then selects a picture and clicks
	submit
	*/
	function changePicture()
	{
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		modal.style.display = "block";
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		    modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}
	}
	</script>



@endsection


@section('short_info')
<?php

?>





	<style type="text/css">
	.shortinfo{
		margin-left: 10px;
		margin-top: 2px;
		font-size: 14px;
	}
	</style>
	
	

	<!-- 
    profile cover space is divided into half -> left and right divs
	-->	
	<!-- 
    LEFT part
	-->
	<div style="float: left;">
		
		
		<!-- 
		adding the user's name beside the profile picture
		-->
		<h3 
			style="margin-left: 10px;
					margin-top: 5px;
					font-size: 40px;
					color: #077e94;
					font-weight: bold;"
		>{{ $user_login->name }} 
		</h3>

		


		<!-- 
		adding some short informations beside the profile picture 
		-->

		<h3 class="shortinfo" style="margin-top: 15px;">member since {{ $user_info->member_since }} </h3>
		
		<h3 class="shortinfo">lives in {{ $user_info->city }}, {{ $user_info->country }}</h3>
		
		<!-- adding cellphones -->
		@if($user_info->cellphone_1 != NULL)
		<div >
			<h3 class="shortinfo">cellphone: {{ $user_info->cellphone_1 }}</h3>
		</div>
		@else
		@endif




		<!-- 
		showing likes and dislikes, given by other users 
		-->

		<div style="margin-top: 20px;">
			
			<style type="text/css">
			h4{
				font-size: 20px;
				float: left;
				margin: 0 auto;
				margin-left: 5px;
			}
			.votes{
				float: left;
				width: 20px; 
				height: 20px; 
				margin-left: 10px;
			}
			</style>
			
			<?php
			$user_login = Auth::user(); 
			$user_info = App\UserInfo::find($user_login->id);
			?>
		
			<img class="votes" src="{{URL::asset('images/upvote_icon.png')}}">
			<h4>{{ $user_info->upvotes }}</h4>
		
			<img class="votes" src="{{URL::asset('images/downvote_icon.png')}}">
			<h4>{{ $user_info->downvotes }}</h4>

		</div>

	</div>





	<!-- RIGHT part -->

	<div style="float: right; height: 100%; margin: 10px;">
		

		<div style="height: 70%;">

		
			



		</div>



		<!-- link icons of facebook, google etc -->

		<div style="style=height: 30%; float: right;">

			<img src="{{URL::asset('images/facebook_icon.png')}}" style="width: 30px; height: 30px;">
			<img src="{{URL::asset('images/google_plus_icon.png')}}" style="width: 30px; height: 30px;">
			<img src="{{URL::asset('images/twitter_icon.png')}}" style="width: 30px; height: 30px;">

		</div>



	</div>
@endsection



@section('options')


	<style type="text/css">
	.option_button{
		height: 100%;
		float: left;
		color: #26867c;
		outline: none;
		border: none;
		background-color: white;
		width: 150px;
	}
	
	</style>

	@yield('options_array')
	

	<script type="text/javascript">
	function newPage(page)
	{
		window.location = page;
	}
	</script>

@endsection

@section('footer')
footer
@endsection

@section('main_content')
@yield('content_section')
@endsection

