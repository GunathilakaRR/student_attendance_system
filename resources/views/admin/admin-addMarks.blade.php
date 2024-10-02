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
            </style>

            <div class="container1">
                @include('admin.admin-sidebar')

                <div class="home-section">
                    <div class="container">



                         @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                         <div class="card my-5">
                            <div class="card-header">
                                <h4>Import Exam Marks Excel File</h4>
                            </div>
                            <div class="card-body ">
                                <form action="{{ route('add-marks') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="input-group">
                                        <input type="file" name="import_file" class="form-control">
                                        <button type="submit" class="btn"
                                            style="background-color: #e84424; color: #ffff">Submit File</button>
                                    </div>

                                </form>
                            </div>
                        </div>



                        <table class="table my-5">
                            <thead>
                                <tr>
                                    <th scope="col">Registratin Number</th>
                                    <th scope="col">Python</th>
                                    <th scope="col">Java</th>
                                    <th scope="col">PHP</th>
                                    <th scope="col">Javascript</th>
                                    <th scope="col">C++</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr>
                                        <td style="text-transform: uppercase">{{ $mark->registration_number }}</td>
                                        <td>{{ $mark->subject1_marks }}</td>
                                        <td>{{ $mark->subject2_marks }}</td>
                                        <td>{{ $mark->subject3_marks }}</td>
                                        <td>{{ $mark->subject4_marks }}</td>
                                        <td>{{ $mark->subject5_marks }}</td>
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
