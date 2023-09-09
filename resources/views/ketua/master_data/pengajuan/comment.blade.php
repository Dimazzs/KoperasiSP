@extends('ketua.layouts.master')

@section('content')
<div class="container">
    <h1>Form Edit Komentar Pengajuan Pinjaman</h1>
    <form action="{{ route('pengajuan.updateComment', $pengajuan->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="comment">Komentar</label>
            <textarea name="comment" id="comment" class="form-control" rows="3">{{ $pengajuan->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Komentar</button>
    </form>
</div>
@endsection