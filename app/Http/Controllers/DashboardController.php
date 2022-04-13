<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\BeritaBencana;
use App\Models\KategoriBencana;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $param;
    public function index()
    {
        $dataBencana = BeritaBencana::where('status','accept')->count();
        $dataKategori = KategoriBencana::count();
        $dataBerita = Berita::count();
        $dataVisitor = Visitor::count();
        // return $dataBencana;
        return view('dashboard',compact('dataBencana','dataKategori','dataBerita', 'dataVisitor'));
    }
}
