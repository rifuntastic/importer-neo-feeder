<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaBaruImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function rules(): array
    {
        return [
            '*.nim' => 'required',
            '*.nama_mahasiswa' => 'required',
            '*.jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],
            '*.tempat_lahir' => 'required',
            '*.tanggal_lahir' => 'required|date_format:Y-m-d',
            '*.id_agama' => 'required',
            '*.nik' => 'required|digits:16',
            '*.nisn' => 'required',
            '*.kewarganegaraan' => 'required',
            '*.kelurahan' => 'required',
            '*.id_wilayah' => 'required',
            '*.penerima_kps' => [
                'required',
                Rule::in(['0', '1']),
            ],
            '*.nama_ibu_kandung' => 'required',
            '*.id_jalur_daftar' => 'required',
            '*.tanggal_daftar' => 'required|date_format:Y-m-d',
            '*.id_pembiayaan' => 'required',
            '*.biaya_masuk' => 'required',
            '*.email' => 'nullable|email',
            '*.nik_ayah' => 'nullable|digits:16',
            '*.tanggal_lahir_ayah' => 'nullable|date_format:Y-m-d',
            '*.nik_ibu' => 'nullable|digits:16',
            '*.tanggal_lahir_ibu' => 'nullable|date_format:Y-m-d',
            '*.tanggal_lahir_wali' => 'nullable|date_format:Y-m-d',
        ];
    }
}
