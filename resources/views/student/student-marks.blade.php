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
                @include('student.student-sidebar')

                <div class="home-section">


                    <div class="container">
                        <h1>Marks for {{ $student->name1 }}</h1>

                        @if ($marks)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Marks</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Subject 1</td>
                                        <td>{{ $marks->subject1_marks }}</td>
                                        <td>{{ $grades['subject1_grade'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject 2</td>
                                        <td>{{ $marks->subject2_marks }}</td>
                                        <td>{{ $grades['subject2_grade'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject 3</td>
                                        <td>{{ $marks->subject3_marks }}</td>
                                        <td>{{ $grades['subject3_grade'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject 4</td>
                                        <td>{{ $marks->subject4_marks }}</td>
                                        <td>{{ $grades['subject4_grade'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Subject 5</td>
                                        <td>{{ $marks->subject5_marks }}</td>
                                        <td>{{ $grades['subject5_grade'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div>
                                <strong>No marks found for this student.</strong>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
    </body>

    </html>



</x-app-layout>
