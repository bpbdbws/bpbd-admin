<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    private $param;
    public function index()
    {
        try {
            $param['listInstagram'] = Instagram::all();
            return view('admin.instagram.list', $param);
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
                'description' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'title' => 'Judul',
                'description' => 'Link',
            ],
        );

        try {
            $ig = new Instagram();

            $ig->title = $request->title;
            $ig->deskripsi = $request->description;

            $ig->save();
            return redirect('/back-instagram-embed')->withStatus('Berhasil menambah data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function edit(Instagram $instagram)
    {
        try {
            $this->param['getDetailInstagram'] = Instagram::find($instagram->id);
            return view('admin.instagram.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instagram  $instagram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instagram $instagram)
    {
        $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'title' => 'Judul',
                'description' => 'Link',
            ],
        );

        try {
            $ig = Instagram::find($instagram->id);

            $ig->title = $request->title;
            $ig->deskripsi = $request->description;

            $ig->save();
            return redirect('/back-instagram-embed')->withStatus('Berhasil memperbarui data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function destroy(Instagram $instagram)
    {
        try {
            Instagram::find($instagram->id)->delete();
            return redirect('/back-instagram-embed')->withStatus('Berhasil menghapus data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
