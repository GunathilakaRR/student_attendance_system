<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lecturer Dashboard') }}
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

                <div class="row">
                    <div class="col-md-8">
                        <div style="box-shadow: 0 4px 8px rgba(0, 3, 1, 0.1); width: 100%;">
                            <h2 style="text-transform: capitalize; font-size: 30px;">{{ $lecturer->name1 }}
                                {{ $lecturer->name2 }}'s Lecture
                                Schedule</h2>
                        </div>


                        <table
                            style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #dee2e6; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th style="border: 1px solid #dee2e6; padding: 8px;">Time</th>
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <th style="border: 1px solid #dee2e6; padding: 8px;">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($hour = 8; $hour <= 18; $hour++)
                                    <tr>
                                        <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $hour }}:00 -
                                            {{ $hour + 1 }}:00</td>
                                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <td style="border: 1px solid #dee2e6; padding: 8px;">
                                                @foreach ($lecturer->lectures as $lecture)
                                                    @foreach ($lecture->schedules as $schedule)
                                                        @if ($schedule->day == $day && date('H', strtotime($schedule->start_time)) == $hour)
                                                            <div
                                                                style="padding: 5px; background-color: #e9ecef; margin-bottom: 5px; border-radius: 4px;">
                                                                <strong>{{ $lecture->title }}</strong><br>
                                                                {{ date('H:i', strtotime($schedule->start_time)) }} -
                                                                {{ date('H:i', strtotime($schedule->end_time)) }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <div style="padding: 0; display: flex; flex-direction: column; height: 100vh;">
                            <div class="header"
                                style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f8f9fa; border-bottom: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                {{-- <h1>Lecturer Dashboard</h1> --}}
                                <div id="date-time" style="font-size: 1.2em; font-weight: bold; color: #333;"></div>
                            </div>
                            <div class="calendar-container" style="flex: 1; padding: 20px;"
                                onmouseover="this.style.transform='scale(1.02)';"
                                onmouseout="this.style.transform='scale(1)';">
                                <div id="calendar"></div>
                            </div>
                        </div>

                        <script>
                            function updateDateTime() {
                                const now = new Date();
                                const options = {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit'
                                };
                                const formattedDateTime = now.toLocaleDateString('en-US', options);
                                document.getElementById('date-time').innerText = formattedDateTime;
                            }

                            $(document).ready(function() {
                                $('#calendar').fullCalendar({
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    defaultDate: new Date(),
                                    navLinks: true, // can click day/week names to navigate views
                                    editable: true,
                                    eventLimit: true, // allow "more" link when too many events
                                    events: [
                                        // Add events here if needed
                                    ]
                                });
                                setInterval(updateDateTime, 1000);
                                updateDateTime(); // Initial call to display date and time immediately
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>






</x-app-layout>
