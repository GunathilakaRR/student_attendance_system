<x-app-layout>


    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot> --}}


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">




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

                    {{-- <form method="GET" action="{{ route('selectYear') }}">
                        <div class="mb-3">
                            <label for="year" class="form-label">Select Year:</label>
                            <select class="form-select" id="year" name="year">
                                <option value="all">All</option>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}">Year {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form> --}}

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Reg No</th>
                                <th scope="col">First Name</th>
                                {{-- <th scope="col">Last Name</th> --}}
                                <th scope="col">E mail</th>
                                <th scope="col">Profile</th>
                                <th scope='col'>Year</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $student)
                                <tr>
                                    <td style="text-transform: uppercase">{{ $student->registration_number }}</td>
                                    <td style="text-transform: uppercase">{{ $student->name1 }}</td>
                                    {{-- <td>{{ $student->name2 }}</td> --}}
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        @if ($student->image)
                                            <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; " src="{{ asset('storage/' . $student->image) }}" alt="Profile Picture">
                                        @else
                                            <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; " src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile Picture">
                                        @endif
                                    </td>
                                    <td>4th yr</td>
                                    <td>
                                        <a href="#"><i class="fas fa-edit btn btn-primary"></i></a>
                                        <a href="#"><i class="fas fa-trash-alt btn btn-danger"></i></a>
                                        <a href="{{ url('admin-viewStudent/' . $student->id) }}"><i
                                                class="fas fa-eye btn btn-success"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>

    </html>



</x-app-layout>
