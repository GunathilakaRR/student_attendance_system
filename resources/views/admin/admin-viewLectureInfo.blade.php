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



                .form-control:focus {
                    box-shadow: none;
                    border-color: #BA68C8
                }

                .profile-button {
                    background: rgb(99, 39, 120);
                    box-shadow: none;
                    border: none
                }

                .profile-button:hover {
                    background: #682773
                }

                .profile-button:focus {
                    background: #682773;
                    box-shadow: none
                }

                .profile-button:active {
                    background: #682773;
                    box-shadow: none
                }

                .back:hover {
                    color: #682773;
                    cursor: pointer
                }

                .labels {
                    font-size: 11px
                }

                .add-experience:hover {
                    background: #BA68C8;
                    color: #fff;
                    cursor: pointer;
                    border: solid 1px #BA68C8
                }
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


                                </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 style="text-transform: uppercase;" class="text-right">
                                            {{ $lecture->code }}{{ ' ' }}{{ $lecture->title }}</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Lecture Title</label><input
                                                type="text" class="form-control" placeholder="lecture title"
                                                value="{{ $lecture->title }}" style="text-transform: uppercase;"></div>
                                        <div class="col-md-6"><label class="labels">Lecture Code</label><input
                                                type="text" class="form-control" value="{{ $lecture->code }}"
                                                style="text-transform: uppercase;" placeholder="lecture title"></div>
                                    </div>

                                    <div class="row mt-2">
                                        @foreach ($lecture->schedules as $schedule)
                                        <div class="col-md-6"><label class="labels">Start Time</label>
                                            <input type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}">
                                        </div>

                                        <div class="col-md-6"><label class="labels">End Time</label>
                                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}">
                                        </div>
                                        @endforeach
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Lecture Description</label>

                                                <textarea class="form-control" rows="10" placeholder="Lecture Description">{{ $lecture->description }}</textarea>




                                    </div>




                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                                        <h4 style="text-transform: capitalize;" class="text-right">Assigned Lecturers
                                        </h4>
                                    </div>



                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            @foreach ($lecture->lecturers as $lecturer)
                                                @if ($lecturer->image)
                                                    <img style="object-fit: cover; border-radius: 50%; width: 70px; height: 70px; "
                                                        src="{{ asset('storage/' . $lecturer->image) }}"
                                                        alt="Profile Picture">
                                                @else
                                                    <img style="object-fit: cover; border-radius: 50%; width: 70px; height: 70px; "
                                                        src="{{ asset('images/default_profile.jpg') }}"
                                                        alt="Default Profile Picture">
                                                @endif

                                                <p style="text-transform: capitalize;">{{ $lecturer->name1 }}
                                                    {{ $lecturer->name2 }}</p>
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
