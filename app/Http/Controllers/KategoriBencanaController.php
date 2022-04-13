<?php

namespace App\Http\Controllers;

use App\Models\KategoriBencana;
use Illuminate\Http\Request;

class KategoriBencanaController extends Controller
{
    private $param;
    public function index()
    {
        try {
            $param['listKategori'] = KategoriBencana::all();
            return view('admin.berita_kategori.list', $param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'mitigation' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'title' => 'Judul',
                'mitigation' => 'Mitigasi',
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $kategori = new KategoriBencana();
            $kategori->name = $request->title;
            $kategori->mitigasi = $request->mitigation;
            $kategori->link_embed = $request->link_embed;

            if ($request->file('icon')) {
                $filename = public_path('upload/kategori');
                $request->file('icon')->move($filename, $date.$random.$request->file('icon')->getClientOriginalName());
                $kategori->icon = $date.$random.$request->file('icon')->getClientOriginalName();
            } else {
                $kategori->icon = 'kategori.jpg';
            }
            // Foto KRB
            if ($request->file('photos')) {
                $filename = public_path('upload/kategori');
                $request->file('photos')->move($filename, $date.$random.$request->file('photos')->getClientOriginalName());
                $kategori->photos = $date.$random.$request->file('photos')->getClientOriginalName();
            } else {
                $kategori->photos = 'kategori.jpg';
            }

            $kategori->save();
            return redirect('/back-kategori-bencana')->withStatus('Berhasil menambah data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit(KategoriBencana $kategoriBencana)
    {
        try {
            $this->param['getDetailKategori'] = KategoriBencana::find($kategoriBencana->id);
            return view('admin.berita_kategori.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, KategoriBencana $kategoriBencana)
    {
        $this->validate($request, [
                'title' => 'required',
                'mitigation' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'title' => 'Judul',
                'mitigation' => 'Mitigasi',
            ],
        );

        try {
            $date = date('H-i-s');
            $random = \Str::random(5);

            $kategori = KategoriBencana::find($kategoriBencana->id);
            $kategori->name = $request->title;
            $kategori->mitigasi = $request->mitigation;
            $kategori->mitigasi = $request->mitigation;
            $kategori->link_embed = $request->link_embed;

            if ($request->file('icon')) {
                $path = public_path() . '/upload/kategori/' .  $kategori->icon;

                if (file_exists($path)) {
                    \File::delete($path);
                }
                $filename = public_path('upload/kategori');
                $request->file('icon')->move($filename, $date.$random.$request->file('icon')->getClientOriginalName());
                $kategori->icon = $date.$random.$request->file('icon')->getClientOriginalName();
            }

            // Foto KRB
            if ($request->file('photos')) {
                $path = public_path() . '/upload/mitigasi/' .  $kategori->photos;

                if (file_exists($path)) {
                    \File::delete($path);
                }
                $filename = public_path('upload/mitigasi');
                $request->file('photos')->move($filename, $date.$random.$request->file('photos')->getClientOriginalName());
                $kategori->photos = $date.$random.$request->file('photos')->getClientOriginalName();
            }

            $kategori->save();
            return redirect('/back-kategori-bencana')->withStatus('Berhasil memperbarui data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function destroy(KategoriBencana $kategoriBencana)
    {
        try {
            KategoriBencana::find($kategoriBencana->id)->delete();
            return redirect('/back-kategori-bencana')->withStatus('Berhasil menghapus data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
    public function create()
    {
        return view('admin.berita_kategori.create');
    }
}
