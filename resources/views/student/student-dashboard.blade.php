<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .container1 {
            display: flex;
        }

        .home-section {
            flex: 1;
            padding: 20px;
        }

        /* .attendance-chart-container-outer:hover {
            transform: scale(1.1);
            transition: transform 0.2s;
        } */

        aside {}
    </style>

    <div class="container1" style="margin: 0; padding: 0; width: 100%;">
        @include('student.student-sidebar') <!-- Include the sidebar from the lecturer folder -->

        <div class="home-section">
            <!-- Your home section content -->
            <div class="main_content">
                <h1 style="font-size: 27px;">
                    Hello <span style="text-transform: capitalize;">{{ Auth::user()->student->name1 }}</span>, Welcome
                    Back !!
                    <i class="fa-solid fa-hand fa-xl fa-bounce" style="color: #594f8d;"></i>
                </h1>
            </div>

            <div style="padding: 0 40px 0 40px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5">
                            <h2 style="font-size: 30px;">Time Table</h2>
                            <table class="table table-bordered"
                                style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Title</th>
                                        <th>Day</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lectures as $lecture)
                                        @foreach ($lecture->schedules as $schedule)
                                            <tr>
                                                @if ($loop->first)
                                                    <!-- Show lecture details only for the first schedule -->
                                                    <td rowspan="{{ $lecture->schedules->count() }}">
                                                        {{ $lecture->code }}</td>
                                                    <td rowspan="{{ $lecture->schedules->count() }}">
                                                        {{ $lecture->title }}</td>
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
                        </div>
                    </div>





                    <div class="col-md-8">
                        <h2 style="font-size: 30px;" class="mt-5">Attendance Report</h2>
                        <div class="row">
                            @forelse ($lectures as $lecture)
                                <div class="attendance-chart-container-outer col-12 col-sm-6 col-md-4 col-lg-4 mt-3"
                                    style="box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                                    <div class="attendance-chart-container mb-4" style="padding: 10px;">
                                        <h3>{{ $lecture->title }}</h3>
                                        <div style="position: relative; height:150px; width:150px; margin: 0 auto;">
                                            <canvas id="attendanceChart{{ $lecture->id }}"></canvas>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const ctx = document.getElementById('attendanceChart{{ $lecture->id }}').getContext('2d');
                                                const chartData = {
                                                    labels: ['Sessions Attended', 'Sessions Missed'],
                                                    datasets: [{
                                                        data: [
                                                            {{ $lecture->attendance_data['sessions_attended'] }},
                                                            {{ $lecture->attendance_data['sessions_missed'] }}
                                                        ],
                                                        backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                                                    }]
                                                };
                                                new Chart(ctx, {
                                                    type: 'pie',
                                                    data: chartData,
                                                    options: {
                                                        responsive: true,
                                                        maintainAspectRatio: false,
                                                        plugins: {
                                                            legend: {
                                                                position: 'top',
                                                            },
                                                            title: {
                                                                display: true,
                                                                text: 'Attendance Report for {{ $lecture->title }}'
                                                            }
                                                        },
                                                        animation: {
                                                            animateScale: true,
                                                            animateRotate: true
                                                        }
                                                    },
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            @empty
                                <p>No registered lectures.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
