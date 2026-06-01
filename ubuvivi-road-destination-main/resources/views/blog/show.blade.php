@extends('layouts.guest')

@section('title') {{ $post->title }} - Ubuvivi Blog @endsection
@section('meta')
<meta name="description" content="{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .post-hero {
        position: relative;
        height: 480px;
        background: linear-gradient(135deg,#0D1F35,#1e3a5f);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex; align-items: flex-end; justify-content: flex-start;
    }
    .post-hero::after { content:''; position:absolute; inset:0; background:linear-gradient(to top, rgba(13,31,53,.88) 0%, rgba(13,31,53,.3) 60%, transparent 100%); }
    .post-hero-content { position:relative; z-index:2; padding:0 0 44px; width:100%; }
    .post-hero-content .container { max-width:820px; }
    .post-tag { display:inline-block; padding:5px 16px; border-radius:50px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.8px; margin-bottom:16px; }
    .post-hero-content h1 { font-size:clamp(26px,4vw,46px); font-weight:800; color:#fff !important; line-height:1.25; margin-bottom:14px; }
    .post-meta { font-size:14px; color:rgba(255,255,255,.6); display:flex; align-items:center; gap:18px; flex-wrap:wrap; }
    .post-meta i { margin-right:5px; color:rgba(255,255,255,.4); }

    /* Tag colours */
    .tag-news     { background:#e0f2fe; color:#0369a1; }
    .tag-event    { background:#ede9fe; color:#7c3aed; }
    .tag-tour     { background:#fff0e8; color:#C85A2A; }
    .tag-upcoming { background:#dcfce7; color:#16a34a; }

    /* ── Layout ── */
    .post-layout {
        background: #f7f8fb;
        padding: 60px 0 80px;
    }
    .post-main {
        max-width: 820px;
    }

    /* ── Content card ── */
    .post-content-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 28px rgba(13,31,53,.07);
        padding: 44px 48px;
        margin-bottom: 32px;
    }
    .post-content-card p  { font-size: 16px; line-height: 1.9; color: #374151; margin-bottom: 20px; }
    .post-content-card h2 { font-size: 24px; font-weight: 700; color: #0D1F35; margin: 32px 0 14px; }
    .post-content-card h3 { font-size: 20px; font-weight: 700; color: #0D1F35; margin: 24px 0 10px; }
    .post-content-card ul, .post-content-card ol { padding-left: 24px; margin-bottom: 20px; }
    .post-content-card li { font-size: 16px; line-height: 1.8; color: #374151; margin-bottom: 6px; }
    .post-content-card blockquote {
        border-left: 4px solid #C85A2A; padding: 16px 24px;
        background: #fff8f5; border-radius: 0 10px 10px 0;
        font-style: italic; color: #555; margin: 24px 0;
    }
    .post-content-card img { max-width:100%; border-radius:12px; margin:16px 0; }

    /* Back link */
    .post-back {
        display:inline-flex; align-items:center; gap:7px;
        color:#666; font-size:14px; text-decoration:none; margin-bottom:28px;
        transition:color .2s;
    }
    .post-back:hover { color:#0D1F35; }

    /* Share / CTA strip */
    .post-share-strip {
        background:#fff; border-radius:14px; padding:20px 24px;
        display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;
        box-shadow:0 2px 16px rgba(13,31,53,.06);
        margin-bottom:32px;
    }
    .post-share-label { font-size:14px; font-weight:600; color:#0D1F35; }
    .share-links { display:flex; gap:10px; }
    .share-link {
        width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center;
        font-size:14px; text-decoration:none; transition:background .2s;
    }
    .share-fb { background:#1877f2; color:#fff; }
    .share-tw { background:#1da1f2; color:#fff; }
    .share-wa { background:#25d366; color:#fff; }
    .share-link:hover { opacity:.85; }

    /* ── Sidebar ── */
    .post-sidebar {}
    .sidebar-card {
        background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(13,31,53,.06);
        padding:24px; margin-bottom:24px;
    }
    .sidebar-card-title {
        font-size:14px; font-weight:700; color:#0D1F35; text-transform:uppercase;
        letter-spacing:.8px; margin-bottom:18px; padding-bottom:10px;
        border-bottom:2px solid #f0f0f0;
    }

    /* Recent posts in sidebar */
    .recent-post-item { display:flex; gap:14px; align-items:flex-start; padding:12px 0; border-bottom:1px solid #f5f5f5; text-decoration:none; color:inherit; }
    .recent-post-item:last-child { border-bottom:none; padding-bottom:0; }
    .recent-post-item:hover .rp-title { color:#C85A2A; }
    .rp-img { width:64px; height:52px; border-radius:8px; object-fit:cover; flex-shrink:0; }
    .rp-no-img { width:64px; height:52px; border-radius:8px; background:#f0f2f7; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#bbb; }
    .rp-title { font-size:13.5px; font-weight:600; color:#0D1F35; line-height:1.4; margin-bottom:4px; transition:color .2s; }
    .rp-date  { font-size:12px; color:#aaa; }

    /* CTA card */
    .cta-sidebar { background:#0D1F35; border-radius:16px; padding:28px 24px; text-align:center; }
    .cta-sidebar h4 { color:#fff; font-size:18px; font-weight:700; margin-bottom:10px; }
    .cta-sidebar p  { color:rgba(255,255,255,.7); font-size:14px; margin-bottom:20px; line-height:1.6; }
    .cta-sidebar a  { display:inline-block; background:#C85A2A; color:#fff; padding:11px 24px; border-radius:50px; font-size:14px; font-weight:600; text-decoration:none; transition:background .2s; }
    .cta-sidebar a:hover { background:#a84520; color:#fff; }

    @media(max-width:767px) {
        .post-content-card { padding:24px 18px; }
    }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="post-hero" @if($post->image) style="background-image: url('{{ $post->image }}');" @endif>
        <div class="post-hero-content">
            <div class="container">
                <span class="post-tag tag-{{ $post->category }}">{{ $post->category_label }}</span>
                <h1>{{ $post->title }}</h1>
                <div class="post-meta">
                    <span><i class="fas fa-calendar-alt"></i>{{ $post->published_at ? $post->published_at->format('F j, Y') : $post->created_at->format('F j, Y') }}</span>
                    <span><i class="fas fa-tag"></i>{{ $post->category_label }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="post-layout">
        <div class="container">
            <div class="row">

                {{-- Main content --}}
                <div class="col-12 col-lg-8">
                    <a href="{{ route('blog.index') }}" class="post-back">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>

                    @if($post->excerpt)
                    <div class="post-content-card" style="border-left:4px solid #C85A2A;padding-left:28px;background:#fff8f5;margin-bottom:16px;">
                        <p style="font-size:17px;color:#555;font-style:italic;margin:0;line-height:1.7;">{{ $post->excerpt }}</p>
                    </div>
                    @endif

                    <div class="post-content-card">
                        @if($post->content)
                            {!! nl2br(e($post->content)) !!}
                        @else
                            <p style="color:#999;text-align:center;padding:32px 0;">No content available for this post.</p>
                        @endif
                    </div>

                    {{-- Share --}}
                    <div class="post-share-strip">
                        <span class="post-share-label">Share this article</span>
                        <div class="share-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-link share-fb" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="share-link share-tw" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="share-link share-wa" title="Share on WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-12 col-lg-4">

                    @if($recent->count())
                    <div class="sidebar-card">
                        <div class="sidebar-card-title">Recent Posts</div>
                        @foreach($recent as $r)
                        <a href="{{ route('blog.show', $r->slug) }}" class="recent-post-item">
                            @if($r->image)
                                <img src="{{ $r->image }}" alt="{{ $r->title }}" class="rp-img">
                            @else
                                <div class="rp-no-img"><i class="fas fa-newspaper"></i></div>
                            @endif
                            <div>
                                <div class="rp-title">{{ Str::limit($r->title, 60) }}</div>
                                <div class="rp-date">{{ $r->published_at ? $r->published_at->format('M j, Y') : $r->created_at->format('M j, Y') }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif

                    <div class="cta-sidebar">
                        <h4>Ready to Explore Rwanda?</h4>
                        <p>Book your tour or transfer today and let us handle everything.</p>
                        <a href="{{ route('guest.all_services') }}">View Our Services</a>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const heroSection = document.querySelector('.post-hero');
    const img = new Image();

    @if($post->image)
        img.onerror = function () {
            heroSection.classList.add('fallback');
        };
        img.src = '{{ $post->image }}';
    @endif

    // Handle images in recent posts sidebar
    Array.from(document.querySelectorAll('.rp-img')).forEach(function (image) {
        image.addEventListener('error', function () {
            image.style.display = 'none';
            const container = image.parentElement;
            if (!container.querySelector('.rp-no-img')) {
                const fallback = document.createElement('div');
                fallback.className = 'rp-no-img';
                fallback.innerHTML = '<i class="fas fa-newspaper"></i>';
                container.insertBefore(fallback, image);
            }
        });
    });
});
</script>
@endsection
