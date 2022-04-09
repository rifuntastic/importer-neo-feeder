@extends('layouts.master-dashboard')

@section('title', 'Referensi Jenis Tinggal')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Jenis Tinggal</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Jenis Tinggal</h4>
                <div class="table-responsive">
                    <table id="refJenisTinggal" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Jenis Tinggal</th>
                                <th>Nama Jenis Tinggal</th>
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
        $('#refJenisTinggal').DataTable({
            ajax: {
                url: 'ref-jenis-tinggal'
            },
            columns: [
                { data: 'id_jenis_tinggal' },
                { data: 'nama_jenis_tinggal' }
            ]
        });
    });
</script>
@endpush
