@extends('layouts.master-dashboard')

@section('title', 'Pengaturan Sandbox')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Pengaturan Sandbox</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Ubah Koneksi</h4>
                <p class="card-description">
                    Sebelum mengubah koneksi database ke mode sandbox, pastikan sudah melakukan clone data live ke
                    sandbox pada aplikasi Neo Feeder.
                </p>
                <form action="{{ url('dashboard/sandbox') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="koneksi">Mode</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="koneksi" value="live" id="koneksi" {{
                                    ($mode_selected=="live" ) ? "checked" : "" }}>
                                Live
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="koneksi" value="sandbox" id="koneksi"
                                    {{ ($mode_selected=="sandbox" ) ? "checked" : "" }}>
                                Sandbox
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-stylesheet')
@endpush

@push('page-script')
@endpush
