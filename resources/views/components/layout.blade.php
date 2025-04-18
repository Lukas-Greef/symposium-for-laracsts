
<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    html{
        scroll-behavior: smooth;
    }
</style>
<body style="font-family: Open Sans, sans-serif">

    <section class="px-4 py-4">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <div class="text-4xl" style="color: oklch(0.769 0.188 70.08)">Restaurant</div>
                </a>
            </div>

            <div class="mt-8 md:mt-0">
                <a href="{{ route('comment.create') }}" class="mr-4 font-bold text-xs underline">Comment</a>
                <a href="/register" class="mr-4 font-bold text-xs underline">Register</a>
                <a href="/" class="text-xs font-bold uppercase underline">Home Page</a>

            </div>
        </nav>

       {{$slot}}

        <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <h5 class="text-3xl">Blijf op de hoogte van nieuwe gerechten!</h5>
            <p class="text-sm mt-3">Geen spam, of reclame.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                placeholder="Your email address"
                                class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit"
                                style="background-color: oklch(0.769 0.188 70.08);"
                                class=" transition-colors duration-300  mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>
</body>

