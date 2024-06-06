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
                            <p>Expires in: <span id="expiration-countdown"></span></p>
                        @endif
                    </div>

                    <script>
                        // Get expiration time in milliseconds since Epoch from session
                        const expirationTime = new Date({{ session('expiration') }} * 1000); // Convert to milliseconds

                        // Update countdown every second
                        const countdownInterval = setInterval(() => {
                            const now = new Date().getTime();
                            const remainingTime = expirationTime - now;

                            // Check if code has expired
                            if (remainingTime <= 0) {
                                clearInterval(countdownInterval);
                                document.getElementById('expiration-countdown').textContent = 'EXPIRED';
                            } else {
                                // Calculate remaining minutes and seconds
                                const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                                // Format remaining time as MM:SS
                                const formattedTime =
                                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                                // Update countdown display
                                document.getElementById('expiration-countdown').textContent = formattedTime;
                            }
                        }, 1000);
                    </script>
                @endif


                <form action="{{ route('otc-generate') }}" method="POST">
                    @csrf
                    <select name="course_id" id="course_id">
                        @foreach ($lectures as $lecture)
                            <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn" style="background-color: green; color: white;">Generate
                        OTC</button>
                </form>



            </div>

        </div>
    </div>



    <script>
        // Get expiration time from session and parse it
        const expirationTime = new Date('{{ session('expiration') }}').getTime();

        // Update countdown every second
        const countdownInterval = setInterval(() => {
            const now = new Date().getTime();
            const remainingTime = expirationTime - now;

            // Check if code has expired
            if (remainingTime <= 0) {
                clearInterval(countdownInterval);
                document.getElementById('expiration-countdown').textContent = 'EXPIRED';
            } else {
                // Calculate remaining time in seconds
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                document.getElementById('expiration-countdown').textContent = seconds + 's';
            }
        }, 1000);
    </script>





</x-app-layout>
