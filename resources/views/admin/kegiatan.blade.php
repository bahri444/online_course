@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kegiatan</h3>
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
                                <th class="text-center">Nama kategori</th>
                                <th class="text-center">Nama kegiatan</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Tujuan</th>
                                <th class="text-center">Manfaat</th>
                                <th class="text-center">Tanggal mulai</th>
                                <th class="text-center">Tanggal berakhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($activity as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_kategori}}</td>
                                <td>{{$val->nama_kegiatan}}</td>
                                <td><img src="/foto_kegiatan/{{$val->foto_keg}}" width="70" height="70" class="rounded-circle" alt=""></td>
                                <td>{{$val->deskripsi}}</td>
                                <td>{{$val->tujuan}}</td>
                                <td>{{$val->manfaat}}</td>
                                <td>{{$val->dari}}</td>
                                <td>{{$val->sampai}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <!-- <div class="d-flex"> -->
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_kegiatan}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalValid{{$val->id_kegiatan}}">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </div> -->
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_kegiatan}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <!-- </div> -->
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
            <form action="/kegiatan/addKegiatan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama akun</h6>
                            <fieldset class="form-group">
                                <select name="id_kategori_keg" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori kegiatan</option>
                                    @foreach($kategori_keg as $valId)
                                    <option value="{{$valId->id_kategori_keg}}">{{$valId->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama kegiatan</h6>
                            <input class="form-control" type="text" name="nama_kegiatan" placeholder="nama kegiatan" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Foto Kegiatan</h6>
                            <input class="form-control" type="file" name="foto_keg" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Deskripsi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Deskripsi kegiatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Tujuan</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tujuan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Tujuan kegiatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Manfaat</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="manfaat" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Manfaat kegiatan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl mulai</h6>
                            <input class="form-control" type="date" name="dari" placeholder="tanggal mulai" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>Tgl berakhir</h6>
                            <input class="form-control" type="date" name="sampai" placeholder="tanggal berakhir" aria-label="default input example">
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

<!-- Modal Update-->
@foreach($activity as $rows)
<div class="modal fade" id="modalUpdate{{$rows->id_kegiatan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/kegiatan/updtKegiatan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama akun</h6>
                            <input type="hidden" name="id_kegiatan" value="{{$rows->id_kegiatan}}" class="form-control">
                            <fieldset class="form-group">
                                <select name="id_kategori_keg" id="basicSelect" class="form-select">
                                    <option value="{{$rows->id_kategori_keg}}" selected>{{$valId->nama_kategori}}</option>
                                    @foreach($kategori_keg as $valId)
                                    <option value="{{$valId->id_kategori_keg}}">{{$valId->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama kegiatan</h6>
                            <input class="form-control" type="text" name="nama_kegiatan" value="{{$rows->nama_kegiatan}}" placeholder="nama kegiatan" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Foto Kegiatan</h6>
                            <input class="form-control" type="file" name="foto_keg" value="{{$rows->foto_keg}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Deskripsi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi" value="{{$rows->deskripsi}}" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Deskripsi kegiatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Tujuan</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tujuan" value="{{$rows->tujuan}}" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Tujuan kegiatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Manfaat</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="manfaat" value="{{$rows->manfaat}}" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Manfaat kegiatan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl mulai</h6>
                            <input class="form-control" type="date" name="dari" value="{{$rows->dari}}" placeholder="tanggal mulai" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>Tgl berakhir</h6>
                            <input class="form-control" type="date" name="sampai" value="{{$rows->sampai}}" placeholder="tanggal berakhir" aria-label="default input example">
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
@foreach($activity as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_kegiatan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/kegiatan/deleteKegiatan/{{$valDel->id_kegiatan}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection