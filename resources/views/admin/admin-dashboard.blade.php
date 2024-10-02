<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .container1 {
            display: flex;
        }

        .home-section {
            flex: 1;
            padding: 20px;
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>

    <div class="container1">
        @include('admin.admin-sidebar')

        <div class="home-section">







            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            No. Of Students</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studentCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-children fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            No. Of Lecturers</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lecturerCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-tie fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Departments</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-6 card1 border-left-warning shadow  py-5 mr-5" >
                        <!-- Canvas element for the bar chart -->
                        <h3 >Exam Performance</h3>
                        <canvas  id="averageMarksChart"></canvas>
                        <!-- Your existing dashboard content -->
                        <div>
                            <p style="font-size: 20px;">No. of Students: {{ $studentCount }}</p>
                        </div>
                    </div>

                    <div class="col-md-5 card1 border-left-warning shadow  py-5 ">
                        <!-- Canvas element for the bar chart -->
                        <h3 >Attendance Performance</h3>
                        <canvas class="mt-5" id="attendanceBarChart"></canvas>
                        <div>
                            <p>Students: {{ $studentCount }}</p>
                            <p>Lecturers: {{ $lecturerCount }}</p>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>




    {{-- 1st chart --}}
    <script>
        // Prepare data for the chart
        const averageMarks = @json($averageMarks);
        const labels = ['Python', 'Java', 'PHP', 'Javascript', 'C++'];
        const data = [
            averageMarks.subject1_avg,
            averageMarks.subject2_avg,
            averageMarks.subject3_avg,
            averageMarks.subject4_avg,
            averageMarks.subject5_avg
        ];

        // Create the bar chart
        const ctx = document.getElementById('averageMarksChart').getContext('2d');
        const averageMarksChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Average Marks',
                    data: data,
                    backgroundColor: 'rgba(232, 68, 36, 0.2)',
                    borderColor: 'rgba(232, 68, 36, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    {{-- 2nd chart --}}
    <script>
        // Prepare data for the bar chart
        const attendanceCounts = @json($attendanceCounts);
        const lectureLabels = Object.keys(attendanceCounts);
        const lectureData = Object.values(attendanceCounts);

        // Create the bar chart
        const ctxBar = document.getElementById('attendanceBarChart').getContext('2d');
        const attendanceBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: lectureLabels,
                datasets: [{
                    label: 'Number of Students Attending',
                    data: lectureData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>




</x-app-layout>
