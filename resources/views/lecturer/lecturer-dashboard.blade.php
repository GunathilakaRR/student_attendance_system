
<x-app-layout>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lecturer Dashboard') }}
        </h2>
    </x-slot> --}}

    <style>
        .container {
            display: flex;
        }

        .home-section {
            flex: 1;
            padding: 20px; /* Adjust padding as needed */
        }

        /* Adjust the styles for the sidebar as needed */
        aside {
            /* Your existing sidebar styles */
        }
    </style>

    <div class="container">
        @include('lecturer.lecturer-sidebar') <!-- Include the sidebar from the lecturer folder -->

        <div class="home-section">
            <!-- Your home section content -->
            <p>Content goes here</p>
        </div>
    </div>

</x-app-layout>



