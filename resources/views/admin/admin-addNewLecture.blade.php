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
                        <h1>Add Lecture</h1>


                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        {{-- @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif --}}


                        <form action="{{ route('add_lecture') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_code" class="form-label">Course Code</label>
                                <input type="text" name="code" class="form-control" id="course_code"
                                       value="{{ old('course_code') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            </div>

                            <div id="schedules">
                                <div class="schedule mb-3">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="day" class="form-label">Day</label>
                                            <select name="day[]" class="form-control" required>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="start_time" class="form-label">Start Time</label>
                                            <input type="time" name="start_time[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_time" class="form-label">End Time</label>
                                            <input type="time" name="end_time[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="button" class="btn btn-danger mt-2" onclick="removeSchedule(this)">Remove</button>
                                        </div>
                                    </div>





                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary mb-3" onclick="addSchedule()">Add Another Time</button>
                            <br>

                            <button type="submit" class="btn mt-5" style="background-color: #e84424; color:#fff">Add Lecture</button>
                        </form>

                        <template id="schedule-template">
                            <div class="schedule mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="day" class="form-label">Day</label>
                                        <select name="day[]" class="form-control" required>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" name="start_time[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" name="end_time[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="button" class="btn btn-danger mt-2" onclick="removeSchedule(this)">Remove</button>
                                    </div>
                                </div>

                            </div>
                        </template>

                        <script>
                            function addSchedule() {
                                const scheduleTemplate = document.getElementById('schedule-template').content.cloneNode(true);
                                document.getElementById('schedules').appendChild(scheduleTemplate);
                            }

                            function removeSchedule(button) {
                                button.closest('.schedule').remove();
                            }
                        </script>























                        {{-- <form action="{{ route('add_lecture') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_code" class="form-label">Course Code</label>
                                <input type="text" name="code" class="form-control" id="course_code"
                                    value="{{ old('course_code') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" name="start_time" class="form-control" id="start_time" value="{{ old('start_time') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" name="end_time" class="form-control" id="end_time" value="{{ old('end_time') }}" required>
                                    </div>
                                </div>
                            </div>




                            <button type="submit" class="btn " style="background-color: #e84424; color:#ffff">Add
                                Lecture</button>
                        </form> --}}
                    </div>


                </div>
            </div>




        </div>


    </body>

    </html>



</x-app-layout>
