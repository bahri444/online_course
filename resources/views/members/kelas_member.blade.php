@extends('layout.template')
@section('content')
<!--read data all kelas-->
<div class="row justify-content-center">
    <div class="col-xl-5">
        <div class="section_tittle text-center">
            <h2>{{$title}}</h2>
        </div>
    </div>
</div>
<div class="row match-height mt-2">
    <!-- alert -->
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

    <!-- view read kelas -->
    @foreach($transaksi as $val)
    @if(Auth::user()->id_user == $val->id_user)
    @if($val->validasi_pembayaran=='valid')
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$val->nama_bidang}}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Jenis kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->jenis_kelas}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Harga kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->harga_kelas}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Masa aktif kelas</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->lama_course}}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Tanggal berakhir</h6>
                                </div>
                                <div class="col-md-8 form-group">
                                    <p>: {{$val->tanggal_berakhir}}</p>
                                </div>
                                <!-- notification validation -->
                                <div class="col-5 mx-auto">
                                    <p class="text text-success">
                                        Kelas anda sudah valid
                                    </p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBelajar{{$val->id_modul}}">
                                            <i class="fas fa-book-reader"></i>
                                            Belajar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @elseif($val->validasi_pembayaran=='pending')
    <div class="col-4 mx-auto">
        <p class="text text-warning">
            Kelas anda dalam proses persetujuan
        </p>
    </div>
    @endif
    @endif
    @endforeach
</div>

@foreach($transaksi as $tra)
<!-- modal belajar -->
<div class="modal fade" id="modalBelajar{{$tra->id_modul}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$tra->judul}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{$tra->materi}}</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Quis</button> -->
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalQuis{{$tra->id_modul}}">
                            <i class="fas fa-pen-square"></i>
                            Quis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal jawab question -->
@foreach($quis as $ques)
@if($tra->id_modul == $ques->id_modul)
<div class="modal fade bd-example-modal-xl" id="modalQuis{{$tra->id_modul}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Quis {{$tra->judul}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/answer/addAnswer" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <input type="hidden" name="id_question" value="{{$ques->id_question}}" class="form-control">
                            <div class="card-header">1. {{$ques->one}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_one" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 1</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">2. {{$ques->two}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_two" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 2</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">3. {{$ques->three}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_three" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">4. {{$ques->four}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_four" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 4</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">5. {{$ques->five}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_five" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 5</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">6. {{$ques->six}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_six" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 6</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">7. {{$ques->seven}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_seven" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">8. {{$ques->eight}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_eight" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 8</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">9. {{$ques->nine}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_nine" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 9</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">10. {{$ques->ten}}</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="a_ten" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>jawaban no 10</label>
                                </div>
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="status_answer" value="selesai" aria-label="default input example">
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
@endif
@endforeach
@endforeach
@endsection