@if ($paginator->hasPages())

    <div class="text-right mt-4">
        <nav class="d-inline-block">
            <ul class="pagination mb-0">
                @if ($paginator->onFirstPage())
                    <li class="page-item  disabled">
                        <a class="page-link bg-secondary" tabindex="-1">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link bg-secondary" tabindex="-1" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                @endif



                @foreach ($elements as $element)

                    @if (is_string($element))
                        <li class="page-item disabled">
                            <span class="page-link bg-secondary">{{ $element }}</span>
                        </li>
                    @endif



                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item ">
                                    <a class="page-link bg-secondary" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link bg-secondary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link bg-secondary">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

@endif
