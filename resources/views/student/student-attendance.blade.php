<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}



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

            <div class="container">

                @if (session()->has('one_time_code'))
                    <p>Stored One-Time Code: {{ session('one_time_code') }}</p>
                @endif

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

                <!-- Form for students to enter code -->
                <form action="{{ route('attendance_mark') }}" method="POST">
                    @csrf
                    <label for="entered_code">Enter Code:</label>
                    <input type="text" name="entered_code" id="entered_code" required>
                    <button class="btn" type="submit"
                        style="background-color: purple; color: white;">Submit</button>
                </form>


            </div>

        </div>
    </div>









</x-app-layout>
