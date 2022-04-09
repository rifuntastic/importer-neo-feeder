@extends('layouts.master-dashboard')

@section('title', 'Referensi Jenjang Pendidikan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Jenjang Pendidikan</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Jenjang Pendidikan</h4>
                <div class="table-responsive">
                    <table id="refJenjangPendidikan" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Jenjang Pendidikan</th>
                                <th>Nama Jenjang Pendidikan</th>
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
        $('#refJenjangPendidikan').DataTable({
            ajax: {
                url: 'ref-jenjang-pendidikan'
            },
            columns: [
                { data: 'id_jenjang_didik' },
                { data: 'nama_jenjang_didik' }
            ]
        });
    });
</script>
@endpush
