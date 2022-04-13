<?php

namespace App\Http\Controllers;

use App\Models\BeritaBencana;
use App\Models\Desa;
use App\Models\KategoriBencana;
use App\Models\Kecamatan;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BencanaExport;
class MitigasiBencanaController extends Controller
{
    private $param;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BeritaBencana::select('berita_bencana.*', 'kategori_bencana.name as kategori','kecamatan.id','kecamatan.kecamatan')
                                ->join('kecamatan','kecamatan.id','berita_bencana.kecamatan_id')
                                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                                ->where('berita_bencana.id_admin', '!=', null)
                                ->orWhere('berita_bencana.status', 'accept')
                                ->orderBy('berita_bencana.title')
                                ->orderBy('berita_bencana.created_at', 'DESC')
                                ->get();

        $data = array(
            'data' => $data,
        );

        return view('admin.mitigasi.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = KategoriBencana::orderBy('name')->get();
        $desa = Desa::orderBy('desa')->where('id_kabupaten','3511')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan')->where('id_kabupaten','3511')->get();
        $data = array(
            'kategori' => $kategori
        );

        return view('admin.mitigasi.create', compact('kategori','desa','kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate(
            $request,
            [
                'title' => 'required',
                'kategori' => 'required|not_in:0',
                'cover' => 'required',
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
                'cover' => 'Cover',
                'longitude' => 'Longitude',
                'latitude' => 'Latitude'
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $berita = new BeritaBencana;
            $berita->title = $request->title;
            $berita->id_kategori_bencana = $request->kategori;
            $berita->deskripsi = $request->deskripsi_berita;
            $berita->id_admin = auth()->user()->id;
            $berita->longitude = $request->longitude;
            $berita->latitude = $request->latitude;
            $berita->status = 'accept';
            $berita->desa_id = $request->desa;
            $berita->kecamatan_id = $request->kecamatan;

            if ($request->file('cover')) {
                $filename = public_path('upload/mitigasi');
                $request->file('cover')->move($filename, $date . $random . $request->file('cover')->getClientOriginalName());
                $berita->gambar = $date . $random . $request->file('cover')->getClientOriginalName();
            }

            $berita->save();

            return redirect('back-mitigasi')->withStatus('Berhasil menambah data');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
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
            $this->param['desa'] = Desa::orderBy('desa')->where('id_kabupaten','3511')->get();
            $this->param['kecamatan'] = Kecamatan::orderBy('kecamatan')->where('id_kabupaten','3511')->get();
            return view('admin.mitigasi.edit', $this->param);
        } catch (Exception $e) {
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
            $berita->desa_id = $request->desa;
            $berita->kecamatan_id = $request->kecamatan;

            if ($request->file('cover')) {
                $path = public_path() . '/upload/mitigasi/' . $berita->gambar;

                if (file_exists($path)) {
                    \File::delete($path);
                }
                $filename = public_path('upload/mitigasi');
                $request->file('cover')->move($filename, $date . $random . $request->file('cover')->getClientOriginalName());
                $berita->gambar = $date . $random . $request->file('cover')->getClientOriginalName();
            }

            $berita->save();

            return redirect('back-mitigasi')->withStatus('Berhasil menyimpan data');
        } catch (Exception $e) {
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
            $berita = BeritaBencana::find($id);
            if ($berita->gambar != null) {
                $path = public_path() . '/upload/mitigasi/' . $berita->gambar;

                if (file_exists($path)) {
                    \File::delete($path);
                }

                $berita->delete();
            } else
                $berita->delete();
            return redirect('/back-mitigasi')->withStatus('Berhasil menghapus data');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function export()
    {
        $data = BeritaBencana::select(
            'berita_bencana.title as judul',
            'kategori_bencana.name as kategori',
            'berita_bencana.deskripsi',
            'berita_bencana.longitude',
            'berita_bencana.latitude',
            'berita_bencana.updated_at as waktu',
        )
        ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
        ->where('berita_bencana.id_admin', '!=', null)
        ->orWhere('berita_bencana.status', 'accept')
        ->orderBy('berita_bencana.title')
        ->orderBy('berita_bencana.created_at', 'DESC')
        ->get();

        return Excel::download(new BencanaExport($data), 'bencana.xlsx');
    }
}
