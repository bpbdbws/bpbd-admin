<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBencana;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $param;
    public function index()
    {
        $data = Berita::select('berita.*', 'kategori_bencana.name as kategori')
            ->join('kategori_bencana', 'kategori_bencana.id', 'berita.kategori_id')
            ->orderBy('berita.title')
            ->orderBy('berita.created_at', 'DESC')->get();


        $data = array(
            'data' => $data,
        );

        return view('admin.berita.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = KategoriBencana::orderBy('name')->get();

        $data = array(
            'kategori' => $kategori
        );

        return view('admin.berita.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'kategori' => 'required|not_in:0',
                'cover' => 'required',
                'link' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'kategori.not_in' => 'Kategori harus dipilih.',
            ],
            [
                'title' => 'Judul',
                'kategori' => 'Kategori',
                'cover' => 'Cover',
                'link' => 'Link artikel',
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $berita = new Berita;
            $berita->title = $request->title;
            $berita->kategori_id = $request->kategori;
            $berita->deskripsi = $request->deskripsi_berita;
            $berita->link_artikel = $request->link;
            $berita->user_id = auth()->user()->id;

            if ($request->file('cover')) {
                $request->file('cover')->move('upload/berita', $date . $random . $request->file('cover')->getClientOriginalName());
                $berita->cover = $date . $random . $request->file('cover')->getClientOriginalName();
            }

            $berita->save();

            return redirect('back-berita')->withStatus('Berhasil menambah data');
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
            $this->param['data'] = Berita::find($id);
            return view('admin.berita.edit', $this->param);
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
                'link' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'kategori.not_in' => 'Kategori harus dipilih.',
            ],
            [
                'title' => 'Judul',
                'kategori' => 'Kategori',
                'link' => 'Link artikel',
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $berita = Berita::find($id);
            $berita->title = $request->title;
            $berita->kategori_id = $request->kategori;
            $berita->deskripsi = $request->deskripsi_berita;
            $berita->link_artikel = $request->link;
            $berita->user_id = auth()->user()->id;

            if ($request->file('cover')) {
                $path = public_path() . '/upload/berita/' . $berita->cover;

                if (file_exists($path)) {
                    \File::delete($path);
                }
                $request->file('cover')->move('upload/berita', $date . $random . $request->file('cover')->getClientOriginalName());
                $berita->cover = $date . $random . $request->file('cover')->getClientOriginalName();
            }

            $berita->save();

            return redirect('back-berita')->withStatus('Berhasil menyimpan data');
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
            $berita = Berita::find($id);
            if ($berita->cover != null) {
                $path = public_path() . '/upload/berita/' . $berita->cover;

                if (file_exists($path)) {
                    \File::delete($path);
                }

                $berita->delete();
            } else
                $berita->delete();
            return redirect('/back-berita')->withStatus('Berhasil menghapus data');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
    public function dataarray()
    {
        $data = array(
            [
                'nama' => "Rifjan Jundila",
                'hobi' => ['Menulis', 'Membaca', 'Sepak bola'],
                'alamat' => 'Probolinggo'
            ],
            [
                'nama' => "Viky Lorent",
                'hobi' => ['Menulis', 'Membaca', 'Sepak bola'],
                'alamat' => 'Blitar'
            ]
        );
        $dataCoba = array([
            'kota' => [
                'Bondowoso',
                'Probolinggo'
            ],
            'kabupaten' => [
                'Kab. Probolinggo',
                'Kab. Jember'
            ]
        ]);
        // return $dataCoba;
        return view('data-array', compact('data', 'dataCoba'));
    }
}
