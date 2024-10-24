@include('site.blog.partials.app_blog')
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{ asset('/storage/' . $blog->images[0]->image_path) }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $blog->title }}</h1>
                    {{-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> --}}
                    <span class="meta">
                        Criado por <u>{{ $blog->user->name }}</u>
                        em {{ $blog->created_at->translatedFormat('d F, Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>{{ $blog->description }}</p>

                @foreach ($blog->images as $item)
                <img style="margin-bottom: 15px" class="img-fluid" src="{{ asset('storage/' . $item->image_path) }}" alt="..." />
                @endforeach
            </div>
        </div>
    </div>
</article>
