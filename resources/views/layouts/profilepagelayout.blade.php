@extends('layouts.app')
<!-- 
   this php file will extend from the file 'resources/layouts/app.blade.php' 
-->


@section('other_styles')
<!-- 
    This section is used for adding another stylesheet after extending layouts.app
-->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/profile_page.css') }}">


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
            @yield('right_add_space')
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