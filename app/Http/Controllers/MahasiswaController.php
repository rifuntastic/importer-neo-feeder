<?php

namespace App\Http\Controllers;

use App\Models\ImportLog;
use App\Helpers\NeoFeeder;
use Illuminate\Http\Request;
use App\Imports\MahasiswaBaruImport;

class MahasiswaController extends Controller
{
    public function index()
    {
        $getProdi = new NeoFeeder([
            'act' => 'GetProdi',
            'order' => "id_jenjang_pendidikan, nama_program_studi"
        ]);

        $getSemester = new NeoFeeder([
            'act' => 'GetSemester',
            'filter' => "a_periode_aktif = '1'",
            'order' => "id_semester desc"
        ]);

        return view('dashboard.mahasiswa.index', [
            'prodi' => $getProdi->getData(),
            'semester' => $getSemester->getData()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_pendaftaran' => 'required',
            'program_studi' => 'required',
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $fileUpload = $request->file('file');
        $mahasiswa = new MahasiswaBaruImport;
        $mahasiswa->import($fileUpload);

        if($mahasiswa->failures()->isNotEmpty()) {
            return back()->with('import-error', $mahasiswa->failures()[0]);
        } else {
            $dataMahasiswa = $mahasiswa->toArray($fileUpload);

            foreach ($dataMahasiswa[0] as $key => $data) {
                try {
                    $recordInsertBiodataMahasiswa = [
                        'nama_mahasiswa' => $data['nama_mahasiswa'],
                        'jenis_kelamin' => $data['jenis_kelamin'],
                        'tempat_lahir' => $data['tempat_lahir'],
                        'tanggal_lahir' => $data['tanggal_lahir'],
                        'id_agama' => $data['id_agama'],
                        'nik' => $data['nik'],
                        'nisn' => $data['nisn'],
                        'npwp' => $data['npwp'] ?? '',
                        'kewarganegaraan' => $data['kewarganegaraan'],
                        'jalan' => $data['jalan'] ?? '',
                        'dusun' => $data['dusun'] ?? '',
                        'rt' => $data['rt'] ?? '',
                        'rw' => $data['rw'] ?? '',
                        'kelurahan' => $data['kelurahan'],
                        'kode_pos' => $data['kode_pos'] ?? '',
                        'id_wilayah' => $data['id_wilayah'],
                        'id_jenis_tinggal' => $data['id_jenis_tinggal'] ?? '',
                        'id_alat_transportasi' => $data['id_alat_transportasi'] ?? '',
                        'telepon' => $data['telepon'] ?? '',
                        'handphone' => $data['handphone'] ?? '',
                        'email' => $data['email'] ?? '',
                        'penerima_kps' => $data['penerima_kps'],
                        'nomor_kps' => $data['nomor_kps'] ?? '',
                        'nik_ayah' => $data['nik_ayah'] ?? '',
                        'nama_ayah' => $data['nama_ayah'] ?? '',
                        'tanggal_lahir_ayah' => $data['tanggal_lahir_ayah'] ?? '',
                        'id_pendidikan_ayah' => $data['id_pendidikan_ayah'] ?? '',
                        'id_pekerjaan_ayah' => $data['id_pekerjaan_ayah'] ?? '',
                        'id_penghasilan_ayah' => $data['id_penghasilan_ayah'] ?? '',
                        'nik_ibu' => $data['nik_ibu'] ?? '',
                        'nama_ibu_kandung' => $data['nama_ibu_kandung'],
                        'tanggal_lahir_ibu' => $data['tanggal_lahir_ibu'] ?? '',
                        'id_pendidikan_ibu' => $data['id_pendidikan_ibu'] ?? '',
                        'id_pekerjaan_ibu' => $data['id_pekerjaan_ibu'] ?? '',
                        'id_penghasilan_ibu' => $data['id_penghasilan_ibu'] ?? '',
                        'nama_wali' => $data['nama_wali'] ?? '',
                        'tanggal_lahir_wali' => $data['tanggal_lahir_wali'] ?? '',
                        'id_pendidikan_wali' => $data['id_pendidikan_wali'] ?? '',
                        'id_pekerjaan_wali' => $data['id_pekerjaan_wali'] ?? '',
                        'id_penghasilan_wali' => $data['id_penghasilan_wali'] ?? '',
                        'id_kebutuhan_khusus_mahasiswa' => $data['id_kebutuhan_khusus_mahasiswa'] ?? '0',
                        'id_kebutuhan_khusus_ayah' => $data['id_kebutuhan_khusus_ayah'] ?? '0',
                        'id_kebutuhan_khusus_ibu' => $data['id_kebutuhan_khusus_ibu'] ?? '0'
                    ];

                    $insertBiodataMahasiswa = new NeoFeeder([
                        'act' => 'InsertBiodataMahasiswa',
                        'record' => $recordInsertBiodataMahasiswa
                    ]);

                    $responseInsertBiodataMahasiswa = $insertBiodataMahasiswa->getData();

                    if($responseInsertBiodataMahasiswa['error_code'] == '0') {
                        ImportLog::create([
                            'act' => 'InsertBiodataMahasiswa',
                            'status' => 'Sukses',
                            'description' => 'Biodata Mahasiswa ' . $data['nim'] . ' - ' . $data['nama_mahasiswa'] . ' sukses diimport'
                        ]);

                        $getProfilPT = new NeoFeeder([
                            'act' => 'GetProfilPT'
                        ]);

                        $responseProfilPT = $getProfilPT->getData();

                        $recordInsertRiwayatPendidikanMahasiswa = [
                            'id_mahasiswa' => $responseInsertBiodataMahasiswa['data']['id_mahasiswa'],
                            'nim' => $data['nim'],
                            'id_jenis_daftar' => '1', #wajib isi 1 = perserta didik baru
                            'id_jalur_daftar' => $data['id_jalur_daftar'],
                            'id_periode_masuk' => $request->periode_pendaftaran,
                            'tanggal_daftar' => $data['tanggal_daftar'],
                            'id_perguruan_tinggi' => $responseProfilPT['data'][0]['id_perguruan_tinggi'],
                            'id_prodi' => $request->program_studi,
                            'id_bidang_minat' => '',
                            'sks_diakui' => '',
                            'id_perguruan_tinggi_asal' => '',
                            'id_prodi_asal' => '',
                            'id_pembiayaan' => $data['id_pembiayaan'],
                            'biaya_masuk' => $data['biaya_masuk']
                        ];

                        $insertRiwayatPendidikanMahasiswa = new NeoFeeder([
                            'act' => 'InsertRiwayatPendidikanMahasiswa',
                            'record' => $recordInsertRiwayatPendidikanMahasiswa
                        ]);

                        $responseInsertRiwayatPendidikanMahasiswa = $insertRiwayatPendidikanMahasiswa->getData();

                        if($responseInsertRiwayatPendidikanMahasiswa['error_code'] == '0') {
                            ImportLog::create([
                                'act' => 'InsertRiwayatPendidikanMahasiswa',
                                'status' => 'Sukses',
                                'description' => 'Riwayat Pendidikan Mahasiswa ' . $data['nim'] . ' - ' . $data['nama_mahasiswa'] . ' sukses diimport'
                            ]);
                        } else {
                            ImportLog::create([
                                'act' => 'InsertRiwayatPendidikanMahasiswa',
                                'status' => 'Gagal',
                                'description' => 'Riwayat Pendidikan Mahasiswa ' . $data['nim'] . ' - ' . $data['nama_mahasiswa'] . ' sukses diimport. ' . $responseInsertRiwayatPendidikanMahasiswa['error_desc']
                            ]);
                        }
                    } else {
                        ImportLog::create([
                            'act' => 'InsertBiodataMahasiswa',
                            'status' => 'Gagal',
                            'description' => 'Biodata Mahasiswa ' . $data['nim'] . ' - ' . $data['nama_mahasiswa'] . ' gagal diimport. ' . $responseInsertBiodataMahasiswa['error_desc']
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
