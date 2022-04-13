<?php

namespace App\Http\Controllers;

use App\Models\BeritaBencana;
use App\Models\KategoriBencana;
use Illuminate\Http\Request;

class LaporanBencanaController extends Controller
{
    private $param;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BeritaBencana::select('berita_bencana.*', 'kategori_bencana.name as kategori', 'u.name as admin', 'uu.name as user')
            ->leftJoin('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
            ->leftJoin('users as u', 'u.id', 'berita_bencana.id_admin')
            ->join('users as uu', 'uu.id', 'berita_bencana.id_user')
            ->where('berita_bencana.status', '!=', 'accept')
            ->where('berita_bencana.id_user', '!=', null)
            ->orderBy('berita_bencana.status', 'DESC')
            ->orderBy('berita_bencana.title')
            ->orderBy('berita_bencana.created_at', 'DESC')
            ->get();

        $data = array(
            'data' => $data,
        );

        return view('admin.laporan.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        try {
            $this->param['kategori'] = KategoriBencana::orderBy('name')->get();
            $this->param['data'] = BeritaBencana::find($id);
            return view('admin.laporan.edit', $this->param);
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
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
        $this->validate(
            $request,
            [
                'title' => 'required',
                'kategori' => 'required|not_in:0',
                'longitude' => 'required',
                'latitude' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'kategori.not_in' => 'Kategori harus dipilih.',
            ],
            [
                'title' => 'Judul',
                'kategori' => 'Kategori',
                'longitude' => 'Longitude',
                'latitude' => 'Latitude'
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $berita = BeritaBencana::find($id);
            $berita->title = $request->title;
            $berita->id_kategori_bencana = $request->kategori;
            $berita->deskripsi = $request->deskripsi_berita;
            $berita->id_admin = auth()->user()->id;
            $berita->longitude = $request->longitude;
            $berita->latitude = $request->latitude;
            $berita->status = 'accept';

            if ($request->file('cover')) {
                $path = public_path() . '/upload/mitigasi/' . $berita->gambar;

                if (file_exists($path)) {
                    \File::delete($path);
                }
                $request->file('cover')->move('upload/mitigasi', $date . $random . $request->file('cover')->getClientOriginalName());
                $berita->gambar = $date . $random . $request->file('cover')->getClientOriginalName();
            }

            $berita->save();

            return redirect('back-laporan-bencana')->withStatus('Berhasil menyimpan data');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
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
            $data = BeritaBencana::find($id);
            $data->id_admin = auth()->user()->id;
            $data->status = 'declined';

            $data->save();

            return redirect('back-laporan-bencana')->withStatus('Berhasil menolak laporan');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
