@extends('ketua.layouts.master')
@section('content')  
<form action="{{ route('shu.process') }}" method="POST">
    @csrf
    <label for="jumlah_shu">Jumlah SHU:</label>
    <input type="number" name="jumlah_shu" id="jumlah_shu" required step="0.01">
    <button type="submit">Simpan</button>
</form>
@endsection