<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* Sidebar CSS */
    body{
        margin: 0;
    }
    aside {
        color: #fff;
        width: 250px;
        min-height: 100vh;
        padding-left: 20px;
        background-color: green;
        border-top-right-radius: 80px;
        overflow-y: auto;
    }

    aside a {
        font-size: 12px;
        color: #fff;
        display: block;
        padding: 12px;
        padding-left: 30px;
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
    }

    aside a:hover {
        color: #3f5efb;
        background: #fff;
        outline: none;
        position: relative;
        background-color: #fff;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    aside a i {
        margin-right: 5px;
    }

    aside a:hover::after {
        content: "";
        position: absolute;
        background-color: transparent;
        bottom: 100%;
        right: 0;
        height: 35px;
        width: 35px;
        border-bottom-right-radius: 18px;
        box-shadow: 0 20px 0 0 #fff;
    }

    aside a:hover::before {
        content: "";
        position: absolute;
        background-color: transparent;
        top: 38px;
        right: 0;
        height: 35px;
        width: 35px;
        border-top-right-radius: 18px;
        box-shadow: 0 -20px 0 0 #fff;
    }

    aside p {
        margin: 0;
        padding: 40px 0;
    }

    h2 ,h3{
        font-size: 19px;
    }

</style>


<aside>

    <div style="text-align: center;" >
        <div style="display: flex; justify-content: center;">
            @if (Auth::user()->lecturer->image)
                <img style="object-fit: cover; border-radius: 50%; width: 100px; height: 100px; margin-top: 3rem;" src="{{ asset('storage/' . Auth::user()->lecturer->image ) }}" alt="Profile Picture">
            @else
                <img style="object-fit: cover; border-radius: 50%; width: 100px; height: 100px; margin-top: 3rem;" src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile Picture" >
            @endif
        </div>

        <h2 style="text-transform: uppercase; ">{{ Auth::user()->lecturer->name1 }}</h2>
        <h3 style="text-transform: uppercase;">L00{{ Auth::user()->lecturer->id }}</h3>

    </div>
    {{-- <p>lecturer </p> --}}

    <a href="#">
        <i class="fa fa-laptop" aria-hidden="true"></i> DASHBOARD
    </a>
    <a href="{{ route( "code-generate" ) }}">
        <i class="fa-solid fa-code"  aria-hidden="true"></i> CODE GENERATE
    </a>
    <a href="{{ route('lecturerProfile_update', Auth::user()->lecturer->id) }}">
        <i class="fa-solid fa-user" aria-hidden="true"></i> PROFILE
    </a>
    <a href="{{ route('view_assigned_lectures', Auth::user()->lecturer->id) }}">
        <i class="fa fa-clone" aria-hidden="true"></i> LECTURES
    </a>
    <a href="{{ route('dashboard_attendance', Auth::user()->lecturer->id) }}">
        <i class="fa fa-clone" aria-hidden="true"></i> chart
    </a>
    <a href="{{ route('video-call', Auth::user()->lecturer->id) }}">
        <i class="fa fa-clone" aria-hidden="true"></i> START A MEETING
    </a>

    <!-- Add other sidebar links as needed -->
</aside>
