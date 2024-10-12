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

                .page-item.active .page-link {
                    background-color: red !important;
                    border-color: red !important;
                    color: white !important;
                }

                .page-link {
                    color: black !important;
                }
            </style>

            <div class="container1">
                @include('admin.admin-sidebar')

                <div class="home-section">

                    <a href="{{ route('add-newLecture') }}">
                        <button class="btn mb-5" style="background-color: #e84424; color: #ffff">Add New
                            Lecture</button>
                    </a>



                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Lecturer</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($lectures as $lecture)
                                    <tr>
                                        <td style="text-transform: uppercase">{{ $lecture->code }}</td>
                                        <td style="text-transform: uppercase">{{ $lecture->title }}</td>
                                        <td>
                                            @if ($lecture->lecturers->isEmpty())
                                                <em>No lecturers assigned</em>
                                            @else
                                                @foreach ($lecture->lecturers as $lecturer)
                                                    <span style="text-transform: capitalize">{{ $lecturer->name1 }}
                                                        {{ ' ' }} {{ $lecturer->name2 }}</span><br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('assign-lecturer/' . $lecture->id) }}"><i
                                                    class="fas fa-edit btn btn-primary"
                                                    title="Assign a Lecturer"></i></a>
                                            <a href="{{ route('delete-lecture', $lecture->id) }}"><i
                                                    class="fas fa-trash-alt btn btn-danger" title="Delete"></i></a>
                                            <a href="{{ route('view-lecture-info-', $lecture->code) }}"><i
                                                    class="fas fa-eye btn btn-success" title="View More"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $lectures->links() }}
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </body>

    </html>
</x-app-layout>
