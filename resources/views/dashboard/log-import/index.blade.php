@extends('layouts.master-dashboard')

@section('title', 'Log Import')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Log Import</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Log Import</h4>
                <div class="table-responsive">
                    <table id="logImport" class="display expandable-table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Act</th>
                                <th>Status</th>
                                <th>Desckripsi</th>
                                <th>Waktu</th>
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
        let table = $('#logImport').DataTable({
            ajax: {
                url: 'log-import',
                dataSrc: ''
            },
            columns: [
                { data: null, orderable: false, searchable: false },
                { data: 'act' },
                {
                    data: 'status',
                    render: function (data, type, row, meta) {
                        if(data == 'Sukses') {
                            return `<label class="badge badge-outline-success">`+data+`</label>`
                        } else {
                            return `<label class="badge badge-outline-danger">`+data+`</label>`
                        }
                    },
                    className: 'text-center'
                },
                { data: 'description' },
                { data: 'created_at' }
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
