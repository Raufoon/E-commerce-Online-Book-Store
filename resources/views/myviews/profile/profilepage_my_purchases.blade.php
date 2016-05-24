@extends('myviews.profile.profilepage')

@section('options_array')
	<button class="option_button" onclick="newPage('/profile/about')">About</button>
	<?php
		$user_login = Auth::user();
		$user_info = App\UserType::find($user_login->id);
		if(strcmp($user_info->type, "user")!=0)
		{
	?>
	<button class="option_button" onclick="newPage('/profile/office')">Office</button>
	<?php
		}
	?>
	<button class="option_button" onclick="newPage('/profile/my_ads')">My Ads</button>
	<button class="option_button" onclick="newPage('/profile/my_auctions')">My Auctions</button>
	<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/my_purchases')">Purchase history</button>
@endsection

@section('content_section')
<style type="text/css">
	tr{
		width: 100%;

	}
	td{
		width: 10%;
		padding: 1%;
	}
</style>
<div style="width: 100%;padding: 5%;">
	<table style="width:100%;">
		<tr style="border-bottom: 1px black solid;">
			<td>SL</td>
			<td>Date</td>
			<td>Title</td>
			<td>Price</td>
			<td>Purchased from</td>
		</tr>

	<?php
	$my_purchase_history = App\SaleHistory::where('user_id',Auth::user()->id)->get();
	$SL=0;
	foreach ($my_purchase_history as $row) {
		$SL++;
		$date = $row->date;
		$name = $row->book_title;
		$purchased_from = $row->sell_from;
		
		?>
		<tr>
			<td>{{$SL}}</td>
			<td>{{$date}}</td>
			<td>{{$name}}</td>
			<td>{{$row->profit+$row->price}}</td>
			<td>{{$purchased_from}}</td>
		</tr>
		<?php
	}
	?>
	</table>
</div>
@endsection