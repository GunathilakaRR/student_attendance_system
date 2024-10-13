<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>




    <body>

        <div class="wrapper">

            <style>
                .container1 {
                    display: flex;
                }

                .home-section {
                    flex: 1;
                    padding: 20px;
                }

                aside {}


            </style>

            <div class="container1">
                @include('lecturer.lecturer-sidebar')

                <div class="home-section">

                    <a href="javascript:history.back()" class="btn" style="background-color: green;">
                        <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                    </a>


                    {{-- <h2>{{ Auth::user()->student->name1 }}</h2> --}}

                    <div class="container rounded bg-white mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    {{-- <img class="rounded-circle mt-5" width="150px"
                                        src="{{ asset('images/default_profile.jpg') }}"> --}}

                                    @if ($lecturers->image)
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px;" src="{{ asset('storage/' . $lecturers->image) }}" alt="Profile Picture">
                                    @else
                                        <img class="rounded-circle mt-5" width="150px" src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile Picture" >
                                    @endif

                                    <span style="text-transform: uppercase; font-color: black" >{{ $lecturers->name1 }}</span>
                                    <span style="text-transform: uppercase; font-color: black" >{{ $lecturers->registration_number }}</span>
                                </div>
                            </div>

                            <div class="col-md-5 border-right">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('update-profile', $lecturers->id) }}"  method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right" style="text-transform: capitalize;">{{ $lecturers->name1 }}'s Profile</h4>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6"><label class="labels">First Name</label><input
                                                    type="text" class="form-control" placeholder="first name"
                                                    value="{{ $lecturers->name1 }}" name="name1" style="text-transform: capitalize;"></div>
                                            <div class="col-md-6"><label class="labels">Last Name</label><input
                                                    type="text" class="form-control" value="{{ $lecturers->name2 }}"
                                                    placeholder="last name" name="name2" style="text-transform: capitalize;"></div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6"><label class="labels">Registration No.</label><input
                                                    type="text" class="form-control"
                                                    placeholder="registration number" name="student_registration_number"
                                                    value="{{ $lecturers->registration_number }}" style="text-transform: capitalize;"></div>
                                            <div class="col-md-6"><label class="labels">Email</label><input
                                                    type="email" class="form-control" value="{{ $lecturers->email }}"
                                                    placeholder="email" name="email"></div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6"><label class="labels">Country</label><input
                                                    type="text" class="form-control"
                                                    placeholder="country" name="city"
                                                    value="Sri Lanka" style="text-transform: capitalize;"></div>
                                            <div class="col-md-6"><label class="labels">Contact Number</label><input
                                                    type="text" class="form-control"
                                                    placeholder="country" name="phone_number"
                                                    value="+94" style="text-transform: capitalize;"></div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6 mb-3">
                                                <label class="labels">Profile photo</label>
                                                <input class="form-control" type="file" id="formFile"
                                                    name="profile_pic">
                                            </div>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <button class="btn" style="background-color: green; color:white;"
                                                type="submit">Update Profile</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>




        </div>
        </div>











        </div>


    </body>

    </html>



</x-app-layout>
