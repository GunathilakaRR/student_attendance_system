


<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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


        aside {

        }
    </style>

    <div class="container1">
        @include('admin.admin-sidebar') <!-- Include the sidebar from the lecturer folder -->

        <div class="home-section">
            <!-- Your home section content -->
            <button class="btn"  style="background-color: #e84424; color:white">Add Lecturer</button>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Lecturer ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">E mail</th>
                    {{-- <th scope="col">Profile</th> --}}
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($lecturers as $lecturer)
                    <tr>
                        {{-- <td>{{ $student->registration_number }}</td> --}}
                        <td>{{ $lecturer->name1 }}</td>
                        <td>{{ $lecturer->name2 }}</td>
                        <td>{{ $lecturer->email }}</td>
                        <td>profile</td>
                        <td>
                          <a href="#"><i class="fas fa-edit btn btn-primary"></i></a>
                          <a href="#"><i class="fas fa-trash-alt btn btn-danger"></i></a>
                          <a href="#"><i class="fas fa-eye btn btn-success"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>









</x-app-layout>



