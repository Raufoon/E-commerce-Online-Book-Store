@extends('myviews.profile.profilepage')

@section('options_array')
	<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/about')">About</button>
	<button class="option_button" onclick="newPage('/profile/recently_viewed')">Recently viewed</button>
	<button class="option_button" onclick="newPage('/profile/my_auctions')">My Auctions</button>
	<button class="option_button" onclick="newPage('/profile/my_purchases')">Purchase history</button>
	<button class="option_button" onclick="newPage('/profile/my_sales')">Sale history</button>
@endsection





@section ('content_section')




<?php
	$user_login = Auth::user();
	$user_info = App\UserInfo::find($user_login->id);
?>




<div style="width: 100%;height: 100%;">


	<style type="text/css">
	td{
		width: 40%;
		font-size: 15px;
		padding: 5px;
	}
	.edit_button{
		width: 20%;
	}
	.headline{
		font-size: 30px;
		float: left;
	}
	</style>



	<!-- left -->
	
	<form method="POST" action="/profile/save_edit">
	
	<div style="
		width: 50%; 
		float: left;
		padding: 30px;
		height: 100%;"> 

		<h3 class="headline">Basic info</h3>

		<table style="width: 100%;">

			<tr>
				<td>
				Gender
				</td>
				<td>
				<select name="edit_gender">
					<?php 
					$default_male="";
					$default_female="";
					if(strcmp($user_info->gender, "Male")==0) $default_male=" selected ";
					else  $default_female=" selected ";
					?>

					<option value="Male" "{{$default_male}}" >Male</option>
					<option value="Female" "{{$default_female}}">Female</option>
					
				</select>
				
				</td>				
			</tr>
			<tr>
				<td>
				Date of birth:
				</td>
				<td>
				<input name="edit_dob" type="date" value="{{$user_info->dob}}">
				</td>				
			</tr>
			<tr>
				<td>
				City:
				</td>
				<td>
				<input name="edit_city" value="{{$user_info->city}}">
				</td>				
			</tr>
			<tr>
				<td>
				Country:
				</td>
				<td>
				<input name="edit_country" value="{{$user_info->country}}">
				</td>				
			</tr>
			
		</table>
	</div>



	<!-- right -->
	

	<div style="width: 50%; float: right;padding: 30px; height: 100%;"> 
	
		<h3 class="headline">Contact info</h3>
		
		<!-- Edit button here -->
		<input style="
				float: right;
				background-color: #666666;
				border: 2px #666666 solid;
				color: white;
				outline: none;
				padding: 5px;
				width: 60px;
				border-radius: 3px;
				"
				type="submit" 
				value="save" 
		>



		<table style="width: 100%;">
			<tr>
				<td>
				Address:
				</td>
				<td>
				<input name="edit_address" value="{{$user_info->address}}">
				</td>				
			</tr>
			<tr>
				<td>
				Cellphone:
				</td>
				<td>
				<input name="edit_cellphone_1" value="{{$user_info->cellphone_1}}">
				</td>				
			</tr>
			<tr>
				<td>
				Email
				</td>
				<td>
				<input name="edit_email" type="email" value="{{$user_login->email}}">
				</td>				
			</tr>			
		</table>
	</div>

	<!-- this token is used for CSRF protection -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
	</form>

</div>


@endsection