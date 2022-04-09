@extends('layouts.master-dashboard')

@section('title', 'Referensi Wilayah')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Referensi Wilayah</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Data Referensi Wilayah</h4>
                <form>
                    <div class="row">
                        <div class="form-group col-lg-3" id="level1">
                            <label>Negara</label>
                            <select class="form-control" id="negara" name="negara">
                                <option value="ID">Indonesia</option>
                                @foreach ($negara['data'] as $negara)
                                <option value="{{ $negara['id_wilayah'] }}">
                                    {{ $negara['nama_wilayah'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" id="level2">
                            <label>Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi">
                            </select>
                        </div>
                        <div class="form-group col-lg-3" id="level3">
                            <label>Kota/Kabupaten</label>
                            <select class="form-control" id="kota" name="kota">
                            </select>
                        </div>
                        <div class="form-group col-lg-3" id="level4">
                            <label>Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">ID Wilayah</p>
                                    <p class="fs-30" id="wilayah">
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
        $('#level2').hide();
        $('#level3').hide();
        $('#level4').hide();

        $('#negara').on('change', function() {
            $('#wilayah').html('');

            let negara = $(this).val();

            if(negara == 'ID') {
                $('#level2').show();

                $.ajax({
                    type: 'get',
                    url: 'ref-wilayah-provinsi',
                    dataType: 'json',
                    beforeSend: function () {
                        $('#provinsi').html('');
                    },
                    success: function(response) {
                        $('#level2').show('');
                        $.each(response.data, function(i, val) {
                            $('#provinsi').append(
                                `
                                <option value="${val.id_wilayah}">${val.nama_wilayah}</option>
                                `
                            );
                        });
                        $('#provinsi').selectpicker('refresh');
                        $('#provinsi').selectpicker('render');
                    }
                });
            } else {
                $('#provinsi').html('');
                $('#level2').hide();
                $('#level3').hide();
                $('#level4').hide();
                $('#wilayah').html(negara);
            }
        });

        $('#provinsi').on('change', function() {
            let data = {
                provinsi: $(this).val(),
            }

            $.ajax({
                type: 'get',
                url: 'ref-wilayah-kota',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $('#kota').html('');
                    $('#wilayah').html('');
                    $('#level4').hide();
                },
                success: function(response) {
                    $('#level3').show('');
                    $.each(response.data, function(i, val) {
                        $('#kota').append(
                            `
                            <option value="${val.id_wilayah}">${val.nama_wilayah}</option>
                            `
                        );
                    });
                    $('#kota').selectpicker('refresh');
                    $('#kota').selectpicker('render');
                }
            });
        });

        $('#kota').on('change', function() {
            let data = {
                kota: $(this).val(),
            }

            $.ajax({
                type: 'get',
                url: 'ref-wilayah-kecamatan',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $('#kecamatan').html('');
                    $('#wilayah').html('');
                },
                success: function(response) {
                    $('#level4').show('');
                    $.each(response.data, function(i, val) {
                        $('#kecamatan').append(
                            `
                            <option value="${val.id_wilayah}">${val.nama_wilayah}</option>
                            `
                        );
                    });
                    $('#kecamatan').selectpicker('refresh');
                    $('#kecamatan').selectpicker('render');
                }
            });
        });

        $('#kecamatan').on('change', function() {
            let data = {
                kecamatan: $(this).val(),
            }

            $('#wilayah').html(data.kecamatan);
        });
    });
</script>
@endpush
