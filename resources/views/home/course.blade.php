@include('layout.header')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Our Courses</h2>
                        <p>Home<span>/</span>Courses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--::review_part start::-->
<section class="special_cource padding_top">
    <div class="container">
        <!-- <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="section_tittle text-center">
                    <h3>Special Courses</h3>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="img/special_cource_1.png" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="course-details.html">
                            <h3>Jumlah bidang</h3>
                        </a>
                        <p>{{$bidang}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="img/special_cource_1.png" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="course-details.html">
                            <h3>Jumlah kegiatan</h3>
                        </a>
                        <p>{{$kegiatan}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="img/special_cource_1.png" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="course-details.html">
                            <h3>Jumlah member</h3>
                        </a>
                        <p>{{$member}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--::blog_part end::-->

@include('layout.footer')