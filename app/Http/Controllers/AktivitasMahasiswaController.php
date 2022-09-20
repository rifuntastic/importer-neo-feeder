<?php

namespace App\Http\Controllers;

use App\Models\ImportLog;
use App\Helpers\NeoFeeder;
use Illuminate\Http\Request;
use App\Imports\AktivitasMahasiswaImport;

class AktivitasMahasiswaController extends Controller
{
    public function index()
    {
        $getSemester = new NeoFeeder([
            'act' => 'GetSemester',
            'filter' => "a_periode_aktif = '1'",
            'order' => "id_semester desc"
        ]);

        return view('dashboard.aktivitas-mahasiswa.index', [
            'semester' => $getSemester->getData()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $fileUpload = $request->file('file');
        $aktivitas = new AktivitasMahasiswaImport;
        $aktivitas->import($fileUpload);

        if($aktivitas->failures()->isNotEmpty()) {
            return back()->with('import-error', $aktivitas->failures()[0]);
        } else {
            $dataAktivitas = $aktivitas->toArray($fileUpload);

            foreach ($dataAktivitas[0] as $key => $data) {
                try {
                    $recordInsertAktivitasMahasiswa = [
                        'jenis_anggota' => $data['jenis_anggota'],
                        'id_jenis_aktivitas' => $data['id_jenis_aktivitas'],
                        'id_prodi' => $data['id_prodi'],
                        'id_semester' => $request->semester,
                        'judul' => $data['judul'],
                        'keterangan' => $data['keterangan'],
                        'lokasi' => $data['lokasi'],
                        'sk_tugas' => $data['sk_tugas'],
                        'tanggal_sk_tugas' => $data['tanggal_sk_tugas'],
                    ];

                    $insertAktivitasMahasiswa = new NeoFeeder([
                        'act' => 'InsertAktivitasMahasiswa',
                        'record' => $recordInsertAktivitasMahasiswa
                    ]);

                    $responseInsertAktivitasMahasiswa = $insertAktivitasMahasiswa->getData();

                    if ($responseInsertAktivitasMahasiswa['error_code'] == '0') {
                        ImportLog::create([
                            'act' => 'InsertAktivitasMahasiswa',
                            'status' => 'Sukses',
                            'description' => 'Aktivitas Mahasiswa ' . $data['judul'] . ' sukses diimport'
                        ]);
                    } else {
                        ImportLog::create([
                            'act' => 'InsertAktivitasMahasiswa',
                            'status' => 'Gagal',
                            'description' => 'Aktivitas Mahasiswa ' . $data['judul'] . ' gagal diimport. ' . $responseInsertAktivitasMahasiswa['error_desc']
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
