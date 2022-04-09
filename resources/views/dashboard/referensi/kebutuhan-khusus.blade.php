@extends('layouts.master-dashboard')

@section('title', 'Referensi Kebutuhan Khusus')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Kebutuhan Khusus</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Kebutuhan Khusus</h4>
                <div class="table-responsive">
                    <table id="refKebutuhanKhusus" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Kebutuhan Khusus</th>
                                <th>Nama Kebutuhan Khusus</th>
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
        $('#refKebutuhanKhusus').DataTable({
            ajax: {
                url: 'ref-kebutuhan-khusus'
            },
            columns: [
                { data: 'id_kebutuhan_khusus' },
                { data: 'nama_kebutuhan_khusus' }
            ]
        });
    });
</script>
@endpush
