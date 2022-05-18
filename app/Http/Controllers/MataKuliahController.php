<?php

namespace App\Http\Controllers;

use App\Models\ImportLog;
use App\Helpers\NeoFeeder;
use Illuminate\Http\Request;
use App\Imports\MataKuliahImport;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $getMataKuliah = new NeoFeeder([
                'act' => 'GetMataKuliah',
                'order' => 'nama_program_studi, kode_mata_kuliah'
            ]);

            return $getMataKuliah->getData();
        }

        $getProdi = new NeoFeeder([
            'act' => 'GetProdi',
            'order' => "id_jenjang_pendidikan, nama_program_studi"
        ]);

        $getSemester = new NeoFeeder([
            'act' => 'GetSemester',
            'filter' => "a_periode_aktif = '1'",
            'order' => "id_semester desc"
        ]);

        return view('dashboard.mata-kuliah.index', [
            'prodi' => $getProdi->getData(),
            'semester' => $getSemester->getData()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_studi_pengampu' => 'required',
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $fileUpload = $request->file('file');
        $mataKuliah = new MataKuliahImport;
        $mataKuliah->import($fileUpload);

        if($mataKuliah->failures()->isNotEmpty()) {
            return back()->with('import-error', $mataKuliah->failures()[0]);
        } else {
            $dataMataKuliah = $mataKuliah->toArray($fileUpload);

            foreach ($dataMataKuliah[0] as $key => $data) {
                try {
                    $recordInsertMataKuliah = [
                        'kode_mata_kuliah' => $data['kode_mata_kuliah'],
                        'nama_mata_kuliah' => $data['nama_mata_kuliah'],
                        'id_prodi' => $request->program_studi_pengampu,
                        'id_jenis_mata_kuliah' => $data['id_jenis_mata_kuliah'],
                        'sks_mata_kuliah' => strval($data['sks_tatap_muka'] + $data['sks_praktek'] + $data['sks_praktek_lapangan'] + $data['sks_simulasi']),
                        'sks_tatap_muka' => $data['sks_tatap_muka'],
                        'sks_praktek' => $data['sks_praktek'],
                        'sks_praktek_lapangan' => $data['sks_praktek_lapangan'],
                        'sks_simulasi' => $data['sks_simulasi']
                    ];

                    $insertMataKuliah = new NeoFeeder([
                        'act' => 'InsertMataKuliah',
                        'record' => $recordInsertMataKuliah
                    ]);

                    $responseInsertMataKuliah = $insertMataKuliah->getData();

                    if($responseInsertMataKuliah['error_code'] == '0') {
                        ImportLog::create([
                            'act' => 'InsertMataKuliah',
                            'status' => 'Sukses',
                            'description' => 'Mata Kuliah ' . $data['kode_mata_kuliah'] . ' - ' . $data['nama_mata_kuliah'] . ' sukses diimport'
                        ]);
                    } else {
                        ImportLog::create([
                            'act' => 'InsertMataKuliah',
                            'status' => 'Gagal',
                            'description' => 'Mata Kuliah ' . $data['kode_mata_kuliah'] . ' - ' . $data['nama_mata_kuliah'] . ' gagal diimport. ' . $responseInsertMataKuliah['error_desc']
                        ]);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            return redirect()->back()->with('success', 'Sukses import file. Riwayat import dapat dilihat pada menu Log Import');
        }
    }
}
