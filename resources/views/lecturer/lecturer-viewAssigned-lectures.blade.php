<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

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



        aside {}
    </style>

    <div class="container1">
        @include('lecturer.lecturer-sidebar')

        <div class="home-section">

            <div style="width: 80%; margin: 0 auto; margin-top: 50px;">
                <h1 style="text-align: left; text-transform: capitalize;">Assigned Lectures for {{ $lecturer->name1 }} {{ $lecturer->name2 }}</h1>
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #dee2e6;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="border: 1px solid #dee2e6; padding: 8px;">Time</th>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                <th style="border: 1px solid #dee2e6; padding: 8px;">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($hour = 8; $hour <= 18; $hour++)
                            <tr>
                                <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $hour }}:00 - {{ $hour + 1 }}:00</td>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                    <td style="border: 1px solid #dee2e6; padding: 8px;">
                                        @foreach ($lecturer->lectures as $lecture)
                                            @if ($lecture->day_of_week == $day && date('H', strtotime($lecture->start_time)) == $hour)
                                                <div style="padding: 5px; background-color: #e9ecef; margin-bottom: 5px; border-radius: 4px;">
                                                    <strong>{{ $lecture->title }}</strong><br>
                                                    {{ date('H:i', strtotime($lecture->start_time)) }} - {{ date('H:i', strtotime($lecture->end_time)) }}
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

        </div>
    </div>









</x-app-layout>
