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
                        document.addEventListener('DOMContentLoaded', function() {
                            const expirationTime = new Date({{ session('expiration') }} * 1000);

                            const countdownInterval = setInterval(() => {
                                const now = new Date().getTime();
                                const remainingTime = expirationTime - now;

                                if (remainingTime <= 0) {
                                    clearInterval(countdownInterval);
                                    document.getElementById('expiration-countdown').textContent = 'EXPIRED';
                                } else {
                                    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                                    const formattedTime =
                                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                                    document.getElementById('expiration-countdown').textContent = formattedTime;
                                }
                            }, 1000);
                        });
                    </script>
                @endif

                <form action="{{ route('otc-generate') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="font-size: 20px;" for="course_id">Select Lecture</label>
                        <select name="course_id" id="course_id" class="form-control">
                            @foreach ($lectures as $lecture)
                                <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn mt-3" style="background-color: green; color:#ffff;">Generate OTC</button>
                </form>

                <h1 class="mt-5">Attendance Summary</h1>
                <div style="display: flex; align-items: center;">
                    <div id="attendance-summary" style="flex-grow: 1;">
                        <!-- Attendance summary will be updated here -->
                    </div>
                    <button class="btn" style="background-color: green; color: #fff; margin-left: 20px;">Download Summary</button>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const lectureSelect = document.getElementById('course_id');
                    const attendanceSummaryDiv = document.getElementById('attendance-summary');

                    function fetchAttendanceSummary() {
                        const lectureId = lectureSelect.value;
                        if (lectureId) {
                            fetch(`/lectures/${lectureId}/attendance-summary`)
                                .then(response => response.json())
                                .then(data => {
                                    attendanceSummaryDiv.innerHTML =
                                        `<p>Total Students Present: ${data.attendanceCount}</p>`;
                                })
                                .catch(error => console.error('Error fetching attendance summary:', error));
                        }
                    }

                    // Fetch initial summary
                    fetchAttendanceSummary();

                    // Fetch summary every 10 seconds
                    setInterval(fetchAttendanceSummary, 10000);

                    lectureSelect.addEventListener('change', fetchAttendanceSummary);
                });
            </script>



































            {{-- <div class="container">


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


                <h2>Attendance Summary</h2>
                <div id="attendance-summary">
                    <!-- Attendance summary will be updated here -->
                </div>

            </div> --}}

        </div>
    </div>



    {{-- <script>
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
    </script> --}}





</x-app-layout>
