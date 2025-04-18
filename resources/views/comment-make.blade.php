<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuwe Comment
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('comment.store') }}">
        @csrf
        <label for="body">Comment:</label>
        <textarea name="body" id="body" rows="4" class="border border-gray-300 p-2 w-full rounded" required></textarea>
        @error('body')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mt-4">
            Add Comment
        </button>
    </form>

</x-app-layout>
