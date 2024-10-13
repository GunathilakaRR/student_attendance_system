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
                @include('admin.admin-sidebar')

                <div class="home-section">

                    <a href="javascript:history.back()" class="btn" style="background-color: #e84424;">
                        <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                    </a>


                    {{-- <h2>{{ Auth::user()->student->name1 }}</h2> --}}
                    <div class="container rounded bg-white mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    @if ($students->image)
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('storage/' . $students->image) }}" alt="Profile Picture">
                                    @else
                                        <img style="object-fit: cover; border-radius: 50%; width: 150px; height: 150px; "
                                            src="{{ asset('images/default_profile.jpg') }}"
                                            alt="Default Profile Picture">
                                    @endif


                                    <span style="text-transform: uppercase;">{{ $students->name1 }}</span>
                                    <span style="text-transform: uppercase;">{{ $students->registration_number }}</span>
                                </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 style="text-transform: capitalize;" class="text-right">
                                            {{ $students->name1 }}'s Profile</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">First Name</label><input
                                                type="text" class="form-control" placeholder="first name"
                                                value="{{ $students->name1 }}" style="text-transform: capitalize;">
                                        </div>
                                        <div class="col-md-6"><label class="labels">Last Name</label><input
                                                type="text" class="form-control" value="{{ $students->name2 }}"
                                                placeholder="last name" style="text-transform: capitalize;"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Registration No.</label><input
                                                type="text" class="form-control" placeholder="registration number"
                                                value="{{ $students->registration_number }}"
                                                style="text-transform: uppercase;"></div>
                                        <div class="col-md-6"><label class="labels">Email</label><input type="email"
                                                class="form-control" value="{{ $students->email }}" placeholder="email">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            
                        </div>

                        <div class="row">
                            <h4 class="mt-5" style="margin-left: 70px;">Attendance Summary</h4>
                        </div>
                        <div class="row mt-3">
                            @foreach ($attendanceCounts as $lecture => $counts)
                                <div class="col-md-3 mb-4"> <!-- Adjusted column class for four charts per row -->

                                    <h5 class="text-center" style="text-transform: uppercase;">{{ $lecture }}</h5>
                                    <div style="position: relative; height: 150px; width: 150px; margin: auto;">
                                        <canvas id="attendanceChart{{ str_replace(' ', '_', $lecture) }}"></canvas>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const ctx = document.getElementById('attendanceChart{{ str_replace(' ', '_', $lecture) }}').getContext(
                                                '2d');
                                            const attendanceData = {
                                                labels: ['Sessions Attended', 'Sessions Missed'],
                                                datasets: [{
                                                    data: [
                                                        {{ $counts['attended'] }},
                                                        {{ $counts['missed'] }}
                                                    ],
                                                    backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                                                }]
                                            };
                                            new Chart(ctx, {
                                                type: 'pie',
                                                data: attendanceData,
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'top',
                                                        },
                                                        title: {
                                                            display: true,
                                                            text: 'Attendance Summary for {{ $lecture }}'
                                                        }
                                                    },
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            @endforeach
                        </div>





                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
    </body>

    </html>
</x-app-layout>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
