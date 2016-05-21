@extends('myviews.profile.profilepage')

@section('options_array')
	<button class="option_button" onclick="newPage('/profile/about')">About</button>
	<?php
		$user_login = Auth::user();
		$user_info = App\UserInfo::find($user_login->id);
		if(strcmp($user_info->type, "user")!=0)
		{
	?>
	<button class="option_button" onclick="newPage('/profile/office')">Office</button>
	<?php
		}
	?>
	<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/recently_viewed')">Recently viewed</button>
	<button class="option_button" onclick="newPage('/profile/my_auctions')">My Auctions</button>
	<button class="option_button" onclick="newPage('/profile/my_purchases')">Purchase history</button>
	<button class="option_button" onclick="newPage('/profile/my_sales')">Sale history</button>
@endsection

@section('content_section')
MEOW
@endsection