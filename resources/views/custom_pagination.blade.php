<!-- Először győződj meg róla, hogy a jQuery linkelve van a projektbe. -->
<!-- Példa: -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<style>
    .page-item> a {


        color: #000000d1;
    }
    .page-link{
        color: #9E9E9E;

    }
    .disabled{
        color: #9E9E9E;
        cursor: not-allowed;
    }
</style>

@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Előző oldal gomb --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link"><i class="fa-regular fa-square-caret-left fa-lg"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-regular fa-square-caret-left fa-lg"></i></a>
            </li>
        @endif

        {{-- Oldalak --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Aktuális oldal --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Következő oldal gomb --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-regular fa-square-caret-left fa-rotate-180 fa-lg"></i></a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link"><i class="fa-regular fa-square-caret-left fa-rotate-180 fa-lg"></i></span>
            </li>
        @endif
    </ul>
@endif

<!-- JavasScript kód a kattinthatóság figyeléséhez -->
<script>
    // Miután a dokumentum betöltődött
    $(document).ready(function() {
        // Kiválasztjuk az összes .page-item elemet
        $('.page-item').each(function() {
            // Ha az elem .disabled osztállyal rendelkezik, akkor inaktív
            if ($(this).hasClass('disabled')) {
                $(this).find('a.page-link').removeAttr('href'); // Elnyomjuk a href attribútumot, így nem lehet rá kattintani
                $(this).find('span.page-link > i').css('color', '#9E9E9E'); // Beállítjuk a színt az inaktív elemre
            }
        });
    });
</script>
