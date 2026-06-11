<div class="hero-breadcrumbs" style="margin:20px 0;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent;padding:0;margin:0;">
                @foreach(($breadcrumbs ?? []) as $i => $crumb)
                    @if(!isset($crumb['url']) || $i === array_key_last($breadcrumbs))
                        <li class="breadcrumb-item active" aria-current="page" style="color:#1a1a2e;font-weight:600;">{{ $crumb['label'] }}</li>
                    @else
                        <li class="breadcrumb-item" style="margin-right:8px;"><a href="{{ $crumb['url'] }}" style="color:#0d1f35;text-decoration:none;">{{ $crumb['label'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>
