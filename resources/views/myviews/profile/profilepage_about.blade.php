@extends('myviews.profile.profilepage')



@section('options_array')
	<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/about')">About</button>

	<?php
		$user_login = Auth::user();
		$user_type = App\UserType::find($user_login->id);
		if(strcmp($user_type->type, "user")!=0)
		{
	?>

	<button class="option_button" onclick="newPage('/profile/office')">Office</button>
	<?php
		}
	?>

	<button class="option_button" onclick="newPage('/profile/my_ads')">My Ads</button>
	<button class="option_button" onclick="newPage('/profile/my_auctions')">My Auctions</button>
	<button class="option_button" onclick="newPage('/profile/my_purchases')">Purchase history</button>
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




	<!-- left div-->

	<div style="
		width: 50%; 
		float: left;
		padding: 30px;
		height: 100%;"> 

		
		<h3 class="headline">Basic info</h3>
		
		<table style="width: 100%;">
			<tr>
				<td>
				Name:
				</td>
				<td>
				{{$user_login->name}}
				</td>				
			</tr>
			<tr>
				<td>
				Gender
				</td>
				<td>
				{{$user_info->gender}}
				</td>				
			</tr>
			<tr>
				<td>
				Date of birth:
				</td>
				<td>
				{{$user_info->dob}}
				</td>				
			</tr>
			<tr>
				<td>
				City:
				</td>
				<td>
				{{$user_info->city}}
				</td>				
			</tr>
			<tr>
				<td>
				Country:
				</td>
				<td>
				{{$user_info->country}}
				</td>				
			</tr>
			
		</table>
	</div>




	<!-- right div-->

	<div style="width: 50%; float: right;padding: 30px; height: 100%;"> 
	
		<h3 class="headline">Contact info</h3>
		
		<!-- Edit button here -->
		<button style="
				float: right;
				background-color: #666666;
				border: 2px #666666 solid;
				color: white;
				outline: none;
				padding: 5px;
				width: 60px;
				border-radius: 3px;
				"
				onclick="window.location = '/profile/about/edit';" 
		>Edit</button>



		<table style="width: 100%;">
			<tr>
				<td>
				Address:
				</td>
				<td>
				{{$user_info->address}}
				</td>				
			</tr>
			<tr>
				<td>
				Cellphone:
				</td>
				<td>
				{{$user_info->cellphone_1}}
				</td>				
			</tr>
			<tr>
				<td>
				Email
				</td>
				<td>
				{{$user_login->email}}
				</td>				
			</tr>			
		</table>

	</div>
	
</div>


@endsection