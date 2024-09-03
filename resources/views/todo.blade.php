@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <style>
        .completed {
            text-decoration: line-through;
            color: gray !important;
        }
    </style>
    <h1>APLIKASI TO-DO LIST</h1><br>

    <form action="{{ url('home') }}" method="POST">
        @csrf
        <label for="kegiatan">Masukkan Kegiatan:</label><br>
        <input type="text" name="kegiatan" style="width: 300px;" required/>
        <input type="submit" name="tambah" value="Tambahkan"/><br><br><br>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th class="w-5">No</th>
                <th class="w-70">Daftar Kegiatan:</th>
                <th class="w-10"></th>
                <th class="w-10"></th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($todolist as $item)
                <tr>
                    <td>{{ $no }}</td>
                    <td class="{{ $item->completed == 1 ? 'completed' : '' }}">{{ $item->kegiatan }}</td>
                    <td>
                        @if($item->completed == 1)
                            <a href="{{ url('todo/batal-selesai/' . $item->idkegiatan) }}">Batal Selesai</a>
                        @else
                            <a href="{{ url('todo/selesai/' . $item->idkegiatan) }}">Selesai</a>
                        @endif
                    </td>
                    <td><a href="{{ url('todo/hapus/' . $item->idkegiatan) }}">Hapus</a></td>
                </tr>
                @php $no++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
@endsection
