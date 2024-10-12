<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


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

        .page-item.active .page-link {
            background-color: red !important;
            border-color: red !important;
            color: white !important;
        }

        .page-link {
            color: black !important;
        }


        aside {}
    </style>

    <div class="container1">
        @include('admin.admin-sidebar')

        <div class="home-section">
            

            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Lecturer ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">E mail</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($lecturers as $lecturer)
                            <tr>

                                <td>{{ $lecturer->user_id }}</td>
                                <td style="text-transform: uppercase">{{ $lecturer->name1 }}</td>
                                <td style="text-transform: uppercase">{{ $lecturer->name2 }}</td>
                                <td>{{ $lecturer->email }}</td>
                                <td>
                                    @if ($lecturer->image)
                                        <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; "
                                            src="{{ asset('storage/' . $lecturer->image) }}" alt="Profile Picture">
                                    @else
                                        <img style="object-fit: cover; border-radius: 50%; width: 50px; height: 50px; "
                                            src="{{ asset('images/default_profile.jpg') }}"
                                            alt="Default Profile Picture">
                                    @endif
                                </td>
                                <td>
                                    <a href="#"><i class="fas fa-edit btn btn-primary"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt btn btn-danger"></i></a>
                                    <a href="{{ url('admin_viewLecturer/' . $lecturer->id) }}"><i
                                            class="fas fa-eye btn btn-success"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $lecturers->links() }}
                </div>
            </div>


        </div>
    </div>









</x-app-layout>
