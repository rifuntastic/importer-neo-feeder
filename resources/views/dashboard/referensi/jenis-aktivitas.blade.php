@extends('layouts.master-dashboard')

@section('title', 'Referensi Jenis Aktivitas Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 mb-xl-0 mb-4">
                    <h3 class="font-weight-bold">Referensi Jenis Aktivitas Mahasiswa</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Data Referensi Jenis Aktivitas Mahasiswa</h4>
                    <div class="table-responsive">
                        <table id="refJenisAktivitasMahasiswa" class="display expandable-table table-hover"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Jenis Aktivitas</th>
                                    <th>Nama Jenis Aktivitas</th>
                                    <th>Untuk Kampus Merdeka</th>
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
            $('#refJenisAktivitasMahasiswa').DataTable({
                ajax: {
                    url: 'ref-jenis-aktivitas'
                },
                columns: [{
                        data: 'id_jenis_aktivitas_mahasiswa'
                    },
                    {
                        data: 'nama_jenis_aktivitas_mahasiswa'
                    },
                    {
                        data: 'untuk_kampus_merdeka',
                        render: function(data, type, row, meta) {
                            if (data == '0') {
                                return `Tidak`;
                            } else {
                                return `Ya`;
                            }
                        }
                    }
                ]
            });
        });
    </script>
@endpush
