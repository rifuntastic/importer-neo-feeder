@extends('layouts.master-dashboard')

@section('title', 'Referensi Pembiayaan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Pembiayaan</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Pembiayaan</h4>
                <div class="table-responsive">
                    <table id="refPembiayaan" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Pembiayaan</th>
                                <th>Nama Pembiayaan</th>
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
        $('#refPembiayaan').DataTable({
            ajax: {
                url: 'ref-pembiayaan'
            },
            columns: [
                { data: 'id_pembiayaan' },
                { data: 'nama_pembiayaan' }
            ]
        });
    });
</script>
@endpush
