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
                @include('student.student-sidebar')

                <div class="home-section">

                    <a href="javascript:history.back()" class="btn" style="background-color: #594f8d;">
                        <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                    </a>


                    <div class="container">
                        <h1>Register for Lectures</h1>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf

                            <div class="mt-5">
                                @foreach ($lectures as $lecture)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="lectures[]" id="lecture{{ $lecture->id }}" value="{{ $lecture->id }}">
                                        <label style="text-transform: uppercase" class="form-check-label" for="lecture{{ $lecture->id }}">
                                            {{ $lecture->code }}{{ ' ' }}{{ $lecture->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn  mt-5" style="background-color: #594f8d; color:#ffff">Register</button>
                        </form>
                    </div>


                </div>
            </div>




        </div>

    </body>

    </html>



</x-app-layout>
