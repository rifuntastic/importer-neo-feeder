@extends('layouts.master-dashboard')

@section('title', 'Referensi Pekerjaan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Pekerjaan</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Pekerjaan</h4>
                <div class="table-responsive">
                    <table id="refPekerjaan" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Pekerjaan</th>
                                <th>Nama Pekerjaan</th>
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
        $('#refPekerjaan').DataTable({
            ajax: {
                url: 'ref-pekerjaan'
            },
            columns: [
                { data: 'id_pekerjaan' },
                { data: 'nama_pekerjaan' }
            ]
        });
    });
</script>
@endpush
