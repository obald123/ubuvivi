@extends('layouts.guest')

@section('title') Blog - Ubuvivi Tours & Safaris @endsection
@section('meta')
<meta name="description" content="Latest news, events, and upcoming tours from Ubuvivi Tours & Safaris Rwanda.">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .blog-hero {
        position: relative;
        height: 420px;
        background: url('{{ asset("images/blog-hero.jpg") }}') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center; text-align: center;
    }
    .blog-hero::after { content:''; position:absolute; inset:0; background:rgba(13,31,53,.68); }
    .blog-hero-content { position:relative; z-index:2; color:#fff; }
    .blog-hero-content h1 { font-size:clamp(32px,5vw,58px); font-weight:800; color:#fff !important; text-shadow:0 2px 16px rgba(0,0,0,.4); margin-bottom:12px; }
    .blog-hero-content p  { font-size:17px; color:rgba(255,255,255,.85); max-width:520px; margin:0 auto; }

    /* ── Category filter ── */
    .blog-filters {
        display:flex; align-items:center; gap:10px; flex-wrap:wrap;
        padding:28px 0 0; margin-bottom:40px;
    }
    .filter-btn {
        padding:7px 18px; border-radius:50px; border:1.5px solid #e0e0e0;
        background:#fff; font-size:13px; font-weight:600; color:#666; cursor:pointer;
        transition:all .2s;
    }
    .filter-btn:hover, .filter-btn.active { background:#0D1F35; color:#fff; border-color:#0D1F35; }

    /* ── Featured post ── */
    .featured-post {
        display:grid; grid-template-columns:1.1fr 1fr; gap:0;
        border-radius:20px; overflow:hidden;
        box-shadow:0 8px 40px rgba(13,31,53,.12);
        margin-bottom:36px;
        text-decoration:none; color:inherit;
        transition:box-shadow .25s;
    }
    .featured-post:hover { box-shadow:0 16px 56px rgba(13,31,53,.18); text-decoration:none; color:inherit; }
    .featured-img {
        position:relative; overflow:hidden; min-height:360px;
    }
    .featured-img img {
        width:100%; height:100%; object-fit:cover; display:block;
        transition:transform .4s;
    }
    .featured-post:hover .featured-img img { transform:scale(1.04); }
    .featured-body {
        background:#162D1E; padding:36px 34px;
        display:flex; flex-direction:column; justify-content:center;
    }
    .featured-tag {
        display:inline-block; padding:4px 14px; border-radius:50px;
        font-size:12px; font-weight:700; letter-spacing:.8px; text-transform:uppercase;
        margin-bottom:18px; width:fit-content;
    }
    .featured-body h2 {
        font-size:clamp(22px,3vw,32px); font-weight:800; color:#fff !important;
        line-height:1.3; margin-bottom:16px;
    }
    .featured-excerpt {
        font-size:15px; color:rgba(255,255,255,.72); line-height:1.7; margin-bottom:24px;
    }
    .featured-meta {
        font-size:13px; color:rgba(255,255,255,.45); margin-bottom:28px;
    }
    .featured-link {
        display:inline-flex; align-items:center; gap:8px;
        background:#C85A2A; color:#fff; font-weight:600; font-size:14px;
        padding:12px 24px; border-radius:50px; text-decoration:none;
        transition:background .2s; width:fit-content;
    }
    .featured-link:hover { background:#a84520; color:#fff; text-decoration:none; }

    /* ── Grid ── */
    .blog-section-label {
        font-size:13px; font-weight:700; color:#999;
        text-transform:uppercase; letter-spacing:1.2px;
        margin-bottom:22px; padding-bottom:12px;
        border-bottom:2px solid #f0f0f0;
    }
    .blog-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; }
    @media(max-width:900px) { .blog-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:600px) { .blog-grid { grid-template-columns:1fr; } .featured-post { grid-template-columns:1fr; } .featured-img { min-height:260px; } }

    .blog-card {
        background:#fff; border-radius:16px; overflow:hidden;
        box-shadow:0 2px 18px rgba(13,31,53,.07);
        transition:transform .25s,box-shadow .25s;
        text-decoration:none; color:inherit; display:flex; flex-direction:column;
    }
    .blog-card:hover { transform:translateY(-5px); box-shadow:0 10px 36px rgba(13,31,53,.13); text-decoration:none; color:inherit; }
    .blog-card-img { width:100%; height:200px; object-fit:cover; display:block; }
    .blog-card-no-img { width:100%; height:200px; background:linear-gradient(135deg,#0D1F35,#1e3a5f); display:flex; align-items:center; justify-content:center; }
    .blog-card-no-img i { font-size:36px; color:rgba(255,255,255,.25); }
    .blog-card-body { padding:16px 18px 20px; flex:1; display:flex; flex-direction:column; }
    .blog-card-tag { display:inline-block; padding:3px 12px; border-radius:50px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.6px; margin-bottom:10px; }
    .blog-card-title { font-size:17px; font-weight:700; color:#0D1F35; line-height:1.4; margin-bottom:10px; }
    .blog-card-excerpt { font-size:13.5px; color:#666; line-height:1.6; margin-bottom:16px; flex:1; }
    .blog-card-footer { display:flex; align-items:center; justify-content:space-between; margin-top:auto; }
    .blog-card-date { font-size:12px; color:#aaa; }
    .blog-card-read { font-size:13px; font-weight:600; color:#C85A2A; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
    .blog-card-read:hover { color:#a84520; }

    /* Category colour map */
    .tag-news     { background:#e0f2fe; color:#0369a1; }
    .tag-event    { background:#ede9fe; color:#7c3aed; }
    .tag-tour     { background:#fff0e8; color:#C85A2A; }
    .tag-upcoming { background:#dcfce7; color:#16a34a; }

    .empty-blog { text-align:center; padding:80px 20px; }
    .empty-blog i { font-size:48px; color:#C85A2A; display:block; margin-bottom:16px; }
    .empty-blog h3 { color:#555; margin-bottom:8px; }
    .empty-blog p  { color:#999; font-size:15px; }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="blog-hero">
        <div class="blog-hero-content">
            <h1>Our Blog</h1>
            <p>News, events, tours and travel stories from Rwanda.</p>
        </div>
    </section>

    <section style="background:#f7f8fb; padding:0 0 56px;">
        <div class="container">

            {{-- Filters --}}
            <div class="blog-filters">
                <button class="filter-btn active" data-cat="all">All</button>
                <button class="filter-btn" data-cat="news">News</button>
                <button class="filter-btn" data-cat="event">Events</button>
                <button class="filter-btn" data-cat="tour">Tours</button>
                <button class="filter-btn" data-cat="upcoming">Upcoming</button>
            </div>

            @if($posts->isEmpty())
                <div class="empty-blog">
                    <i class="fas fa-newspaper"></i>
                    <h3>No posts yet</h3>
                    <p>Check back soon for news and travel stories.</p>
                </div>
            @else

                {{-- Featured (latest) post --}}
                @if($featured)
                <a href="{{ route('blog.show', $featured->slug) }}" class="featured-post blog-item" data-cat="{{ $featured->category }}">
                    <div class="featured-img">
                        @if($featured->image)
                            <img src="{{ $featured->image }}" alt="{{ $featured->title }}">
                        @else
                            <div style="width:100%;height:100%;background:linear-gradient(135deg,#0D1F35,#1e3a5f);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-newspaper" style="font-size:64px;color:rgba(255,255,255,.2)"></i>
                            </div>
                        @endif
                    </div>
                    <div class="featured-body">
                        <span class="featured-tag tag-{{ $featured->category }}">{{ $featured->category_label }}</span>
                        <h2>{{ $featured->title }}</h2>
                        @if($featured->excerpt)
                            <p class="featured-excerpt">{{ $featured->excerpt }}</p>
                        @endif
                        <div class="featured-meta">
                            {{ $featured->published_at ? $featured->published_at->format('F j, Y') : $featured->created_at->format('F j, Y') }}
                        </div>
                        <span class="featured-link">Read Article <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                @endif

                {{-- Other posts --}}
                @if($rest->count())
                <div class="blog-section-label">More Articles</div>
                <div class="blog-grid" id="blogGrid">
                    @for($sk=0;$sk<3;$sk++)
                    <div class="skel-card-wrap skel-card">
                        <div class="skel skel-img"></div>
                        <div class="skel-body" style="padding:18px 20px 22px;">
                            <div class="skel skel-line" style="width:40%;height:20px;border-radius:50px;margin-bottom:12px;"></div>
                            <div class="skel skel-line" style="width:90%;margin-bottom:8px;"></div>
                            <div class="skel skel-line short" style="margin-bottom:6px;"></div>
                            <div class="skel skel-line xshort"></div>
                        </div>
                    </div>
                    @endfor
                    @foreach($rest as $post)
                    {{-- wrap each real card so JS can find it --}}
                    <div class="real-card" style="display:contents">
                    <a href="{{ route('blog.show', $post->slug) }}" class="blog-card blog-item" data-cat="{{ $post->category }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        @if($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="blog-card-img">
                        @else
                            <img src="{{ asset('images/conference-hero.webp') }}" alt="{{ $post->title }}" class="blog-card-img">
                        @endif
                        <div class="blog-card-body">
                            <span class="blog-card-tag tag-{{ $post->category }}">{{ $post->category_label }}</span>
                            <div class="blog-card-title">{{ $post->title }}</div>
                            @if($post->excerpt)
                                <p class="blog-card-excerpt">{{ Str::limit($post->excerpt, 100) }}</p>
                            @endif
                            <div class="blog-card-footer">
                                <span class="blog-card-date">
                                    {{ $post->published_at ? $post->published_at->format('M j, Y') : $post->created_at->format('M j, Y') }}
                                </span>
                                <span class="blog-card-read">Read more <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                    </div>{{-- .real-card --}}
                    @endforeach
                </div>
                @endif

            @endif
        </div>
    </section>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        var cat = btn.dataset.cat;
        document.querySelectorAll('.blog-item').forEach(function(item) {
            item.style.display = (cat === 'all' || item.dataset.cat === cat) ? '' : 'none';
        });
    });
});
</script>
@endsection
