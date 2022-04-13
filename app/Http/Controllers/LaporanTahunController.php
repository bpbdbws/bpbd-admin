<?php

namespace App\Http\Controllers;

use App\Models\LaporanTahun;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use File;

class LaporanTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LaporanTahun::all();

        return view('admin.laporan_tahun.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.laporan_tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|max:20000'
        ]);

        try {
            $addData = new LaporanTahun;
            $addData->title = $request->title;

            $file = $request->file('file');
            if (isset($file)) {
                $filename = $request->get('title').'-'.date('Y').'.'.$request->file('file')->extension();
                $path = public_path('upload/pdf/');
                if ($file->move($path,$filename)) {
                    $addData->pdf = $filename;
                }
            }
            $addData->save();
            return redirect()->route('back-laporan.index')->withStatus('Berhasil Menambah data');
        } catch (Exception $e) {
           return redirect()->back()->withError('Terdapat kesalahan.');
        } catch (QueryException $e){
           return redirect()->back()->withError('Terdapat kesalahan.');

        }
        $addData = new LaporanTahun;
        $addData->title = $request->title;

        $file = $request->file('file');
        if (isset($file)) {
            $filename = $request->get('title').'-'.date('Y').'.'.$request->file('file')->extension();
            $path = public_path('upload/pdf/');
            if ($file->move($path,$filename)) {
                $addData->pdf = $filename;
            }
        }
        $addData->save();
        return redirect()->route('back-laporan.index')->withStatus('Berhasil mengganti data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = LaporanTahun::findOrFail($id);
        return view('admin.laporan.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'max:20000'
        ]);

        try {
            $updateData = LaporanTahun::findOrFail($id);
            $updateData->title = $request->title;

            $file = $request->file('file');
            if (isset($file)) {
                $last_path = public_path('upload/pdf/').$updateData->pdf;
                unlink($last_path);
                $filename = $request->get('title').'-'.date('Y').'.'.$request->file('file')->extension();
                $path = public_path('upload/pdf/');
                if ($file->move($path,$filename)) {
                    $updateData->pdf = $filename;
                }
            }
            $updateData->save();
            return redirect()->route('back-laporan.index')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
           return redirect()->back()->withError('Terdapat kesalahan.');
        } catch (QueryException $e){
           return redirect()->back()->withError('Terdapat kesalahan.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleteData = LaporanTahun::find($id);
            $path = public_path().'/upload/pdf/'.$deleteData->pdf;
            File::delete($path);
            $deleteData->delete();
            return redirect()->route('back-laporan.index')->withStatus('Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->back()->withError('Terdapat kesalahan.');
        } catch (QueryException $e){
            return redirect()->back()->withError('Terdapat kesalahan.');
        }
    }
}
