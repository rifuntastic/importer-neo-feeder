@extends('layouts.master-front')

@section('title', 'Welcome')

@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-xl-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="{{ url('images/logo-importer.png') }}" alt="logo" class="mx-auto d-block">
                    </div>
                    <h6 class="font-weight-light">
                        Lakukan pengaturan menggunakan akun aplikasi Neo Feeder.
                    </h6>
                    <form action="{{ url('check-setting') }}" class="py-3" method="post">
                        @csrf
                        <div class="form-group row @error('username') has-danger @enderror">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-danger" name="username">
                                @error('username')
                                <label class="error text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('password') has-danger @enderror">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control-danger" name="password"
                                    id="password">
                                <span toggle="#password"
                                    class="text-muted fa-solid fa-eye fa-fw fa-xs field-icon toggle-password"></span>
                                @error('password')
                                <label class="error text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">URL</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url">
                                <small class="form-text text-muted">Isian url tanpa port,
                                    contoh : http://localhost atau http://feeder.univ.ac.id</small>
                                @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-stylesheet')
@endpush

@push('page-script')
<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endpush
