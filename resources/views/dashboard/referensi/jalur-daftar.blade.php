@extends('layouts.master-dashboard')

@section('title', 'Referensi Jalur Daftar')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Jalur Daftar</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Jalur Daftar</h4>
                <div class="table-responsive">
                    <table id="refJalurDaftar" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Jalur Daftar</th>
                                <th>Nama Jalur Daftar</th>
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
        $('#refJalurDaftar').DataTable({
            ajax: {
                url: 'ref-jalur-daftar'
            },
            columns: [
                { data: 'id_jalur_masuk' },
                { data: 'nama_jalur_masuk' }
            ]
        });
    });
</script>
@endpush
