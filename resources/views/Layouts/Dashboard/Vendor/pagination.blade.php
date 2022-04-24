@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item prev disabled">
                <a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="tf-icon bx bx-chevrons-left"></i></a>
            </li>
        @else
            <li class="page-item prev">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="tf-icon bx bx-chevrons-left"></i></a>
            </li>
        @endif
      
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}s</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        @else
        <li class="page-item next disabled">
            <a class="page-link" href="javascript:void(0)">
                <i class="tf-icon bx bx-chevrons-right"></i>
            </a>
        </li>
        @endif
    </ul>
@endif