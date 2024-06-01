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

                    <a href="{{ route('add-newLecture') }}">
                        <button class="btn" style="background-color: #e84424; color: #ffff">Add New Lecture</button>
                    </a>



                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Lecturer</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($lectures as $lecture)
                                <tr>
                                    <td style="text-transform: uppercase">{{ $lecture->code }}</td>
                                    <td style="text-transform: uppercase">{{ $lecture->title }}</td>
                                    <td>{{ $lecture->lecturer }}</td>
                                    {{-- <td>
                                        @if ($student->image)
                                            <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; " src="{{ asset('storage/' . $student->image) }}" alt="Profile Picture">
                                        @else
                                            <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; " src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile Picture">
                                        @endif
                                    </td> --}}
                                    <td>
                                        <a href=""><i class="fas fa-edit btn btn-primary" title="Assign a Lecturer"></i></a>
                                        <a href="#"><i class="fas fa-trash-alt btn btn-danger" title="Delete"></i></a>
                                        <a href="{{ url('admin-viewStudent/' . $lecture->id) }}"><i
                                                class="fas fa-eye btn btn-success" title="View More"></i></a>
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
