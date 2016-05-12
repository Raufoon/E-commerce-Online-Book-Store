@extends('myviews.profile.viewprofile')

@section('options_array')
<button class="option_button" style="background-color: #40E0D0; color: white;" onclick="newPage('/profile/view/{{$profile_id}}/about')">About</button>
@endsection

@section('content_section')
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

	<?php
	$user_info = App\UserInfo::find($profile_id);
	?>


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
				{{$user_info->name}}
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
					
		</table>

	</div>
	
</div>

@endsection