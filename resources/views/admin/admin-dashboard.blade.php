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

                <div class="row mb-5">
                    <!-- No. of Students Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
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

                    <!-- No. of Lecturers Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
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

                    <!-- Today's Time and Day Card -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Today's Date & Time</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <span id="currentDateTime"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>









                <div class="row">
                    <div class="col-md-5 card1 border-left-warning shadow  py-5 mr-5">
                        <!-- Canvas element for the bar chart -->
                        <h3>Exam Performance</h3>
                        <canvas id="averageMarksChart"></canvas>
                        <!-- Your existing dashboard content -->
                        <div>
                            <p style="font-size: 20px;">No. of Students: {{ $studentCount }}</p>
                        </div>
                    </div>


                    <div class="col-md-6 card1 border-left-warning shadow  py-5 ">
                        <h2 class="text-center mb-4">Attendance Trends Over Last 30 Days</h2>
                        <div style="position: relative; height: 300px; width: 100%; max-width: 800px; margin: auto;">
                            <canvas id="combinedAttendanceTrendsChart"></canvas>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>










    <!-- Script to Render the Combined Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('combinedAttendanceTrendsChart').getContext('2d');

            // Prepare attendance data for each lecture
            const lectureTitles = {!! json_encode(array_keys($attendanceTrends)) !!}; // Lecture titles
            const dates = {!! json_encode($last30Days) !!}; // Dates for the last 30 days
            const attendanceDataSets = []; // To store datasets for each lecture

            const colors = [
                'rgba(75, 192, 192, 1)', // Color 1
                'rgba(255, 99, 132, 1)', // Color 2
                'rgba(255, 206, 86, 1)', // Color 3
                'rgba(54, 162, 235, 1)', // Color 4
                'rgba(153, 102, 255, 1)', // Color 5
                'rgba(255, 159, 64, 1)' // Color 6
            ];

            // Create a dataset for each lecture with different colors
            lectureTitles.forEach((lecture, index) => {
                attendanceDataSets.push({
                    label: lecture,
                    data: {!! json_encode($attendanceTrends) !!}[lecture], // Attendance counts for this lecture
                    borderColor: colors[index % colors.length], // Use colors cyclically
                    backgroundColor: colors[index % colors.length],
                    fill: false, // Do not fill the area under the line
                    tension: 0.1 // Smoothness of the line
                });
            });

            // Create the combined line chart
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates, // X-axis labels (dates)
                    datasets: attendanceDataSets // All lecture datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Attendance Trends for All Lectures Over the Last 30 Days'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Start y-axis at 0
                            min: 0, // Minimum value of 0 on the y-axis
                            max: 10, // Default maximum value of 10
                            ticks: {
                                stepSize: 2, // Increment by 2
                                callback: function(value) {
                                    // Show only whole numbers on the y-axis
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Number of Students'
                            },
                            // Dynamically adjust the maximum value based on the data
                            suggestedMax: function(context) {
                                // Calculate the highest number of students in the dataset and adjust the max value
                                const maxData = context.chart.data.datasets.reduce((max, dataset) => {
                                    return Math.max(max, Math.max(...dataset.data));
                                }, 0);
                                return maxData > 10 ? maxData + 2 :
                                10; // Increase max by 2 if data exceeds 10
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Days (Last 30 Days)'
                            }
                        }
                    }
                }
            });
        });
    </script>





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



    {{-- script to display time date date --}}
    <script>
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', hour: '2-digit', minute: '2-digit', hour12: true };
            const formattedTime = now.toLocaleTimeString('en-US', options);
            document.getElementById('currentDateTime').innerText = formattedTime;
        }

        updateTime(); // Initial call
        setInterval(updateTime, 60000); // Update every minute
    </script>


</x-app-layout>
