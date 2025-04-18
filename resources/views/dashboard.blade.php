<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- Check if the user is an admin and show the link to make.blade.php --}}
                    @if(auth()->user() && auth()->user()->name === 'appel')
                        <a href="{{ route('posts.create') }}" class="text-blue-500 underline">Maak gerecht</a>
                    @endif

                    {{-- Alle comments tonen --}}
                    @foreach($comments as $comment)
                        <div class="border-b border-gray-200 py-4 mt-4">
                            <p class="text-gray-800">{{ $comment->body }}</p>
                            <p class="text-sm text-gray-500">
                                Geplaatst op {{ $comment->created_at->format('d-m-Y H:i') }}
                                @if($comment->author)
                                    door {{ $comment->author->name }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
