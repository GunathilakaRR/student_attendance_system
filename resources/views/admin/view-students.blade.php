


<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Side Navigation Bar</title>
        <link rel="stylesheet" href="student_dashboard.css">
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css"></script> --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  font-family: 'Josefin Sans', sans-serif;
}

body{
   background-color: #f3f5f9;
}

.wrapper{
  display: flex;
  position: relative;
}

.wrapper .sidebar{
  width: 200px;
  height: 100%;
  background: #594f8d;
  padding: 30px 0px;
  position: fixed;
}

.wrapper .sidebar h2{
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 30px;
}

.wrapper .sidebar ul li{
  padding: 15px;
  border-bottom: 1px solid #bdb8d7;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  border-top: 1px solid rgba(255,255,255,0.05);
}

.wrapper .sidebar ul li a{
  color: #bdb8d7;
  display: block;
}

.wrapper .sidebar ul li a .fas{
  width: 25px;
}

.wrapper .sidebar ul li:hover{
  background-color: #594f8d;
}

.wrapper .sidebar ul li:hover a{
  color: #fff;
}

.wrapper .sidebar .social_media{
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
}

.wrapper .sidebar .social_media a{
  display: block;
  width: 40px;
  background: #594f8d;
  height: 40px;
  line-height: 45px;
  text-align: center;
  margin: 0 5px;
  color: #bdb8d7;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.wrapper .main_content{
  width: 100%;
  margin-left: 200px;
}

.wrapper .main_content .header{
  padding: 20px;
  background: #fff;
  color: #717171;
  border-bottom: 1px solid #e0e4e8;
}

.wrapper .main_content .info{
  margin: 20px;
  color: #717171;
  line-height: 25px;
}

.wrapper .main_content .info div{
  margin-bottom: 20px;
}

        </style>


    </head>


    <body>

    <div class="wrapper">
        <div class="sidebar">

            @if(Auth::check() && Auth::user()->admin)
                <h2>{{ Auth::user()->admin->name1 }}</h2>
            @endif

            <h2>{{ Auth::user()->registration_number }}</h2>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#"><i class="fas fa-user"></i>Profile</a></li>
                <li><a href="{{ route('view-students') }}"><i class="fas fa-address-card"></i>View Students</a></li>
                {{-- <li><a href="{{ route('student-cvbuilder') }}"><i class="fas fa-project-diagram"></i>CV Builder</a></li> --}}
                <li><a href="#"><i class="fas fa-blog"></i>Blogs</a></li>
                <li><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
                <li><a href="#"><i class="fas fa-map-pin"></i>Map</a></li>
            </ul>
            <div class="social_media">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="main_content">
            <div class="header">Welcome!! Have a nice day.</div>
            <div class="info">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Reg No</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">E mail</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->registration_number }}</td>
                            <td>{{ $student->name1 }}</td>
                            <td>{{ $student->name2 }}</td>
                            <td>{{ $student->email }}</td>
                            <td>profile</td>
                            <td>
                              <a href="#"><i class="fas fa-edit btn btn-primary"></i></a>
                              <a href="#"><i class="fas fa-trash-alt btn btn-danger"></i></a>
                              <a href="#"><i class="fas fa-eye btn btn-success"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
          </div>
        </div>
    </div>





    </body>
    </html>



</x-app-layout>



