<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('failed'))
        <div class="bg-red-500 w-full h-20 text-red-200">
            <p class="p-4">
                {{ session('failed') }}
            </p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <table class="w-full bg-gray-800 ">
                <tr>
                    <th>Attendance Id</th>
                    <th>User Id</th>
                    <th>Student Name</th>
                    <th>Day</th>
                    <th>Time</th>
                </tr>
                
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->user_id }}</td>
                        <td>{{ $attendance->student_name }}</td>
                        <td>{{ $attendance->created_at->format('d M Y, l') }}</td>
                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
