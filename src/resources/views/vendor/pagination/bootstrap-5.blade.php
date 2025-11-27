@if ($paginator->hasPages())
<nav>
    <ul class="pagination-wrapper">

        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
        @else
        <li class="disabled"><span>&raquo;</span></li>
        @endif

    </ul>
</nav>
@endif

<style>
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 18px;
        padding: 25px 0;
        list-style: none;
    }

    .pagination-wrapper li a,
    .pagination-wrapper li span {
        font-size: 18px;
        color: #444;
        text-decoration: none;
        padding: 2px 6px;
    }

    .pagination-wrapper li.active span {
        background: linear-gradient(90deg, #8e78ff, #f48acb);
        color: #fff;
        border-radius: 6px;
        padding: 4px 10px;
    }

    .pagination-wrapper li.disabled span {
        color: #bbb;
    }
</style>