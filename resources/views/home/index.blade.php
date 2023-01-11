@include('layout.header')
<div class="learning_part">
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @foreach($kegiatan as $keg)
                <div class="carousel-item active">
                    <img src="foto_kegiatan/{{$keg->foto_keg}}" class="d-block w-100" alt="404">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$keg->nama_kegiatan}}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- learning part start-->
<section class="learning_part mt-5">
    <div class="container">
        @foreach($kegiatan as $act)
        <div class="row align-items-sm-center align-items-lg-stretch mt-3">
            <div class="col-md-5 col-lg-5">
                <div class="learning_img">
                    <img src="foto_kegiatan/{{$act->foto_keg}}" class="d-block w-100" alt="404">
                </div>
            </div>
            <div class="col-md-7 col-lg-7">
                <div class="learning_member_text">
                    <h2>{{$act->nama_kegiatan}}</h2>
                    <p>{{$act->deskripsi}}</p>
                    <p>{{$act->dari}}, s.d. {{$act->sampai}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- learning part end-->

<!--::review_part start::-->
<section class="special_cource padding_top mt-4">
    <div class="container">
        <div class="row">
            @foreach($kegiatan as $kegs)
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <div class="special_cource_text">
                        <h6>Manfaat {{$kegs->nama_kegiatan}} :</h6>
                        <p>{{$kegs->manfaat}}</p>
                        <h6>Tujuan {{$kegs->nama_kegiatan}} :</h6>
                        <p>{{$kegs->tujuan}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--::blog_part end::-->
@include('layout.footer')