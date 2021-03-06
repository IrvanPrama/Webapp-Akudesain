@extends('layout.master')

@section('name', 'Admin Signup | Akudesain')
@section('content')

<!-- Daftar Button -->
<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-lg-12 d-flex justify-content-center mt-5">
        <div class="col-lg-5" style="border-right: 4px solid rgb(0, 162, 255);">
            <div>
                <img src="{{asset('assets/designer.png')}}" alt=""
                    style="width: 40%; height: 40%; margin: 0 40% 0 33%;">
                <p class="text-h3" style="margin: 10px auto 3px auto; font-weight:bold; font-size: 2rem;">Admin
                    <br>Akudesain
                </p>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card text-white" style="width: 25rem;">
                <div class="card-body bg-oten">
                    <b>
                        <p class="text-center"
                            style="border-bottom: 3px solid white; padding-bottom: 2px;font-size: 1.2rem;">
                            Daftar
                            Sebagai
                            Admin</p>
                    </b>
                    <form action="/signup/account" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="role" value="admin">
                        <input type="hidden" name="avatar" value="default.jpg">
                        <b>
                            <p class="mb-2">Info Akun</p>
                        </b>
                        <div class="form-group mb-4">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password2" name="password2" class="form-control" id="password2"
                                placeholder="Confirm Password">
                        </div>
                        <b>
                            <button onclick="myFunction()" type="submit"
                                class="btn btn-block btn-success">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Daftar Button -->
</body>

@endsection

@section('footer')
<div class="row">
    <div class="col-lg-5">
        <img src="{{asset('assets/logo.png')}}" alt="logo" style="height: 35px; width: 200px; margin: 30px 0;">
        <p class="text-white">AkuDesain adalah sebuah platform yang memudahkan anda dalam menemukan
            jasa
            desain.
            Sistem AkuDesain
            sangat mudah dipakai, cepat dalam respon dan membantu and secara akurat untuk mencari
            freelancer
            yang tepat</p>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-5 text-white">
        <p style=" margin: 30px 0 10px 0; font-weight: bold;">Kontak Kami</p>
        <ul>
            <li>
                <a href="#" style="text-decoration: none; color: white;">
                    <div class="row">
                        <img src="{{asset('assets/ig.png')}}" alt="ig"
                            style="width: 18px; height: 18px; margin: 5px 10px;">
                        <p>akudesain_id</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" style="text-decoration: none; color: white;">
                    <div class="row">
                        <img src="{{asset('assets/facebook.png')}}" alt="fb" class="mini-icon"
                            style="width: 12px; height: 18px; margin: 5px 14px;">
                        <p>AkuDesain</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" style="text-decoration: none; color: white;">
                    <div class="row">
                        <img src="{{asset('assets/mail.png')}}" alt="mail"
                            style="width: 18px; height: 14px; margin: 5px 10px;">
                        <p>AkuDesain.official@gmail.com</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" style="text-decoration: none; color: white;">
                    <div class="row">
                        <img src="{{asset('assets/wa.png')}}" alt="wa"
                            style="width: 16px; height: 14px; margin: 5px 10px;">
                        <p>+62 87 776 966 876</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

</div>
@endsection