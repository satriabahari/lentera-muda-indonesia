<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800">Students List</h1>

        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Phone</th>
                    <th class="py-2 px-4 border">School</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr class="border">
                        <td class="py-2 px-4 border">{{ $student->name }}</td>
                        <td class="py-2 px-4 border">{{ $student->email }}</td>
                        <td class="py-2 px-4 border">{{ $student->phone }}</td>
                        <td class="py-2 px-4 border">{{ $student->school_name }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('student.show', $student->id) }}"
                                class="text-blue-500 hover:underline">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
