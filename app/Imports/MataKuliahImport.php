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

class MataKuliahImport implements
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
            '*.kode_mata_kuliah' => 'required',
            '*.nama_mata_kuliah' => 'required',
            '*.id_jenis_mata_kuliah' => [
                'required',
                Rule::in(['A', 'B', 'C', 'D', 'S']),
            ],
            '*.sks_tatap_muka' => 'required',
            '*.sks_praktek' => 'required',
            '*.sks_praktek_lapangan' => 'required',
            '*.sks_simulasi' => 'required'
        ];
    }
}
