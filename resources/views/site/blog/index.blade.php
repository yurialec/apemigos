@include('site.blog.partials.app_blog')

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->

            @if (isset($blogs) && $blogs)
                @foreach ($blogs as $blog)
                    <div class="post-preview">
                        <a href="{{ route('site.blog.post', $blog->id) }}">
                            <h2 class="post-title">{{ $blog->title }}</h2>
                            <img src="{{ asset('storage/' . $blog->images[0]->image_path) }}"
                                style="width: 100%;  border-radius: 10px;  object-fit: cover;">
                        </a>
                        <p class="post-meta">
                            Criado por <u>{{ $blog->user->name }}</u>
                            em {{ $blog->created_at->translatedFormat('d F, Y') }}
                        </p>
                    </div>
                    <hr class="my-4" />
                @endforeach
            @else
                <p class="post-meta">Desculpe, ainda não temos blogs cadastrador :/</p>
            @endif


            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older
                    Posts →</a></div>
        </div>
    </div>
</div>
