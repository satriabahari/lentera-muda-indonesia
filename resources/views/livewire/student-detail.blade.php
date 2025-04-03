<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800">{{ $student->name }}</h1>
        <p class="text-gray-600 mt-2">{{ $student->email }}</p>

        <div class="mt-4">
            <p><strong>Phone:</strong> {{ $student->phone }}</p>
            <p><strong>Address:</strong> {{ $student->address }}</p>
            <p><strong>School:</strong> {{ $student->school_name }}</p>
            <p><strong>School Address:</strong> {{ $student->school_address }}</p>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('student') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a>
            <button wire:click="edit({{ $student->id }})"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</button>
        </div>
    </div>
</x-app-layout>
