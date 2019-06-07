<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function exportRecord()
    {
        $data = '';
        $pdf = \PDF::loadView('transaction',  compact('data'));
        return $pdf->download('record.pdf');
    }
}
