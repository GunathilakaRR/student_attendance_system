<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            padding: 0;
            display: flex;
        }

        .home-section {
            flex: 1;
            padding: 20px; /* Adjust padding as needed */
        }

        /* Adjust the styles for the sidebar as needed */
        aside {
            /* Your existing sidebar styles */
        }
    </style>

    <div class="container" style="margin:0px 0px; padding:0px 0px;">
        @include('student.student-sidebar') <!-- Include the sidebar from the lecturer folder -->

        <div class="home-section">
            <!-- Your home section content -->
            {{-- <p>Content goes here</p> --}}

            <div class="main_content">
                <h1 style="font-size: 27px;" >Hello <span style="text-transform: capitalize;">{{ Auth::user()->student->name1 }},</span>  Welcome Back !! <i class="fa-solid fa-hand fa-xl fa-bounce" style="color: #594f8d;"></i></h1>
            </div>




            <div class="row">
                <div class="col-md-10">
                    <div class="mt-5">
                        <h2>Time Table</h2>


                        {{-- @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif --}}



                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Title</th>
                                    <th>Day of the Week</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lectures as $lecture)
                                    @foreach ($lecture->schedules as $schedule)
                                        <tr>
                                            @if ($loop->first) <!-- Show lecture details only for the first schedule -->
                                                <td rowspan="{{ $lecture->schedules->count() }}">{{ $lecture->code }}</td>
                                                <td rowspan="{{ $lecture->schedules->count() }}">{{ $lecture->title }}</td>
                                            @endif
                                            <td>{{ $schedule->day }}</td>
                                            <td>{{ $schedule->formatted_start_time }}</td>
                                            <td>{{ $schedule->formatted_end_time }}</td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5">No registered lectures.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                        {{-- <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #dee2e6;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th style="border: 1px solid #dee2e6; padding: 8px;">Time</th>
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <th style="border: 1px solid #dee2e6; padding: 8px;">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($hour = 8; $hour <= 18; $hour++)
                                    <tr>
                                        <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $hour }}:00 - {{ $hour + 1 }}:00</td>
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <td style="border: 1px solid #dee2e6; padding: 8px;">
                                                @foreach ($lectures as $lecture)
                                                    @foreach ($lecture->schedules as $schedule)
                                                        @if ($schedule->day == $day && date('H', strtotime($schedule->start_time)) <= $hour && date('H', strtotime($schedule->end_time)) > $hour)
                                                            <div style="padding: 5px; background-color: #e9ecef; margin-bottom: 5px; border-radius: 4px;">
                                                                <strong>{{ $lecture->title }}</strong><br>
                                                                {{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table> --}}



                    </div>
                </div>
            </div>




        </div>
    </div>

</x-app-layout>
