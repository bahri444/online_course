@extends('layout.template')
@section('content')
<div class="card mt-5 col-lg-8 col-12 mx-auto shadow-lg">
    @foreach($member as $mb)
    @if(Auth::user()->id_user== $mb->id_user && $mb->status_member =='nonaktif')
    <div class="card-body">
        <div class="card-header">
            <h4 class="card-title text-center">Lengkapi profile</h4>
        </div>
        <form action="addmember" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @foreach($users as $us)
                        @if(Auth::user()->id_user == $us->id_user)
                        <input type="hidden" class="form-control" name="id_user" value="{{$us->id_user}}">
                        @endif
                        @endforeach
                        <h6>Nama member</h6>
                        <input class="form-control" type="text" name="nama_member" placeholder="nama member" aria-label="default input example">
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Tgl lahir</h6>
                        <input class="form-control" type="date" name="tgl_lhr" placeholder="tanggal lahir" aria-label="default input example">
                    </div>
                </div>
                <!-- id_user	nama_member	tgl_lhr	foto	gender	alamat	github	telepon -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Foto</h6>
                        <input class="form-control" type="file" name="foto" aria-label="default input example">
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
                        <input class="form-control" type="text" name="alamat" placeholder="alamat" aria-label="default input example">
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Github</h6>
                        <input class="form-control" type="text" name="github" placeholder="github" aria-label="default input example">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
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
    @elseif(Auth::user()->id_user== $mb->id_user && $mb->status_member =='aktif')
    <div class="row-4">
        <div class="col-3 mx-auto">
            <p class="text text-info">Profile anda sudah valid</p>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection