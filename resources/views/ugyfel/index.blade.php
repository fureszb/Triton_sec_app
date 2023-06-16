@extends('layout')

@section('content')

    <h1>Ügyfelek
        <a href="{{ route('ugyfel.index', ['sort_by' => 'UgyfelID', 'sort_dir' => 'asc']) }}" title="Növekvő sorrend">^</a>
        <a href="{{ route('ugyfel.index', ['sort_by' => 'UgyfelID', 'sort_dir' => 'desc']) }}" title="Csökkenő sorrend">ˇ</a>
        <form action="{{ route('ugyfel.index') }}" method="GET">
            <input type="text" name="search" placeholder="Keresés név vagy azonosító alapján">
            <button type="submit">Keresés</button>
        </form>
    </h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach ($ugyfel as $u)
            <li>{{ $u->UgyfelID }} - {{ $u->Nev }}</li>
            <a href="{{ route('ugyfel.show', $u->UgyfelID) }}" class="button">Megjelenítés</a>
            <a href="{{ route('ugyfel.edit', $u->UgyfelID) }}" class="button">Szerkesztés</a>
            <form action="{{ route('ugyfel.destroy', $u->UgyfelID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Biztos törölni kívánja az ügyfélt?')">Törlés</button>
            </form>
        @endforeach


    </ul>

    <div id="paginator">
        {{ $ugyfel->appends(['sort_by' => request('sort_by'), 'sort_dir'=> request('sort_dir')])->links() }}
    </div>
@endsection


