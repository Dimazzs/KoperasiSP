@extends('ketua.layouts.master')
@section('content')  

    <div class="container-fluid">
        
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            @if (session('message'))
                            <p class="alert alert-success"> {{ session('message') }}</p>
                        @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                            <form class="form-valide" action="{{ url('profile') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">Nama <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nik">NIK <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="nik" name="nik" value="{{ Auth::user()->profile->nik }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nik">Pekerjaan <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ Auth::user()->profile->pekerjaan }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password">Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ Auth::user()->profile->tgl_lahir }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Alamat <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="alamat" name="alamat"  value="{{ Auth::user()->profile->alamat }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Jenis Kelamin <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ Auth::user()->profile->jenis_kelamin }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Nomer HP <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ Auth::user()->profile->no_hp }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Divisi <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="role" name="role" value="{{ Auth::user()->role }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

@endsection