@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data instansi</h3>
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
                                <th class="text-center">Nama instansi</th>
                                <th class="text-center">Logo</th>
                                <th class="text-center">Tentang</th>
                                <th class="text-center">Kontak</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">WhatsApp</th>
                                <th class="text-center">Facebook</th>
                                <th class="text-center">Instagram</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($instansi as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama}}</td>
                                <td class="overflow-hidden"><img src="/logo/{{$val->logo}}" alt="404" width="90" height="90" class="rounded-circle"></td>
                                <td class="text-align">{{$val->tentang}}</td>
                                <td class="text-align">{{$val->kontak}}</td>
                                <td class="text-align">{{$val->email}}</td>
                                <td class="text-align">{{$val->whatsapp}}</td>
                                <td class="text-align">{{$val->facebook}}</td>
                                <td class="text-align">{{$val->instagram}}</td>
                                <!-- 'kontak',    'email',    'whatsapp',    'facebook',    'instagram', -->
                                <td>
                                    <div class="container px-3 text-center">
                                        <!--px untuk ukuran padding horizontal (lebar padding ke kanan)-->
                                        <div class="row gx-4 row-cols-2">
                                            <!--px untuk ukuran gutter horizontal (lebar kolom ke kanan)-->
                                            <div class="col">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_lembaga}}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_lembaga}}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
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
            <form action="/instansi/addLembaga" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-1">
                            <h6>Nama instansi</h6>
                            <input class="form-control" type="text" name="nama" placeholder="nama perusahaan" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-1">
                            <h6>Logo</h6>
                            <input class="form-control" type="file" name="logo" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Tentang</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tentang" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Tentang instansi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h6>Kontak</h6>
                            <input class="form-control" type="text" name="kontak" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Email</h6>
                            <input class="form-control" type="email" name="email" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>WhatsApp</h6>
                            <input class="form-control" type="text" name="whatsapp" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Facebook</h6>
                            <input class="form-control" type="text" name="facebook" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>instagram</h6>
                            <input class="form-control" type="text" name="instagram" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal update-->
@foreach($instansi as $row)
<div class="modal fade" id="modalUpdate{{$row->id_lembaga}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/instansi/updateById" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Nama instansi</h6>
                            <input class="form-control" type="hidden" name="id_lembaga" value="{{$row->id_lembaga}}" aria-label="default input example">
                            <input class="form-control" type="text" name="nama" value="{{$row->nama}}" placeholder="nama perusahaan" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-3">
                            <h6>Logo</h6>
                            <input class="form-control" type="file" name="logo" value="{{$row->logo}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Tentang</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tentang" value="{{$row->tentang}}" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Tentang instansi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h6>Kontak</h6>
                            <input class="form-control" type="text" name="kontak" value="{{$row->kontak}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Email</h6>
                            <input class="form-control" type="email" name="email" value="{{$row->email}}" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>WhatsApp</h6>
                            <input class="form-control" type="text" name="whatsapp" value="{{$row->whatsapp}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Facebook</h6>
                            <input class="form-control" type="text" name="facebook" value="{{$row->facebook}}" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>instagram</h6>
                            <input class="form-control" type="text" name="instagram" value="{{$row->instagram}}" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal hapus-->
@foreach($instansi as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_lembaga}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_lembaga}}" name="produk_id">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/instansi/deleteById/{{$valDel->id_lembaga}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection