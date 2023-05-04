<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links() }}{{-- es parte de la pagiancion --}}
        </div>
    @else
        <p class="text-center">No hay post</p>
    @endif
</div>