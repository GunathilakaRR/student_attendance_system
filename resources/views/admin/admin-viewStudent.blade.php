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
                                    @if ($students->image)
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('storage/' . $students->image) }}" alt="Profile Picture">
                                    @else
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('images/default_profile.jpg') }}"
                                            alt="Default Profile Picture">
                                    @endif


                                    <span style="text-transform: uppercase;">{{ $students->name1 }}</span>
                                    <span style="text-transform: uppercase;">{{ $students->registration_number }}</span>
                                </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 style="text-transform: capitalize;" class="text-right">{{ $students->name1 }}'s Profile</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">First Name</label><input
                                                type="text" class="form-control" placeholder="first name"
                                                value="{{ $students->name1 }}" style="text-transform: capitalize;"></div>
                                        <div class="col-md-6"><label class="labels">Last Name</label><input
                                                type="text" class="form-control" value="{{ $students->name2 }}"
                                                placeholder="last name" style="text-transform: capitalize;"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Registration No.</label><input
                                                type="text" class="form-control" placeholder="registration number"
                                                value="{{ $students->registration_number }}" style="text-transform: uppercase;"></div>
                                        <div class="col-md-6"><label class="labels">Email</label><input type="email"
                                                class="form-control" value="{{ $students->email }}" placeholder="email">
                                        </div>
                                    </div>
                                    {{-- <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Mobile Number</label><input
                                                type="text" class="form-control" placeholder="enter phone number"
                                                value=""></div>
                                        <div class="col-md-12"><label class="labels">Address Line 1</label><input
                                                type="text" class="form-control" placeholder="enter address line 1"
                                                value=""></div>
                                        <div class="col-md-12"><label class="labels">Address Line 2</label><input
                                                type="text" class="form-control" placeholder="enter address line 2"
                                                value=""></div>
                                        <div class="col-md-12"><label class="labels">Postcode</label><input
                                                type="text" class="form-control" placeholder="enter address line 2"
                                                value=""></div>
                                        <div class="col-md-12"><label class="labels">State</label><input type="text"
                                                class="form-control" placeholder="enter address line 2" value="">
                                        </div>
                                        <div class="col-md-12"><label class="labels">Area</label><input type="text"
                                                class="form-control" placeholder="enter address line 2" value="">
                                        </div>
                                        <div class="col-md-12"><label class="labels">Email ID</label><input
                                                type="text" class="form-control" placeholder="enter email id"
                                                value=""></div>
                                        <div class="col-md-12"><label class="labels">Education</label><input
                                                type="text" class="form-control" placeholder="education"
                                                value=""></div>
                                    </div> --}}
                                    {{-- <div class="row mt-3">
                                        <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                                class="form-control" placeholder="country" value=""></div>
                                        <div class="col-md-6"><label class="labels">State/Region</label><input
                                                type="text" class="form-control" value="" placeholder="state">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button"
                                            type="button">Save Profile</button></div> --}}
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center experience">
                                        <span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i
                                                class="fa fa-plus"></i>&nbsp;Experience</span>
                                    </div><br>
                                    <div class="col-md-12"><label class="labels">Experience in Designing</label><input
                                            type="text" class="form-control" placeholder="experience"
                                            value=""></div> <br>
                                    <div class="col-md-12"><label class="labels">Additional Details</label><input
                                            type="text" class="form-control" placeholder="additional details"
                                            value=""></div>
                                </div>
                            </div> --}}
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
