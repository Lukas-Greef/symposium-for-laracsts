
<body>
   <div class="article">
     @if ($post)
       <h1>{{ $post->title }}</h1>
       <div>
         {!! $post->body !!}
       </div>
     @else
       <p>Post niet gevonden.</p>
     @endif
     <a href="/">Go Back</a>
   </div>
</body>

