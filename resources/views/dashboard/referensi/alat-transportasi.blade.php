@extends('layouts.master-dashboard')

@section('title', 'Referensi Alat Transportasi')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Alat Transportasi</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Alat Transportasi</h4>
                <div class="alert alert-warning" role="alert">
                    <p class="m-0">Saat ini web service yang disediakan oleh PDDIKTI untuk referensi alat
                        transportasi hanya bisa berjalan pada mode sandbox</p>
                </div>
                <div class="table-responsive">
                    <table id="refAlatTransportasi" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Alat Transportasi</th>
                                <th>Nama Alat Transportasi</th>
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
        $('#refAlatTransportasi').DataTable({
            ajax: {
                url: 'ref-alat-transportasi'
            },
            columns: [
                { data: 'id_alat_transportasi' },
                { data: 'nama_alat_transportasi' }
            ]
        });
    });
</script>
@endpush
