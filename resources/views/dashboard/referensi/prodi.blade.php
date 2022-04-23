@extends('layouts.master-dashboard')

@section('title', 'Referensi Program Studi')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Program Studi</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Program Studi</h4>
                <div class="table-responsive">
                    <table id="refProdi" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Prodi</th>
                                <th>Kode Program Studi</th>
                                <th>Nama Program Studi</th>
                                <th>Status</th>
                                <th>Jenjang</th>
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
        let table = $('#refProdi').DataTable({
            ajax: {
                url: 'ref-prodi'
            },
            columns: [
                { data: null, orderable: false, searchable: false },
                { data: 'id_prodi' },
                { data: 'kode_program_studi' },
                { data: 'nama_program_studi' },
                { data: 'status' },
                { data: 'nama_jenjang_pendidikan' }
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
