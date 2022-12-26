@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Modul</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->username}}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div>
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <div class="mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama kelas</th>
                                <th class="text-center">Nama kategori modul</th>
                                <th class="text-center">Jenis modul</th>
                                <th class="text-center">Jumlah Modul</th>
                                <th class="text-center">Tgl Terbit</th>
                                <th class="text-center">Penulis</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($joinTbl as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->jenis_kelas}}</td>
                                <td>{{$val->jenis_modul}}</td>
                                <td>{{$val->nama_modul}}</td>
                                <td>{{$val->jml_modul}}</td>
                                <td>{{$val->tgl_terbit}}</td>
                                <td>{{$val->penulis}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if(Auth::user()->role=='admin')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_modul}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_modul}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @elseif(Auth::user()->role=='mentor')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_modul}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal add-->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/modul/addModul" method="post">
                <div class="modal-body">
                    @csrf
                    <!-- id_kategori_modul	id_kelas	nama_modul	jml_modul	tgl_terbit	penulis	 -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kategori Modul</h6>
                            <fieldset class="form-group">
                                <select name="id_kategori_modul" id="basicSelect" class="form-select">
                                    <option selected>pilih nama kategori</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->id_kategori_modul}}">{{$valId->jenis_modul}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jenis Kelas</h6>
                            <fieldset class="form-group">
                                <select name="id_kelas" id="basicSelect" class="form-select">
                                    <option selected>pilih nama kelas</option>
                                    @foreach($kelas as $valId)
                                    <option value="{{$valId->id_kelas}}">{{$valId->jenis_kelas}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <!-- id_kategori_modul	id_kelas	nama_modul	jml_modul	tgl_terbit	penulis -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama Modul</h6>
                            <input class="form-control" type="text" name="nama_modul" placeholder="nama modul" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jumlah Modul</h6>
                            <input class="form-control" type="number" name="jml_modul" placeholder="jumlah modul" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl terbit</h6>
                            <input class="form-control" type="date" name="tgl_terbit" placeholder="tanggal terbit" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Penulis</h6>
                            <input class="form-control" type="text" name="penulis" placeholder="penulis" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal update -->
@foreach($joinTbl as $row)
<div class="modal fade" id="modalUpdate{{$row->id_modul}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/modul/updateModulById" method="post">
                <div class="modal-body">
                    @csrf
                    <!-- id_kategori_modul	id_kelas	nama_modul	jml_modul	tgl_terbit	penulis	 -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kategori Modul</h6>
                            <fieldset class="form-group">
                                <input type="hidden" class="form-control" name="id_modul" value="{{$row->id_modul}}">
                                <select name="id_kategori_modul" id="basicSelect" class="form-select">
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->id_kategori_modul}}">{{$valId->jenis_modul}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jenis Kelas</h6>
                            <fieldset class="form-group">
                                <select name="id_kelas" id="basicSelect" class="form-select">
                                    @foreach($kelas as $valId)
                                    <option value="{{$valId->id_kelas}}">{{$valId->jenis_kelas}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama Modul</h6>
                            <input class="form-control" type="text" name="nama_modul" value="{{$row->nama_modul}}" placeholder="nama modul" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jumlah Modul</h6>
                            <input class="form-control" type="number" name="jml_modul" value="{{$row->jml_modul}}" placeholder="jumlah modul" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl terbit</h6>
                            <input class="form-control" type="date" name="tgl_terbit" value="{{$row->tgl_terbit}}" placeholder="tanggal terbit" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Penulis</h6>
                            <input class="form-control" type="text" name="penulis" value="{{$row->penulis}}" placeholder="penulis" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal hapus-->
@foreach($joinTbl as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_modul}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_modul}}" name="id_modul">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/modul/deleteModulById/{{$valDel->id_modul}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection