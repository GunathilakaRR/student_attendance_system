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
                        <h2 style="text-transform: uppercase; font-size: 50px;">{{ $student->name }}'s Marks</h2>

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

                            @if (!empty($feedback))
                                <div class="feedback">
                                    <h3>Feedback for Low Marks</h3>
                                    <ul>
                                        @foreach ($feedback as $subject => $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($playlists))
                                <div class="playlists">
                                    <h3>Recommended Playlists</h3>
                                    @foreach ($playlists as $subject => $playlistList)
                                        <h4>{{ ucfirst(str_replace('_', ' ', $subject)) }}</h4>
                                        <ul>
                                            @foreach ($playlistList as $playlist)
                                                <li>
                                                    <a href="https://www.youtube.com/playlist?list={{ $playlist['id']['playlistId'] }}" target="_blank">{{ $playlist['snippet']['title'] }}</a>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @else
                            <p>No marks found for this student.</p>
                        @endif
                    </div>

                    {{-- <div class="container mt-5" >
                        <h2 style="text-transform: uppercase; font-size: 20px;">{{ $student->name1 }}'s Marks</h2>


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

                            @if (!empty($feedback))
                                <div class="feedback mt-5">

                                    <p>
                                        @foreach ($feedback as $subject => $message)
                                            <h3 style="text-transform: capitalize;">Hello {{ $student->name1 }}, {{ $message }}  <br>
                                                <p class="mt-2">Don't worry, Let's do these courses recommended by Udemy platform to get high marks for next exam. <i class="fa-solid fa-face-smile-beam fa-bounce fa-xl" style="color: #594f8d;"></i></i></p> </h3>
                                        @endforeach
                                    </p>
                                </div>
                            @endif
                        @else
                            <p>No marks found for this student.</p>
                        @endif
                    </div> --}}


                </div>
            </div>
    </body>

    </html>



</x-app-layout>
