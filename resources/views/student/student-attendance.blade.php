<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>


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

        #calendar {

            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        aside {}
    </style>

    <div class="container1">
        @include('student.student-sidebar')

        <div class="home-section">


            <div class="container">
                <h3>Enter One-Time Code for Attendance</h3>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('attendance_mark') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="one_time_code" class="form-label">One-Time Code</label>
                        <input type="text" class="form-control" id="one_time_code" name="one_time_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5" style="background-color: #594f8d; border-color: #594f8d;">Submit</button>
                </form>


                <div class="mt-5 mb-5" >
                    <div class="container">
                        <h1> Attendance Summary</h1>
                        <div id="calendar"></div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var calendarEl = document.getElementById('calendar');

                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                contentHeight: 'auto',
                                height: 'auto',
                                events: [
                                    @foreach ($attendances as $attendance)
                                        {
                                            title: '{{ $attendance->lecture->title }}',
                                            start: '{{ $attendance->marked_at->format('Y-m-d H:i:s') }}',
                                            allDay: true,
                                            backgroundColor: '#594f8d', // Set your desired background color
                                            borderColor: '#594f8d',

                                        },
                                    @endforeach
                                ]
                            });

                            calendar.render();
                        });
                    </script>

                </div>

            </div>











            {{--
            <div class="container">
                <h3>Enter One-Time Code for Attendance</h3>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('attendance_mark') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="one_time_code" class="form-label">One-Time Code</label>
                        <input type="text" class="form-control" id="one_time_code" name="one_time_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> --}}

        </div>
    </div>









</x-app-layout>
