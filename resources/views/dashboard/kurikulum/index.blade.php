@extends('layouts.master-dashboard')

@section('title', 'Kurikulum')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Kurikulum</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Import Kurikulum</h4>
                <div class="card-description">
                    <p>Petunjuk :</p>
                    <ol class="list">
                        <li>Download file template excel <a href="{{ url('files/import-kurikulum.xlsx') }}">disini</a>
                        </li>
                        <li>Isikan data kurikulum pada file excel sesuai petunjuk</li>
                    </ol>
                </div>
                <form action="{{ url('dashboard/kurikulum') }}" method="post" enctype="multipart/form-data"
                    id="formImport">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-12 @error('file') has-danger @enderror">
                            <label>File</label>
                            <input type="file" name="file" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text"
                                    class="form-control file-upload-info @error('file') form-control-danger @enderror"
                                    disabled>
                                <span class="input-group-append">
                                    <button
                                        class="file-upload-browse btn btn-light border @error('file') border-danger @enderror"
                                        type="button">Pilih
                                        File</button>
                                </span>
                            </div>
                            @error('file')
                            <label class="error mt-2 text-danger">{{ $message }}</label>
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
                                    Baris ke-{{ session()->get('import-error')->row() }}, nilai {{
                                    session()->get('import-error')->values()[session()->get('import-error')->attribute()]
                                    }} pada kolom {{
                                    strtolower(session()->get('import-error')->errors()[0]) }}
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
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Kurikulum</h4>
                <div class="table-responsive">
                    <table id="refKurikulum" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kurikulum</th>
                                <th>Program Studi</th>
                                <th>Mulai Berlaku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
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
    $(document).ready(function() {
        $('.file-upload-browse').on('click', function() {
            let file = $(this).parent().parent().parent().find('.file-upload-default');
            file.trigger('click');
        });
        $('.file-upload-default').on('change', function() {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        $('#formImport').submit(function (e) {
            $('#btnImport').attr('disabled', true);
            $('#btnImport').html('<i class="fa-solid fa-spinner fa-spin fa-fw mr-2"></i>Proses Import');
        });

        let table = $('#refKurikulum').DataTable({
            ajax: {
                url: 'kurikulum'
            },
            columns: [
                { data: null, orderable: false, searchable: false },
                { data: 'nama_kurikulum' },
                { data: 'nama_program_studi' },
                { data: 'semester_mulai_berlaku' },
                {
                    data: 'id_kurikulum', searchable: false,
                    render: function (data, type, row, meta) {
                        return `<a class="btn btn-primary" href="kurikulum/${row['id_kurikulum']}">Insert Matkul</a>`;
                    },
                    className: 'text-center'
                },
            ]
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i+1;
            });
        });
    });
</script>
@endpush
