@if ($paginator->hasPages())
<nav aria-label="">
    <ul class="custom-pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a href="javascript:void(0)" tabindex="-1">&lt;</a>
            </li>
        @else
            <li class="">
                <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
            </li>
        @endif
      
        @foreach ($elements as $element)
            @if (is_string($element))
                <li disabled">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a>{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    &gt;
                </a>
            </li>
        @else
        <li disabled">
            <a href="javascript:void(0)">
                &gt;
            </a>
        </li>
        @endif
    </ul>
@endif