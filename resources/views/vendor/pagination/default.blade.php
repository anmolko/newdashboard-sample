
    @if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination ico-20 justify-content-center">

            @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                <span class="flaticon-back"></span>
                </a>
            </li>
            @else
            
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                <span class="flaticon-back"></span>
                </a>
            </li>
            @endif

            @if($paginator->currentPage() > 3)
            <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>


            @endif

            @if($paginator->currentPage() > 4)
            <li class="page-item disabled"  aria-disabled="true"><a class="page-link" href="#">...</a></li>

            @endif

            @foreach(range(1, $paginator->lastPage()) as $i)
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a class="page-link" >{{ $i }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>

                    @endif
                @endif
            @endforeach

            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                    <li class="page-item disabled"  aria-disabled="true"><a class="page-link" href="#">...</a></li>

            @endif
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>

            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span class="flaticon-next"></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled"  aria-disabled="true">
                    <a class="page-link" href="#" aria-label="Next">
                    <span class="flaticon-next"></span>
                    </a>
                </li>
            
            @endif

    
        </ul>
</nav>



@endif
