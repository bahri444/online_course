@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transaksi kelas</h3>
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
                                <th class="text-center">Kode member</th>
                                <th class="text-center">Nama member</th>
                                <th class="text-center">Kode bidang</th>
                                <th class="text-center">Nama bidang</th>
                                <th class="text-center">Jenis kelas</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Masa berlaku</th>
                                <th class="text-center">Tanggal Bayar</th>
                                <th class="text-center">Tanggal berakhir</th>
                                <th class="text-center">Status pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <!-- id_member	id_kelas	tgl_bayar	validasi_pembayaran -->
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($transaksi as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->id_member}}</td>
                                <td>{{$val->nama_member}}</td>
                                <td>{{$val->id_bidang}}</td>
                                <td>{{$val->nama_bidang}}</td>
                                <td>{{$val->jenis_kelas}}</td>
                                <td>{{$val->harga_kelas}}</td>
                                <td>{{$val->lama_course}}</td>
                                <td>{{$val->tgl_bayar}}</td>
                                <td>{{$val->tanggal_berakhir}}</td>
                                <td>{{$val->validasi_pembayaran}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_transaksi}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_transaksi}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

@foreach($transaksi as $tra)
<div class="modal fade" id="modalUpdate{{$tra->id_transaksi}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Validasi pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/transactionKelas/updtTransaksi" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama member</h6>
                            <fieldset class="form-group">
                                <input type="hidden" value="{{$tra->id_transaksi}}" name="id_transaksi" class="form-control">
                                <select name="id_member" id="basicSelect" class="form-select">
                                    <option value="{{$tra->id_member}}" selected>{{$tra->nama_member}}</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jenis kelas</h6>
                            <fieldset class="form-group">
                                <select name="id_kelas" id="basicSelect" class="form-select">
                                    <option value="{{$tra->id_kelas}}" selected>{{$tra->jenis_kelas}}</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl bayar</h6>
                            <input class="form-control" type="date" name="tgl_bayar" value="{{$tra->tgl_bayar}}" placeholder="tanggal bayar" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Validasi pembayaran</h6>
                            <fieldset class="form-group">
                                <select name="validasi_pembayaran" id="basicSelect" class="form-select">
                                    <option value="{{$tra->validasi_pembayaran}}" selected>{{$tra->validasi_pembayaran}}</option>
                                    <option value="pending">Pending</option>
                                    <option value="valid">Valid</option>
                                </select>
                            </fieldset>
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
@foreach($transaksi as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_transaksi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_transaksi}}" name="id_mentor">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/transactionKelas/deleteTransaksi/{{$valDel->id_transaksi}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection