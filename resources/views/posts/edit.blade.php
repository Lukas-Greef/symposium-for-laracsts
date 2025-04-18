<x-layout>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Bewerken Gerecht
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Pas hier de informatie van het gerecht aan.
            </p>
        </header>

        <form method="POST" action="{{ route('posts.update', $post) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <!-- Title -->
            <div>
                <x-input-label for="title" value="Titel" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                              :value="old('title', $post->title)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <!-- Slug -->
            <div>
                <x-input-label for="slug" value="Slug" />
                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                              :value="old('slug', $post->slug)" required />
                <x-input-error class="mt-2" :messages="$errors->get('slug')" />
            </div>

            <!-- Body -->
            <div>
                <x-input-label for="body" value="Beschrijving" />
                <textarea id="body" name="body" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded">{{ old('body', $post->body) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
            </div>

            <!-- Prijs -->
            <div>
                <x-input-label for="prijs" value="Prijs" />
                <x-text-input id="prijs" name="prijs" type="number" step="0.01" class="mt-1 block w-full"
                              :value="old('prijs', $post->prijs)" required />
                <x-input-error class="mt-2" :messages="$errors->get('prijs')" />
            </div>

            <!-- Category -->
            <div>
                <x-input-label for="category_id" value="Categorie" />
                <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
            </div>

            <!-- Save button -->
            <div class="flex items-center gap-4">
                <x-primary-button>Opslaan</x-primary-button>

                @if (session('status') === 'post-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                       class="text-sm text-gray-600">Opgeslagen.</p>
                @endif
            </div>
        </form>
    </section>
</x-layout>
