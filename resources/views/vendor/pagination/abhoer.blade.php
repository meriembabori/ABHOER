@if ($paginator->hasPages())
    <nav class="abhoer-pagination" role="navigation" aria-label="Pagination">

        <ul class="abhoer-pagination-list">

            {{-- Lien précédent --}}
            @if ($paginator->onFirstPage())
                <li class="abhoer-page-item disabled" aria-disabled="true">
                    <span class="abhoer-page-link">&laquo; Précédent</span>
                </li>
            @else
                <li class="abhoer-page-item">
                    <a class="abhoer-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Précédent</a>
                </li>
            @endif

            {{-- Numéros de page --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="abhoer-page-item disabled"><span class="abhoer-page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="abhoer-page-item active" aria-current="page">
                                <span class="abhoer-page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="abhoer-page-item">
                                <a class="abhoer-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Lien suivant --}}
            @if ($paginator->hasMorePages())
                <li class="abhoer-page-item">
                    <a class="abhoer-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant &raquo;</a>
                </li>
            @else
                <li class="abhoer-page-item disabled" aria-disabled="true">
                    <span class="abhoer-page-link">Suivant &raquo;</span>
                </li>
            @endif

        </ul>

        <p class="abhoer-pagination-info">
            {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} sur {{ $paginator->total() }} résultats
        </p>

    </nav>
@endif
