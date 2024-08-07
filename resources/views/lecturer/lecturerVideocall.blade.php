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


        .jitsi-container {
            width: 100%;
            height: 700px; /* Adjust height as needed */
        }

        aside {}
    </style>

    <div class="container1">
        @include('lecturer.lecturer-sidebar')

        <div class="home-section">
            <div class="container">

                <div class="jitsi-container">
                    <iframe
                        allow="camera; microphone; fullscreen; display-capture"
                        src="https://meet.jit.si/YourCustomRoomName"
                        style="width: 100%; height: 100%; border: 0;">
                    </iframe>
                </div>

            </div>
        </div>
    </div>









</x-app-layout>
