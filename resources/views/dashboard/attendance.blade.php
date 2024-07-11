<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture Attendance Trends</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="attendanceChart" width="800" height="400"></canvas>

    <script>
        // PHP variables to JavaScript
        const lectureDates = @json($lectureDates);
        const attendanceData = @json($attendanceData);

        // Chart initialization
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: lectureDates,
                datasets: [{
                    label: 'Attendance Trends',
                    data: attendanceData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Area fill color
                    borderColor: 'rgba(54, 162, 235, 1)', // Line color
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'MMM DD'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Lecture Dates'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Attendance Count'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend for this example
                    }
                }
            }
        });
    </script>
</body>
</html>
