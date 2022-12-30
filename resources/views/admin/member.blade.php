@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Member</h3>
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
                                <th class="text-center">Nama user</th>
                                <th class="text-center">Nama member</th>
                                <th class="text-center">Tgl lahir</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Github</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Status member</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($member as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->username}}</td>
                                <td>{{$val->nama_member}}</td>
                                <td>{{$val->tgl_lhr}}</td>
                                <td><img src="/foto/{{$val->foto}}" width="70" height="70" class="rounded-circle" alt=""></td>
                                <td>{{$val->gender}}</td>
                                <td>{{$val->alamat}}</td>
                                <td>{{$val->github}}</td>
                                <td>{{$val->telepon}}</td>
                                <td>{{$val->status_member}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <!-- <div class="d-flex"> -->
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->id_member}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalValid{{$val->id_member}}">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_member}}">
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
            <form action="/member/addMember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Nama akun</h6>
                            <fieldset class="form-group">
                                <select name="id_user" id="basicSelect" class="form-select">
                                    <option selected>pilih nama akun</option>
                                    @foreach($users as $valId)
                                    <option value="{{$valId->id_user}}">{{$valId->username}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama member</h6>
                            <input class="form-control" type="text" name="nama_member" placeholder="nama member" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl lahir</h6>
                            <input class="form-control" type="date" name="tgl_lhr" placeholder="tanggal lahir" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Foto</h6>
                            <input class="form-control" type="file" name="foto" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Gender</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="laki-laki" id="Primary" checked>
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="perempuan" id="Primary" checked>
                                    <label class="form-check-label" for="Primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" placeholder="alamat" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Github</h6>
                            <input class="form-control" type="text" name="github" placeholder="username github" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" placeholder="telepon" aria-label="default input example">
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
@foreach($member as $row)
<div class="modal fade" id="modalUpdate{{$row->id_member}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/member/updateMemberById" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input class="form-control" type="hidden" name="id_member" value="{{$row->id_member}}" aria-label="default input example">
                            <h6>Nama akun</h6>
                            <fieldset class="form-group">
                                <select name="id_user" id="basicSelect" class="form-select">
                                    <option value="{{$row->id_user}}" selected>{{$row->username}}</option>
                                    @foreach($users as $valId)
                                    <option value="{{$valId->id_user}}">{{$valId->username}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama member</h6>
                            <input class="form-control" type="text" name="nama_member" value="{{$row->nama_member}}" placeholder="nama member" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl lahir</h6>
                            <input class="form-control" type="date" name="tgl_lhr" value="{{$row->tgl_lhr}}" placeholder="tanggal lahir" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Foto</h6>
                            <input class="form-control" type="file" name="foto" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Gender</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="laki-laki" id="Primary" checked>
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="perempuan" id="Primary" checked>
                                    <label class="form-check-label" for="Primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" value="{{$row->alamat}}" placeholder="alamat" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Github</h6>
                            <input class="form-control" type="text" name="github" placeholder="username github" aria-label="default input example">
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" value="{{$row->telepon}}" placeholder="telepon" aria-label="default input example">
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
@foreach($member as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->id_member}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->id_member}}" name="id_member">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/member/deleteMemberById/{{$valDel->id_member}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- modal validasi -->
@foreach($member as $rows)
<div class="modal fade" id="modalValid{{$rows->id_member}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/member/validMember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input class="form-control" type="hidden" name="id_member" value="{{$rows->id_member}}" aria-label="default input example">
                            <h6>Nama akun</h6>
                            <fieldset class="form-group">
                                <select name="id_user" id="basicSelect" class="form-select">
                                    <option value="{{$rows->id_user}}" selected>{{$rows->username}}</option>
                                    @foreach($users as $valId)
                                    <option value="{{$valId->id_user}}">{{$valId->username}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Status member</h6>
                            <fieldset class="form-group">
                                <select name="status_member" id="basicSelect" class="form-select">
                                    <option value="{{$rows->status_member}}" selected>{{$rows->status_member}}</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Validasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection