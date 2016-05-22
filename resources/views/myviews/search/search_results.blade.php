@extends('layouts.page')

@section('main_content')

<div style="width: 100%;">


	<style type="text/css">
		div{
			color: #666666;
		}
	</style>

	<!-- 
	left section, shows search result
	-->

	<div style="
		width: 100%; 
		float: left;
		margin-left: 0 auto;
		box-shadow: 0 0 15px 1px #d6d6d6;
		">

		<!-- 
		label that holds the string 'search results for $search_word'
		-->
		<label style="
			font-size: 2vw;
			width: 100%;
			padding: 5px;
			color: white;
			background-color: #40E0D0;
			font-weight: normal;
		">
			Search results for '{{$search_word}}'
		</label>


		<!-- 
		section that is inside the search result area which actually holds the search results
		-->
		<div style="
			width: 100%;
		">
			<!-- 
			Label that says headline 'people'.
			search results to find matched ids are here bellow the label
			-->
			<label style="
			font-size: 2vw;
			width: 100%;
			padding: 5px;
			font-weight: normal;
			">	
				People
			</label>




			<?php
			
			// get all the records in user_info table
			$all_rows = App\UserInfo::all();

			// for each records
			foreach ($all_rows as $user_data) {

				// search was made for blank search text, so break
				if(strcmp($search_word, " ")===0) break;

				// $search_word isn't substring of the name of the current person 
				if(strpos(strtolower($user_data->name),strtolower($search_word))===false) {
					// do nothing
				}

				else {

				//get image src of the current person
				$propic_src = 'images/propics/'.$user_data->id.'.jpg';
				if($user_data->haspropic==false)$propic_src = 'images/propics/default_propic.png';

				// name of the current person
				$name = $user_data->name;
				//refernce of the person's profile
				$href = '/profile/view/'.$user_data->id;
				?>

				<!-- 
				Divisions dynamically generated based on search result numbers.
				Each div contains a member's profile and it's information
				-->
				<div style="
					width: 18vw;
					height: 4vw;
					margin: 1vw;
					float: left;
					border: 1px #c1c1c1 solid;
					box-shadow: 0 0 1px 1px #d6d6d6;
					">

					<!-- 
					current person's propic
					-->
					<img style="
						width: 20%; 
						height: 100%;
						float: left;" src="{{URL::asset($propic_src)}}">

					<!-- 
					current person's name
					-->
					<label style="
						width: 80%;
						height: 100%;
						font-size: 20px;
						padding: 5px;
						font-weight: normal;
						float: left;
					">
						<!-- 
						current person's hyperlink
						-->
						<a style="text-decoration: none;" href="{{URL::asset($href)}}">{{$name}}</a>
					</label>


				</div>
				<?php
				}
			}
			?>
			
		</div>

		

	</div>


	<!-- 
	Right section, shows advanced search options
	-->

	

</div>

@endsection