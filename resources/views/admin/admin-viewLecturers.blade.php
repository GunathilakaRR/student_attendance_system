<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">





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
                @include('admin.admin-sidebar')

                <div class="home-section">

                    <a href="javascript:history.back()" class="btn" style="background-color: #e84424;">
                        <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                    </a>

                    {{-- <h2>{{ Auth::user()->student->name1 }}</h2> --}}
                    <div class="container rounded bg-white mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                    @if ($lecturers->image)
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('storage/' . $lecturers->image) }}" alt="Profile Picture">
                                    @else
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('images/default_profile.jpg') }}"
                                            alt="Default Profile Picture">
                                    @endif

                                        <span style="text-transform: uppercase;">{{ $lecturers->name1 }}</span>
                                        <span style="text-transform: uppercase;">{{ $lecturers->user_id }}</span>
                                    </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 style="text-transform: capitalize;" class="text-right">{{ $lecturers->name1 }}'s Profile</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">First Name</label><input type="text"
                                                class="form-control" placeholder="first name" value="{{ $lecturers->name1 }}" style="text-transform: capitalize;"></div>
                                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text"
                                                class="form-control" value="{{ $lecturers->name2 }}" style="text-transform: capitalize;" placeholder="last name"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Registration No.</label><input type="text"
                                                class="form-control" placeholder="registration number" value="{{ $lecturers->user_id }}"></div>
                                        <div class="col-md-6"><label class="labels">Email</label><input type="email"
                                                class="form-control" value="{{ $lecturers->email }}" placeholder="email"></div>
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

                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                                        <h4 style="text-transform: capitalize;" class="text-right">Assigned Lectures</h4>
                                    </div>

                                    @foreach($lecturers->lectures as $lecture)
                                        <span style="text-transform: capitalize">{{ $lecture->title }}</span><br>
                                    @endforeach

                                </div>
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
