
@if (count($articles) > 0)

    @foreach ($articles as $article)
        <!-- Post preview -->
        <div class="post-preview">
            <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
                <h2 class="post-title">{{ $article->title }}</h2>
                <img src="{{ $article->image }}" width="800" height="400" style="object-fit: cover;">
                <h3 class="post-subtitle">{!! Str::limit($article->content, 60) !!}</h3>
            </a>
            <p class="post-meta d-flex justify-content-between">
                <span>Kategori: <a href="#!">{{ $article->getCategory->name }}</a></span>
                <span>{{ $article->created_at->diffForHumans() }}</span>
            </p>
        </div>

        @if (!$loop->last)
            <hr>
        @endif

    @endforeach

    <div class="d-flex justify-content-center">
        {{ $articles->links('pagination::bootstrap-4') }}
    </div>

@else

    <div class="alert alert-danger">
        <h1>Bu kategoride yazı bulunmuyor</h1>
    </div>

@endif

