<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <script src=/app.js></script>
    <title>Home</title>
</head>

<body>
    @foreach ($posts as $post)
            <div class="article">
                <h1>
                    <a href="/posts/{{ $post->slug}}">
                        {{ $post->title }}
                    </a>
                </h1>
            </div>
            <div>
                {{ $post->excerpt }}
            </div>
        @endforeach
</body>
</html>

