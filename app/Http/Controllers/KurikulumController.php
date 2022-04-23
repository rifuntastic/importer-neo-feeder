<?php

namespace App\Http\Controllers;

use App\Models\ImportLog;
use App\Helpers\NeoFeeder;
use Illuminate\Http\Request;
use App\Imports\KurikulumImport;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $getKurikulum = new NeoFeeder([
                'act' => 'GetKurikulum',
                'order' => 'id_semester desc, nama_program_studi'
            ]);

            return $getKurikulum->getData();
        }

        return view('dashboard.kurikulum.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $fileUpload = $request->file('file');
        $kurikulum = new KurikulumImport;
        $kurikulum->import($fileUpload);

        if($kurikulum->failures()->isNotEmpty()) {
            return back()->with('import-error', $kurikulum->failures()[0]);
        } else {
            $dataKurikulum = $kurikulum->toArray($fileUpload);

            foreach ($dataKurikulum[0] as $key => $data) {
                try {
                    $recordInsertKurikulum = [
                        'nama_kurikulum' => $data['nama_kurikulum'],
                        'id_prodi' => $data['id_prodi'],
                        'id_semester' => $data['id_semester'],
                        'jumlah_sks_lulus' => strval($data['jumlah_sks_wajib'] + $data['jumlah_sks_pilihan']),
                        'jumlah_sks_wajib' => $data['jumlah_sks_wajib'],
                        'jumlah_sks_pilihan' => $data['jumlah_sks_pilihan']
                    ];

                    $insertKurikulum = new NeoFeeder([
                        'act' => 'InsertKurikulum',
                        'record' => $recordInsertKurikulum
                    ]);

                    $responseInsertKurikulum = $insertKurikulum->getData();

                    if($responseInsertKurikulum['error_code'] == '0') {
                        ImportLog::create([
                            'act' => 'InsertKurikulum',
                            'status' => 'Sukses',
                            'description' => 'Kurikulum ' . $data['nama_kurikulum'] . ' sukses diimport'
                        ]);
                    } else {
                        ImportLog::create([
                            'act' => 'InsertKurikulum',
                            'status' => 'Gagal',
                            'description' => 'Kurikulum ' . $data['nama_kurikulum'] . ' gagal diimport. ' . $responseInsertKurikulum['error_desc']
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
