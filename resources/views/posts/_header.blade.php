
<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl" style="color: oklch(0.769 0.188 70.08) ">
         Restaurant
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
            <x-category-dropdown/>

        </div>

        <!-- Other Filters -->


        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{request('category')}}">
                @endif
                <input
                        type="text"
                        name="search"
                        placeholder="Find something"
                        class="bg-transparent placeholder-black font-semibold text-sm"
                        value="{{request('search')}}">

            </form>
        </div>

    </div>
</header>
