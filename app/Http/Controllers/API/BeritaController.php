<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeritaController extends Controller
{
    public function beritaall()
    {
        $data = Berita::select('berita.title', 'berita.link_artikel', 'berita.cover', 'berita.kategori_id', 'berita.user_id', 'berita.created_at', 'users.id', 'users.name', 'kategori_bencana.name')
            ->join('users', 'users.id', 'berita.user_id')
            ->join('kategori_bencana', 'kategori_bencana.id', 'berita.kategori_id')
            ->get();
        $response = [
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $data
        ];
        return response()->json($response, 200);
    }
    public function searchBerita(Request $request)
    {
        try {
            $cari = $request->judul;

            $dataBerita = Berita::select('berita.title', 'berita.link_artikel', 'berita.cover', 'berita.kategori_id', 'berita.user_id', 'berita.created_at', 'users.id', 'users.name', 'kategori_bencana.name')
                ->join('users', 'users.id', 'berita.user_id')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita.kategori_id');
            if ($cari != null && $cari != '') {
                $data = $dataBerita->where('berita.title', 'like', "%" . $cari . "%")->get();
            }
            $data = $dataBerita->get();
            $response = [
                'success' => true,
                'message' => 'Data berhasil diambil.',
                'data' => $data,
            ];
            return response()->json($response, Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json('Terjadi kesalahan.', Response::HTTP_BAD_REQUEST);
        }
    }
    public function beritakategori($kategori)
    {
        try {
            $dataBerita = Berita::select('berita.title', 'berita.link_artikel', 'berita.cover', 'berita.kategori_id', 'berita.user_id', 'berita.created_at', 'users.id', 'users.name', 'kategori_bencana.name')
                ->join('users', 'users.id', 'berita.user_id')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita.kategori_id');

            if ($kategori == 'all') {
                $data = $dataBerita->orderBy('created_at', 'DESC')->get();
            } else {
                $data = $dataBerita->where('kategori_bencana.id', $kategori)->orderBy('created_at', 'DESC')->get();
            }
            $response = [
                'success' => true,
                'message' => 'Data berhasil diambil',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ]);
        }
    }
    public function beritakategorititle($kategori, $title)
    {
        try {
            $data = Berita::select('berita.title', 'berita.link_artikel', 'berita.cover', 'berita.kategori_id', 'berita.user_id', 'berita.created_at', 'users.id', 'users.name', 'kategori_bencana.name')
                ->join('users', 'users.id', 'berita.user_id')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita.kategori_id')
                ->where('kategori_bencana.id', $kategori)
                ->where('berita.title', 'LIKE', '%' . $title . '%')
                ->orderBy('created_at', 'DESC')
                ->get();

            // if ($kategori == 'all') {
            //     $data = $dataBerita->orderBy('created_at', 'DESC')->get();
            // }else{
            //     $data = $dataBerita->where('kategori_bencana.id',$kategori)->orderBy('created_at','DESC')->get();
            // }
            $response = [
                'success' => true,
                'message' => 'Data berhasil diambil',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ]);
        }
    }
}
