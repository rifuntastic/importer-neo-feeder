<?php

namespace App\Http\Controllers;

use App\Helpers\NeoFeeder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function agama(Request $request)
    {
        if($request->ajax()) {
            $getAgama = new NeoFeeder([
                'act' => 'GetAgama'
            ]);

            return $getAgama->getData();
        }

        return view('dashboard.referensi.agama');
    }

    public function alatTransportasi(Request $request)
    {
        if($request->ajax()) {
            $getAlatTransportasi = new NeoFeeder([
                'act' => 'GetAlatTransportasi'
            ]);

            return $getAlatTransportasi->getData();
        }

        return view('dashboard.referensi.alat-transportasi');
    }

    public function jalurDaftar(Request $request)
    {
        if($request->ajax()) {
            $getJalurMasuk = new NeoFeeder([
                'act' => 'GetJalurMasuk'
            ]);

            return $getJalurMasuk->getData();
        }

        return view('dashboard.referensi.jalur-daftar');
    }

    public function jenisTinggal(Request $request)
    {
        if($request->ajax()) {
            $getJenisTinggal = new NeoFeeder([
                'act' => 'GetJenisTinggal'
            ]);

            return $getJenisTinggal->getData();
        }

        return view('dashboard.referensi.jenis-tinggal');
    }

    public function jenjangPendidikan(Request $request)
    {
        if($request->ajax()) {
            $getJenjangPendidikan = new NeoFeeder([
                'act' => 'GetJenjangPendidikan'
            ]);

            return $getJenjangPendidikan->getData();
        }

        return view('dashboard.referensi.jenjang-pendidikan');
    }

    public function kebutuhanKhusus(Request $request)
    {
        if($request->ajax()) {
            $getKebutuhanKhusus = new NeoFeeder([
                'act' => 'GetKebutuhanKhusus'
            ]);

            return $getKebutuhanKhusus->getData();
        }

        return view('dashboard.referensi.kebutuhan-khusus');
    }

    public function negara(Request $request)
    {
        if($request->ajax()) {
            $getNegara = new NeoFeeder([
                'act' => 'GetNegara'
            ]);

            return $getNegara->getData();
        }

        return view('dashboard.referensi.negara');
    }

    public function pekerjaan(Request $request)
    {
        if($request->ajax()) {
            $getPekerjaan = new NeoFeeder([
                'act' => 'GetPekerjaan'
            ]);

            return $getPekerjaan->getData();
        }

        return view('dashboard.referensi.pekerjaan');
    }

    public function pembiayaan(Request $request)
    {
        if($request->ajax()) {
            $getPembiayaan = new NeoFeeder([
                'act' => 'GetPembiayaan'
            ]);

            return $getPembiayaan->getData();
        }

        return view('dashboard.referensi.pembiayaan');
    }

    public function penghasilan(Request $request)
    {
        if($request->ajax()) {
            $getPenghasilan = new NeoFeeder([
                'act' => 'GetPenghasilan'
            ]);

            return $getPenghasilan->getData();
        }

        return view('dashboard.referensi.penghasilan');
    }

    public function prodi(Request $request)
    {
        if($request->ajax()) {
            $getProdi = new NeoFeeder([
                'act' => 'GetProdi',
                'order' => 'nama_jenjang_pendidikan, nama_program_studi'
            ]);

            return $getProdi->getData();
        }

        return view('dashboard.referensi.prodi');
    }

    public function wilayah()
    {
        $getWilayahNegara = new NeoFeeder([
            'act' => 'GetWilayah',
            'filter' => "id_negara != 'ID'",
            'order' => 'nama_wilayah',
        ]);

        return view('dashboard.referensi.wilayah', [
            'negara' => $getWilayahNegara->getData()
        ]);
    }

    public function wilayahProvinsi()
    {
        $getWilayahProvinsi = new NeoFeeder([
            'act' => 'GetWilayah',
            'filter' => "id_negara = 'ID'",
            'filter' => "nama_wilayah like 'Prov.%'",
            'order' => "nama_wilayah"
        ]);

        return $getWilayahProvinsi->getData();
    }

    public function wilayahKota(Request $request)
    {
        $idProvinsi = Str::substr($request->provinsi, 0, 2);

        $getWilayahKota = new NeoFeeder([
            'act' => 'GetWilayah',
            'filter' => "id_wilayah like '$idProvinsi%' and (nama_wilayah like 'Kota%' or nama_wilayah like 'Kab.%')",
            'order' => "nama_wilayah"
        ]);

        return $getWilayahKota->getData();
    }

    public function wilayahKecamatan(Request $request)
    {
        $idKota = Str::substr($request->kota, 0, 4);

        $getWilayahKota = new NeoFeeder([
            'act' => 'GetWilayah',
            'filter' => "id_wilayah like '$idKota%' and nama_wilayah like 'Kec.%'",
            'order' => "nama_wilayah"
        ]);

        return $getWilayahKota->getData();
    }
}
