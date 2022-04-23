@extends('layouts.master-dashboard')

@section('title', 'Informasi')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Informasi</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-description">
                    <p class="font-weight-bold">Developer :</p>
                    <p>Rivan Hadinata Putra</p>
                    <a href="mailto:rivan.hadinata@gmail.com" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-solid fa-envelope fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="https://wa.me/6281346209135" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-brands fa-whatsapp fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="https://t.me/rifuntastic" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-brands fa-telegram fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="https://www.linkedin.com/in/rivanhadinata/" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-brands fa-linkedin fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="https://github.com/rifuntastic" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-brands fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="https://www.instagram.com/rifuntastic/" target="_blank">
                        <span class="fa-stack fa-1x">
                            <i class="fa-solid fa-circle fa-stack-2x" style="color:#282f3a"></i>
                            <i class="fa-brands fa-instagram fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <p class="mt-5 font-weight-bold"></p>
                    <p>Aplikasi ini dapat digunakan secara gratis, mari bantu sebarkan aplikasi ini. Jika ingin donasi
                        <a href="#" data-toggle="modal" data-target="#staticBackdrop">klik disini</a>. Terima kasih 😊
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ url('images/qris.jpeg') }}" class="img-fluid" alt="qris">
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-stylesheet')
@endpush

@push('page-script')
@endpush
