@extends('layouts.master-dashboard')

@section('title', 'Referensi Penghasilan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Penghasilan</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Penghasilan</h4>
                <div class="table-responsive">
                    <table id="refPenghasilan" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Penghasilan</th>
                                <th>Nama Penghasilan</th>
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
        $('#refPenghasilan').DataTable({
            ajax: {
                url: 'ref-penghasilan'
            },
            columns: [
                { data: 'id_penghasilan' },
                { data: 'nama_penghasilan' }
            ]
        });
    });
</script>
@endpush
