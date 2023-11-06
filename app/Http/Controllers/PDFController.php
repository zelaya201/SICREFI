<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateDeclaracion()
    {
      $data = [
        'title' => 'Welcome to CodeSolutionStuff.com',
        'date' => date('m/d/Y')
      ];

      $pdf = PDF::loadView('content.pdf.declaracion', $data);

      return $pdf->download('declaracion_001.pdf');
    }
}
