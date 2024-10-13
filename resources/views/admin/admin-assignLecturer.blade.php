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
                @include('admin.admin-sidebar')

                <div class="home-section">

                    <a href="javascript:history.back()" class="btn" style="background-color: #e84424;">
                        <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                    </a>

                    <div class="container mt-5">
                        <h1>Assign Lecturer to Lecture</h1>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('assign-lecturer') }}" method="POST">
                            @csrf
                            <div class="mb-3">

                                <div><label class="labels">Selected Lecture</label>
                                    <input type="hidden" class="form-control" value="{{ $lectures->id }}" name="lecture_id">
                                    <input type="text" class="form-control"
                                        value="{{ $lectures->code }} {{ $lectures->title }}"
                                        style="text-transform: uppercase;" disabled>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="lecturer" class="form-label">Select Lecturer</label>
                                <select class="form-select" id="lecturer" name="lecturer_id" required>
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id }}">
                                            {{ $lecturer->name1 }}{{ ' ' }}{{ $lecturer->name2 }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn" style="background-color: #e84424; color: #ffff">Assign
                                Lecturer</button>
                        </form>
                    </div>


                </div>
            </div>

        </div>
    </body>



    </html>



</x-app-layout>
