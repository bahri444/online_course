@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Akun user</h3>
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
                <!-- <div class="mb-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            Tambah Data
                        </button>
                    </div> -->
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Status Akun</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($users as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->role}}</td>
                                <td>{{$val->status_akun}}</td>
                                <td class="d-flex justify-content-center">
                                    <!-- <div class="d-flex justify-content-center"> -->
                                    <!-- <div class="d-flex"> -->
                                    <div class="col-4">
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_user}}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->id_user}}">
                                            <i class="fas fa-info"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_user}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <!-- </div> -->
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
<!-- Modal update-->
@foreach($users as $valId)
<div class="modal fade" id="modalUpdate{{$valId->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/user/updateByIdUser" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" class="form-control" name="id_user" value="{{$valId->id_user}}">
                            <h6>Hak akses</h6>
                            <fieldset class="form-group">
                                <select name="role" id="basicSelect" class="form-select">
                                    <option value="{{$valId->role}}" selected>{{$valId->role}}</option>
                                    <option value="admin">Admin</option>
                                    <option value="mentor">Mentor</option>
                                    <option value="member">Member</option>
                                </select>
                            </fieldset>
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
<div class="modal fade" id="modalInfo{{$valId->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Info akun {{$valId->nama_lengkap}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <h6>Tgl lahir</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->tgl_lahir}}</p>
                    </div>
                    <div class="col-4">
                        <h6>Foto</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->foto}}</p>
                    </div>
                    <div class="col-4">
                        <h6>Gender</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->gender}}</p>
                    </div>
                    <div class="col-4">
                        <h6>Alamat</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->alamat}}</p>
                    </div>
                    <div class="col-4">
                        <h6>Github</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->github}}</p>
                    </div>
                    <div class="col-4">
                        <h6>No Hp</h6>
                    </div>
                    <div class="col-7">
                        <p>: {{$valId->telepon}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal hapus-->
@foreach($users as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_user}}" name="produk_id">
                <p>Yakin ingin menghapus akun {{$valDel->username}} dari hak akses sebagai {{$valDel->role}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/user/deleteByIdUser/{{$valDel->id_user}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection