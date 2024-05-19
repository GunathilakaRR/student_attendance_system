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
        @include('lecturer.lecturer-sidebar')

        <div class="home-section">

            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        @if (session('one_time_code'))
                            <p>One-Time Code: {{ session('one_time_code') }}</p>
                        @endif
                    </div>
                @endif
                <form action="{{ route('otc-generate') }}" method="POST">
                    @csrf
                    <input type="text" name="lecture_code" placeholder="Enter lecture code">
                    <button type="submit" class="btn" style="background-color: green; color: white;">Generate
                        OTC</button>
                </form>
            </div>

        </div>
    </div>









</x-app-layout>
