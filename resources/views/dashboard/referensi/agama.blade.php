@extends('layouts.master-dashboard')

@section('title', 'Referensi Agama')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Agama</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Agama</h4>
                <div class="table-responsive">
                    <table id="refAgama" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Agama</th>
                                <th>Nama Agama</th>
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
        $('#refAgama').DataTable({
            ajax: {
                url: 'ref-agama'
            },
            columns: [
                { data: 'id_agama' },
                { data: 'nama_agama' }
            ]
        });
    });
</script>
@endpush
