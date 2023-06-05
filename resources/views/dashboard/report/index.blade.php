@extends('layouts.dashboard')

@section('content')
<h1 class="display-6">Data Report</h1>
<a href="/export-report" class="btn btn-danger">Export PDF</a>
<table class="table mt-4">
    <tr style="background-color: #F6F1E9;">
        <th>Nama User</th>
        <th>No. Telp</th>
        <th>Jenis jerawat</th>
        <th>Tanggal Tes</th>
    </tr>
    @foreach ($data as $item)
    <tr>
        <td>{{$item->nama}}</td>
        <td>{{$item->no_telp}}</td>
        <td>{{$item->penyakit ?? "Tidak ada jerawat"}}</td>
        <td>{{$item->tanggal}}</td>
    </tr>
    @endforeach
</table>

@endsection