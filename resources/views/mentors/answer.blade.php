@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Answers</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->nama_lengkap}}</p>
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
                @foreach($mentor as $rows)
                <!-- filter jika data mentor belum di validasi -->
                @if(Auth::user()->id_user == $rows->id_user && $rows->status_akun == 'aktif')
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama member</th>
                                <th class="text-center">Jawaban soal dari modul</th>
                                <th class="text-center">Modul ke</th>
                                <th class="text-center">Jenis kelas</th>
                                <th class="text-center">Nama bidang</th>
                                <th class="text-center">Jawaban 1</th>
                                <th class="text-center">Jawaban 2</th>
                                <th class="text-center">Jawaban 3</th>
                                <th class="text-center">Jawaban 4</th>
                                <th class="text-center">Jawaban 5</th>
                                <th class="text-center">Jawaban 6</th>
                                <th class="text-center">Jawaban 7</th>
                                <th class="text-center">Jawaban 8</th>
                                <th class="text-center">Jawaban 9</th>
                                <th class="text-center">Jawaban 10</th>
                                <th class="text-center">Status Jawaban</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($answer as $val)
                            @foreach($mentor as $mtr)
                            @if(Auth::user()->id_user == $mtr->id_user && $mtr->id_bidang == $val->id_bidang)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_member}}</td>
                                <td>{{$val->judul}}</td>
                                <td>{{$val->modul_ke}}</td>
                                <td>{{$val->jenis_kelas}}</td>
                                <td>{{$val->nama_bidang}}</td>
                                <td>{{$val->a_one}}</td>
                                <td>{{$val->a_two}}</td>
                                <td>{{$val->a_three}}</td>
                                <td>{{$val->a_four}}</td>
                                <td>{{$val->a_five}}</td>
                                <td>{{$val->a_six}}</td>
                                <td>{{$val->a_seven}}</td>
                                <td>{{$val->a_eight}}</td>
                                <td>{{$val->a_nine}}</td>
                                <td>{{$val->a_ten}}</td>
                                <td>{{$val->status_answer}}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        @if(Auth::user()->role=='admin')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdt{{$val->id_answer}}">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->id_answer}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @elseif(Auth::user()->role=='mentor')
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdt{{$val->id_answer}}">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- modal update answer -->
@foreach($answer as $rows)
<div class="modal fade" id="modalUpdt{{$rows->id_answer}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Answer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/answer/updtAnswer" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" class="form-control" name="id_answer" value="{{$rows->id_answer}}">
                        <div class="col-md-12 mb-3">
                            <h6>Status Quis</h6>
                            <fieldset class="form-group">
                                <select name="status_answer" id="basicSelect" class="form-select">
                                    <option value="{{$rows->status_answer}}" selected>{{$rows->status_answer}}</option>
                                    <option value="nonaktif">Nonaktif</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="selesai">Selesai</option>
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

<!-- modal delete -->
@foreach($answer as $answ)
<div class="modal fade" id="modalDelete{{$answ->id_answer}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$answ->id_answer}}" name="id_modul">
                <p>Yakin ingin menghapus data ini...?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a href="/answer/deleteAnswer/{{$answ->id_answer}}" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection