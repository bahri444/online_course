@extends('layout.template')
@section('content')
<div class="card mt-5 col-lg-5 col-md-12 mx-auto shadow-lg">
    <div class="card-body">
        <div class="card-header">
            <h4 class="card-title text-center">Profile</h4>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="form">
                    <div class="modal-body">
                        @foreach($users as $usr)
                        @if(Auth::user()->id_user == $usr->id_user)
                        @if($usr->status_akun=='nonaktif')
                        <div class="col-2 mx-auto">
                            <div class="text text-warning">Panding validation</div>
                        </div>
                        @elseif($usr->status_akun=='aktif')
                        <div class="row">
                            <div class="col-md-5 mb-3 mx-auto">
                                <img src="/foto/{{$usr->foto}}" alt="404" width="200" height="200" class="rounded-circle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Nama Lengkap</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->nama_lengkap}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Nama bidang</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->nama_bidang}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Tanggal lahir</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->tgl_lhr}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Gender</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->gender}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Alamat</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->alamat}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Nama github</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->github}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Telepon</h6>
                            </div>
                            <div class="col-md-8 mb-3">
                                <h6>: {{$usr->telepon}}</h6>
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <div class="text text-success">Valid</div>
                        </div>
                        <!-- Button trigger modal -->
                        <div class="mb-2 col-4 mx-auto">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$usr->id_user}}">
                                Update Profile
                            </button>
                        </div>
                        @endif
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal update -->
@foreach($users as $row)
<div class="modal fade" id="modalUpdate{{$row->id_user}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updtpp" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="id_mentor" value="{{$row->id_mentor}}" class="form-control">
                            @foreach($users as $usr)
                            @if(Auth::user()->id_user == $usr->id_user)
                            <input type="hidden" class="form-control" name="id_user" value="{{$usr->id_user}}">
                            @endif
                            @endforeach
                            <h6>Nama bidang</h6>
                            <fieldset class="form-group">
                                <select name="id_bidang" id="basicSelect" class="form-select">
                                    <option value="{{$row->id_bidang}}" selected>{{$row->nama_bidang}}</option>
                                    @foreach($bidang as $valId)
                                    <option value="{{$valId->id_bidang}}">{{$valId->nama_bidang}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Nama mentor</h6>
                            <input class="form-control" type="text" name="nama_mentor" value="{{$row->nama_mentor}}" placeholder="nama mentor" aria-label="default input example" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Tgl lahir</h6>
                            <input class="form-control" type="date" name="tgl_lhr" value="{{$row->tgl_lhr}}" placeholder="tanggal lahir" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Foto</h6>
                            <input class="form-control" type="file" name="foto" value="{{$row->foto}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Gender</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="laki-laki" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="perempuan" id="Primary">
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
                            <input class="form-control" type="text" name="github" value="{{$row->github}}" placeholder="username github" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
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
@endsection