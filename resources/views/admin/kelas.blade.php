@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelas</h3>
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
                                <th class="text-center">Nama Bidang</th>
                                <th class="text-center">Jenis Kelas</th>
                                <th class="text-center">Harga Kelas</th>
                                <th class="text-center">Lama Course</th>
                                <th class="text-center">Tanggal Berakhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($joinKelas as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_bidang}}</td>
                                <td>{{$val->jenis_kelas}}</td>
                                <td>{{$val->harga_kelas}}</td>
                                <td>{{$val->lama_course}}</td>
                                <td>{{$val->tanggal_berakhir}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <!-- <div class="d-flex"> -->
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_kelas}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_kelas}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- </div> -->
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

<!-- modal add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/kelas/addKelas" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama bidang</h6>
                            <fieldset class="form-group">
                                <select name="id_bidang" id="basicSelect" class="form-select">
                                    <option selected>pilih nama bidang</option>
                                    @foreach($data_bidang as $valId)
                                    <option value="{{$valId->id_bidang}}">{{$valId->nama_bidang}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jenis kelas</h6>
                            <fieldset class="form-group">
                                <select name="jenis_kelas" id="basicSelect" class="form-select">
                                    <option selected>pilih jenis kelas</option>
                                    <option value="free">Free</option>
                                    <option value="premium">Premium</option>
                                    <option value="bootcamp">Bootcamp</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Harga kelas</h6>
                            <input class="form-control" type="number" name="harga_kelas" placeholder="harga kelas" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Lama course</h6>
                            <input class="form-control" type="number" name="lama_course" placeholder="lama kursus" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Tgl berakhir</h6>
                            <input class="form-control" type="date" name="tanggal_berakhir" placeholder="tanggal berakhir" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal update -->
@foreach($joinKelas as $row)
<div class="modal fade" id="modalUpdate{{$row->id_kelas}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/kelas/updateKelasById" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama bidang</h6>
                            <input type="hidden" name="id_kelas" value="{{$row->id_kelas}}" class="form-control">
                            <fieldset class="form-group">
                                <select name="id_bidang" id="basicSelect" class="form-select">
                                    <option value="{{$row->id_bidang}}" selected>{{$row->nama_bidang}}</option>
                                    @foreach($data_bidang as $valId)
                                    <option value="{{$valId->id_bidang}}">{{$valId->nama_bidang}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Jenis kelas</h6>
                            <fieldset class="form-group">
                                <select name="jenis_kelas" id="basicSelect" class="form-select">
                                    <option value="{{$row->jenis_kelas}}" selected>{{$row->jenis_kelas}}</option>
                                    <option value="free">Free</option>
                                    <option value="premium">Premium</option>
                                    <option value="bootcamp">Bootcamp</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Harga kelas</h6>
                            <input class="form-control" type="number" name="harga_kelas" value="{{$row->harga_kelas}}" placeholder="harga kelas" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Lama course</h6>
                            <input class="form-control" type="number" name="lama_course" value="{{$row->lama_course}}" placeholder="lama kursus" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Tgl berakhir</h6>
                            <input class="form-control" type="date" name="tanggal_berakhir" value="{{$row->tanggal_berakhir}}" placeholder="tanggal berakhir" aria-label="default input example">
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

<!-- modal delete -->
@foreach($joinKelas as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_kelas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_kelas}}" name="id_mentor">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/kelas/deleteKelasById/{{$valDel->id_kelas}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection