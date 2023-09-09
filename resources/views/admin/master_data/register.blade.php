@extends('admin.layouts.master')
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
                            
                            <form class="form-valide" action="/admin/create" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="name">Nama <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama anda..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nik">NIK <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="nik" name="nik" placeholder="Mauskan Nik..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="pekerjaan">Pekerjaan <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Mauskan pekejaan..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Mauskan email..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="password">Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password..">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="role"> Role <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="role" name="role" placeholder="masukan role..">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="role">level <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="role" name="role">
                                            <option>Pilih level...</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="admin">Admin</option>
                                            <option value="anggota">Anggota</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Jenis Kelamin <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option>Pilih ...</option>
                                            <option value="Laki-Laki">laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Alamat <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Mauskan alamat rumah..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Mauskan tgl lahir..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Nomer HP <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Mauskan NO HP..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" >Simpanan Pokok <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="simpanan_pokok" name="simpanan_pokok" placeholder="isi 50.000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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