@extends('layout.template')
@section('content')
<div class="card mt-5 col-lg-4 col-6 mx-auto shadow-lg">
    <div class="card-body">
        <div class="card-header">
            <h4 class="card-title text-center">Profile</h4>
        </div>
        <div class="form">
            <div class="modal-body">
                @foreach($member as $mbr)
                @if(Auth::user()->id_user == $mbr->id_user)
                <div class="row">
                    <div class="col-md-5 mb-3 mx-auto">
                        <img src="/foto/{{$mbr->foto}}" alt="404" width="200" height="200" class="rounded-circle">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Username</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->username}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Nama member</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->nama_member}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Tanggal lahir</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->tgl_lhr}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Gender</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->gender}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Alamat</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->alamat}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Nama github</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->github}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h6>Telepon</h6>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h6>: {{$mbr->telepon}}</h6>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <div class="mb-2 col-4 mx-auto">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$mbr->id_member}}">
                        Update Profile
                    </button>
                </div>
                @endif
                @endforeach
            </div>
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
            <form action="updtmember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="id_member" value="{{$row->id_member}}" class="form-control">
                            @foreach($users as $us)
                            @if(Auth::user()->id_user == $us->id_user)
                            <input type="hidden" class="form-control" name="id_user" value="{{$us->id_user}}">
                            @endif
                            @endforeach
                            <h6>Nama member</h6>
                            <input class="form-control" type="text" name="nama_member" value="{{$row->nama_member}}" placeholder="nama member" aria-label="default input example" autofocus>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Tgl lahir</h6>
                            <input class="form-control" type="date" name="tgl_lhr" value="{{$row->tgl_lhr}}" placeholder="tanggal lahir" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Foto</h6>
                            <input class="form-control" type="file" name="foto" value="{{$row->foto}}" aria-label="default input example">
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" value="{{$row->alamat}}" placeholder="alamat" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Github</h6>
                            <input class="form-control" type="text" name="github" value="{{$row->github}}" placeholder="username github" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
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
@endsection