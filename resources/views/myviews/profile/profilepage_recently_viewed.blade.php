@extends('myviews.profile.profilepage')

@section('options_array')
	<button class="option_button" onclick="newPage('/profile/about')">About</button>
	<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/recently_viewed')">Recently viewed</button>
	<button class="option_button" onclick="newPage('/profile/my_auctions')">My Auctions</button>
	<button class="option_button" onclick="newPage('/profile/my_purchases')">Purchase history</button>
	<button class="option_button" onclick="newPage('/profile/my_sales')">Sale history</button>
@endsection