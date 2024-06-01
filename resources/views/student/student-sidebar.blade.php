
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<style>

    /* Sidebar CSS */
    body{
        margin: 0;
    }
    aside {
        color: #fff;
        width: 250px;
        padding-left: 20px;
        height: 100vh;
        background-color: #594f8d;
        border-top-right-radius: 80px;
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
    h2 ,h3{
        font-size: 19px;
    }


</style>



<aside>
    {{-- <p>lecturer </p> --}}
    <div style="text-align: center;" >
        <div style="display: flex; justify-content: center;">
            @if (Auth::user()->student->image)
            <img style="object-fit: cover; border-radius: 50%; width: 100px; height: 100px; margin-top: 3rem;" src="{{ asset('storage/' . Auth::user()->student->image ) }}" alt="Profile Picture">
        @else
            <img class="rounded-circle mt-5" width="100px" src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile Picture" >
        @endif
        </div>
        <h2 style="text-transform: uppercase; margin-top: 1rem;">{{ Auth::user()->student->name1 }}</h2>
        <h3 style="text-transform: uppercase;">{{ Auth::user()->student->registration_number }}</h3>
    </div>

    <div class="links mt-5">
        <a href="#">
            <i class="fa fa-user-o" aria-hidden="true"></i> DASHBOARD
        </a>
        <a href="{{ route("student-attendance") }}">
            <i class="fa fa-laptop" aria-hidden="true"></i> ATTENDANCE
        </a>
        <a href="#">
            <i class="fa fa-clone" aria-hidden="true"></i> MARKS
        </a>
        <a href="#">
            <i class="fa fa-clone" aria-hidden="true"></i> CV BUILDER
        </a>
        <a href="{{ route('studentProfile_update', (Auth::user()->student->id)) }}">
            <i class="fa fa-clone" aria-hidden="true"></i> PROFILE
        </a>


    </div>

    <!-- Add other sidebar links as needed -->
</aside>
