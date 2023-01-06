@extends('layout.template')
@section('content')
<div class="card mt-5 col-lg-8 col-12 mx-auto shadow-lg">
    @foreach($mentor as $row)
    @if(Auth::user()->id_user== $row->id_user && $row->status_mentor =='nonaktif')
    <div class="card-body">
        <div class="card-header">
            <h4 class="card-title text-center">Lengkapi profile</h4>
        </div>
        <form action="addpp" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @foreach($users as $mtr)
                        @if(Auth::user()->id_user == $mtr->id_user)
                        <input type="hidden" class="form-control" name="id_user" value="{{$mtr->id_user}}">
                        @endif
                        @endforeach
                        <h6>Nama bidang</h6>
                        <fieldset class="form-group">
                            <select name="id_bidang" id="basicSelect" class="form-select">
                                <option selected>pilih nama bidang</option>
                                @foreach($bidang as $valId)
                                <option value="{{$valId->id_bidang}}">{{$valId->nama_bidang}}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Nama mentor</h6>
                        <input class="form-control" type="text" name="nama_mentor" placeholder="nama mentor" aria-label="default input example">
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
                <div class="modal-footer col-1 mx-auto justify-content-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    @elseif(Auth::user()->id_user== $row->id_user && $row->status_mentor =='aktif')
    <div class="row-4">
        <div class="col-3 mx-auto">
            <p class="text text-info">Profile anda sudah valid</p>
        </div>
    </div>
    @endif
</div>
@endforeach
@endsection