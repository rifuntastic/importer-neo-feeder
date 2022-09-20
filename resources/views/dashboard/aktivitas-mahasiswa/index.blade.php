@extends('layouts.master-dashboard')

@section('title', 'Aktivitas Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 mb-xl-0 mb-4">
                    <h3 class="font-weight-bold">Aktivitas Mahasiswa</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Import Aktivitas Mahasiswa</h4>
                    <div class="card-description">
                        <p>Petunjuk :</p>
                        <ol class="list">
                            <li>Download file template excel <a
                                    href="{{ url('files/import-aktivitas-mahasiswa.xlsx') }}">disini</a></li>
                            <li>Isikan data aktivitas mahasiswa menggunakan file excel sesuai petunjuk</li>
                        </ol>
                    </div>
                    <form action="{{ url('dashboard/aktivitas-mahasiswa') }}" method="post" enctype="multipart/form-data"
                        id="formImport">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6 @error('semester') has-danger @enderror">
                                <label>Semester</label>
                                <select class="form-control @error('semester') form-control-danger @enderror"
                                    name="semester">
                                    @foreach ($semester['data'] as $semester)
                                        <option value="{{ $semester['id_semester'] }}"
                                            {{ old('semester') == $semester['id_semester'] ? 'selected' : '' }}>
                                            {{ $semester['nama_semester'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester')
                                    <label class="error text-danger mt-2">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 @error('file') has-danger @enderror">
                                <label>File</label>
                                <input type="file" name="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text"
                                        class="form-control file-upload-info @error('file') form-control-danger @enderror"
                                        disabled>
                                    <span class="input-group-append">
                                        <button
                                            class="file-upload-browse btn btn-light @error('file') border-danger @enderror border"
                                            type="button">Pilih
                                            File</button>
                                    </span>
                                </div>
                                @error('file')
                                    <label class="error text-danger mt-2">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success" id="btnImport">Import</button>
                        </div>
                    </form>
                    @if (session()->has('import-error'))
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <p>Gagal import file. Periksa kembali isian data berikut :</p>
                                    <ul>
                                        <li>
                                            Baris ke-{{ session()->get('import-error')->row() }}, nilai
                                            {{ session()->get('import-error')->values()[session()->get('import-error')->attribute()] }}
                                            pada kolom {{ strtolower(session()->get('import-error')->errors()[0]) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-stylesheet')
@endpush

@push('page-script')
    <script>
        $(document).ready(function() {
            $('.file-upload-browse').on('click', function() {
                let file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });
            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });

            $('#formImport').submit(function(e) {
                $('#btnImport').attr('disabled', true);
                $('#btnImport').html('<i class="fa-solid fa-spinner fa-spin fa-fw mr-2"></i>Proses Import');
            });
        });
    </script>
@endpush
