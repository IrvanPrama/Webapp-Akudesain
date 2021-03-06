@extends('dashboard-designer.master-designer')

@section('name','Dashboard | Akudesain')

@section('content')
<div class="container my-5">

    <!-- Order List -->
    <section class="mt-5">
        <div class="row mb-3">
            <a class="btn" style="height:40px; width:180px;">
                <p class="color-oten" style="text-align: center;"><b>Daftar Pekerjaan</b></p>
            </a>
            <a href="/dashboard/designer/ongoing" class="btn"
                style="height:40px; width:100px; background-color: rgb(206, 206, 206);">
                <p class="color-oten" style="text-align: center;"><b>Proses</b></p>
            </a>
            <a href="/dashboard/designer/done" class="btn"
                style="height:40px; width:100px; background-color: rgb(206, 206, 206);">
                <p class="color-oten" style="text-align: center;"><b>Selesai</b></p>
            </a>
        </div>
        <div class="row">
            @foreach ($dataorder as $item)
            <div class="card-order"
                style="border: solid 4px rgba(0, 110, 255, 0.815);border-radius: 20px; height: 260px;">
                <div class="row mt-0">
                    <img class="profil-card mb-1" src="
                    
                    @if(!is_null($item->avatar))
                    {{asset('/assets/profile/'.$item->avatar)}}
                
                    @else
                    {{asset('/assets/profile/default.jpg')}}
                    @endif
                    
                    " alt="profil">
                    <p class="text-oten text_capital"
                        style="margin:5px 0; padding: 5px 0; font-size: 18px; font-weight: bold; line-height: 2">
                        {{$item->name}}
                    </p>
                </div>

                <p class="text-uppercase p-1 m-2 bold"
                    style="margin:5px 0; border-top:solid rgb(184, 184, 184) 1px; border-bottom:solid rgb(184, 184, 184) 1px;">
                    {{$item->title_design}}</p>

                <p class="ml-2 mr-2 mt-2 mb-3">{{$item->description}}</p>
                <div class="row m-2 ">
                    <p class="font-size-mini"><b>Deadline:</b> {{$item->deadline}}</p>
                    <p class="font-size-mini ml-auto"><b>Anggaran:</b> {{$item->budget}}</p>
                </div>
                <form action="/process-store" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="id" value="{{$item->id}}" hidden>
                    <input type="text" name="avatar" value="{{$item->avatar}}" hidden>
                    <input type="text" name="user_id" value="{{$item->user_id}}" hidden>
                    <input type="text" name="designer_id" value="{{$item->designer_id}}" hidden>
                    <input type="text" name="design_id" value="{{$item->design_id}}" hidden>
                    <input type="text" name="name" value="{{$item->name}}" hidden>
                    <input type="text" name="deadline" value="{{$item->deadline}}" hidden>
                    <input type="text" name="budget" value="{{$item->budget}}" hidden>
                    <input type="text" name="title_design" value="{{$item->title_design}}" hidden>
                    <input type="text" name="description" value="{{$item->description}}" hidden>

                    <button stype="submit" class="btn btn-success"
                        style="margin-right: 30%; margin-left: 30%; width:40%; font-size: 12px; line-height: 1.5; background-color:green; border-radius:10px !important;">
                        Ambil Pekerjaan</button>
                </form>
            </div>
            @endforeach
        </div>
    </section>
    <!-- End Order List -->
</div>
</section>
@endsection

@section('modal')

<!-- Modal Review-->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content br-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tulis Review Kamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/review/create" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}" hidden>
                    <input type="text" name="user_id" class="form-control" value="{{auth()->user()->id}}" hidden>
                    <input type="text" name="avatar" class="form-control" value="{{auth()->user()->avatar}}" hidden>
                    <div class="form-group">
                        <textarea class="form-control" name="review" rows="4" style="border-radius: 0"
                            placeholder="Pengerjaan designnya cepat, harga bisa menyesuaikan . . ."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="border-radius: 0">Kirim Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Review-->

<!-- Modal Design-->
@foreach ($datadesign as $item)
<div class="modal fade" id="designModal{{$item->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content br-0">
            <div class="modal-header">
                <h5 class="text-oten text_capital">{{$item->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Thumbnail images -->
                <div class="row my-3 d-flex justify-content-around">
                    <img class="img" src="{{asset('/assets/design/'.$item->design1)}}" style="width:200px; height:200px"
                        alt="The Woods">

                    <img class="img" src="{{asset('/assets/design/'.$item->design2)}}" style="width:200px; height:200px"
                        alt="Cinque Terre">

                    <img class="img" src="{{asset('/assets/design/'.$item->design3)}}" style="width:200px; height:200px"
                        alt="Mountains and fjords">
                </div>
                <div class="modal-footer">
                    <button data-toggle="modal" data-target="#editDesignModal{{$item->id}}" type="button"
                        class="btn btn-primary br-0">Edit</button>
                    <a type="button" href="{{url('delete-design', $item->id )}}" class="btn btn-danger br-0">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Design-->

<!-- Modal Order Detail -->
@foreach ($dataorder as $item)
<div class="modal fade" id="orderModal{{$item->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content br-0">
            <div class="modal-header">
                <h5 class="text-oten text_capital">Pesanan {{$item->category}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="row mx-auto">
                    <div class="col-sm-6">
                        <div class="row mx-auto">
                            <img style="height: 265px; max-width:100%"
                                src="{{asset('assets/order/'.$item->example_img)}}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6 mx-auto">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text_capital">Nama: {{$item->name}}</li>
                            <li class="list-group-item">Deskripsi: <br>{{$item->description}}</li>
                            <li class="list-group-item">No. Hp: {{$item->no_hp}}</li>
                            <li class="list-group-item">Email: {{$item->email}}</li>
                            <li class="list-group-item">Anggaran: <br> {{$item->budget}}
                            <li class="list-group-item">Deadline: <br> {{$item->deadline}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" href="" class="btn btn-block btn-primary br-0">Hubungi
                    Pemesan</a>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Order Detail -->

<!-- Modal Edit Design-->
@foreach ($datadesign as $item)
<div class="modal fade" id="editDesignModal{{$item->id}}" tabindex="-1" z-index="10" role="dialog"
    aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content br-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Design</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/design/update/{{$item->id}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="text" id="name" name="name" class="form-control" value="{{$item->name}}">
                    <div class="form-group mb-4">
                        <label for="title">Judul</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{$item->title}}">
                    </div>
                    <div class="form-group mb-4 form-floating">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4"
                            placeholder="contoh: Siap mengerjakan Disain Brosur untuk menunjang promosi produk atau event anda baik untuk media online maupun media cetak dengan resvisi unlimited selama jam kerja."
                            style="border-radius: 0">{{$item->description}}</textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name">Unggah Design 1</label>
                        <input type="file" name="design1" class="form-control" value="{{$item->design1}}">
                        <label for="name">Unggah Design 2</label>
                        <input type="file" name="design2" class="form-control" value="{{$item->design2}}">
                        <label for="name">Unggah Design 3</label>
                        <input type="file" name="design3" class="form-control" value="{{$item->design3}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="border-radius: 0">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- End Modal Edit Design-->


<!-- Modal Profil-->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content br-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Unggah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/profile/update" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group mb-4">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{auth()->user()->name}}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="name">Unggah Foto Profil</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="border-radius: 0">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Profil-->
@endsection

@section('footer')

@endsection

@section('script')
<script>
    var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
@endsection