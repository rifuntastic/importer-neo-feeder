<?php

namespace App\Http\Controllers;

use App\Models\ImportLog;
use Illuminate\Http\Request;

class LogImportController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $getLogImport = ImportLog::orderBy('created_at', 'desc')->get();

            return $getLogImport;
        }

        return view('dashboard.log-import.index');
    }
}
