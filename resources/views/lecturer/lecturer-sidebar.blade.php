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
        background-color: green;
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

    aside p {
        margin: 0;
        padding: 40px 0;
    }

    aside h2{
        margin: 0;
        padding: 40px 50px;
    }
</style>


<aside>
    {{-- <p>lecturer </p> --}}
    <h2>{{ Auth::user()->lecturer->name1 }}</h2>
    <a href="#">
        <i class="fa fa-user-o" aria-hidden="true"></i> My Drive
    </a>
    <a href="{{ route( "code-generate" ) }}">
        <i class="fa fa-laptop" aria-hidden="true"></i> CODE GENERATE
    </a>
    <a href="#">
        <i class="fa fa-clone" aria-hidden="true"></i> Shared with Me
    </a>
    <!-- Add other sidebar links as needed -->
</aside>
