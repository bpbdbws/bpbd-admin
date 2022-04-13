<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BeritaBencana;
use App\Models\KategoriBencana;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeritaBencanaController extends Controller
{
    public function listKategori()
    {
        try {
            $data = KategoriBencana::orderBy('name')->get();

            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function databencanaall()
    {
        try {
            $data = BeritaBencana::select('berita_bencana.id', 'berita_bencana.title', 'berita_bencana.id_kategori_bencana', 'berita_bencana.deskripsi', 'berita_bencana.longitude', 'berita_bencana.latitude', 'berita_bencana.gambar', 'berita_bencana.id_admin', 'berita_bencana.id_user', 'berita_bencana.status', 'berita_bencana.desa_id', 'berita_bencana.kecamatan_id', 'berita_bencana.created_at', 'kategori_bencana.id as id_kategori', 'kategori_bencana.name', 'kategori_bencana.icon', 'kategori_bencana.link_embed', 'kategori_bencana.photos', 'kecamatan.kecamatan as nama_kecamatan', 'desa.desa as nama_desa')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                ->join('kecamatan', 'kecamatan.id', 'berita_bencana.kecamatan_id')
                ->join('desa', 'desa.id', 'berita_bencana.desa_id')
                ->orderBy('created_at', 'DESC')
                ->get();

            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function databencana($kecamatan, $kategori)
    {
        try {
            $data = BeritaBencana::select('berita_bencana.id', 'berita_bencana.title', 'berita_bencana.id_kategori_bencana', 'berita_bencana.deskripsi', 'berita_bencana.longitude', 'berita_bencana.latitude', 'berita_bencana.gambar', 'berita_bencana.id_admin', 'berita_bencana.id_user', 'berita_bencana.status', 'berita_bencana.desa_id', 'berita_bencana.kecamatan_id', 'berita_bencana.created_at', 'kategori_bencana.id as id_kategori', 'kategori_bencana.name', 'kategori_bencana.icon', 'kategori_bencana.link_embed', 'kategori_bencana.photos', 'kecamatan.kecamatan as nama_kecamatan', 'desa.desa as nama_desa')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                ->join('kecamatan', 'kecamatan.id', 'berita_bencana.kecamatan_id')
                ->join('desa', 'desa.id', 'berita_bencana.desa_id')
                ->where('kecamatan.kecamatan', 'LIKE', '%' . $kecamatan . '%')
                ->where('berita_bencana.id_kategori_bencana', $kategori)
                ->get();

            // $data_kategori = $kategori;
            // if ($data_kategori == "semua") {
            //     $data = $data->orderBy('created_at', 'DESC')->get();
            // } else {
            //     $data = $data->where('kategori_bencana.name', $data_kategori)->orderBy('created_at', 'DESC')->get();
            // }

            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function mitigasibencanaall()
    {
        try {
            $data = KategoriBencana::select('kategori_bencana.id', 'kategori_bencana.name', 'kategori_bencana.icon','kategori_bencana.link_embed','kategori_bencana.photos')
                ->orderBy('created_at', 'DESC')
                ->get();

            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function mitigasibencana($id)
    {
        try {
            $data = KategoriBencana::select('*');
            if (isset($id)) {
                $data = $data->where('id', $id)->get();
            }
            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function databencanakecamatan($kecamatan)
    {
        // return $kecamatan;
        try {
            // $kecamatan = strtolower($kecamatan);
            $data = BeritaBencana::select('berita_bencana.id_kategori_bencana', 'kategori_bencana.name', 'kategori_bencana.icon')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                ->join('kecamatan', 'kecamatan.id', 'berita_bencana.kecamatan_id')
                ->join('desa', 'desa.id', 'berita_bencana.desa_id')
                ->where('kecamatan.kecamatan', 'LIKE', '%' . $kecamatan . '%')
                ->groupBy('berita_bencana.id_kategori_bencana')
                ->groupBy('kategori_bencana.name')
                ->groupBy('kategori_bencana.icon')
                ->get();
            if ($data == '') {
                $response = [
                    'success' => false,
                    'message' => 'data tidak ada BLOK.',
                    'data' => $data,

                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.' . $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function searchbencana($kecamatan, $title)
    {
        $kecamatan = strtolower($kecamatan);
        $title = strtolower($title);
        try {
            $data = BeritaBencana::select('berita_bencana.id', 'berita_bencana.title', 'berita_bencana.id_kategori_bencana', 'berita_bencana.deskripsi', 'berita_bencana.longitude', 'berita_bencana.latitude', 'berita_bencana.gambar', 'berita_bencana.id_admin', 'berita_bencana.id_user', 'berita_bencana.status', 'berita_bencana.desa_id', 'berita_bencana.kecamatan_id', 'berita_bencana.created_at', 'kategori_bencana.id as id_kategori', 'kategori_bencana.name', 'kategori_bencana.icon', 'kategori_bencana.link_embed', 'kategori_bencana.photos', 'kecamatan.kecamatan as nama_kecamatan', 'desa.desa as nama_desa')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                ->join('kecamatan', 'kecamatan.id', 'berita_bencana.kecamatan_id')
                ->join('desa', 'desa.id', 'berita_bencana.desa_id')
                ->where('kecamatan.kecamatan', 'LIKE', '%' . $kecamatan . '%')
                ->where('berita_bencana.title', 'LIKE', '%' . $title . '%')
                ->get();
            if ($data == '') {
                $response = [
                    'success' => false,
                    'message' => 'data tidak ada BLOK.',

                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function searchbencanakategori($kecamatan, $kategori, $title)
    {
        $kecamatan = strtolower($kecamatan);
        $title = strtolower($title);
        try {
            $data = BeritaBencana::select('berita_bencana.id', 'berita_bencana.title', 'berita_bencana.id_kategori_bencana', 'berita_bencana.deskripsi', 'berita_bencana.longitude', 'berita_bencana.latitude', 'berita_bencana.gambar', 'berita_bencana.id_admin', 'berita_bencana.id_user', 'berita_bencana.status', 'berita_bencana.desa_id', 'berita_bencana.kecamatan_id', 'berita_bencana.created_at', 'kategori_bencana.id as id_kategori', 'kategori_bencana.name', 'kategori_bencana.icon', 'kategori_bencana.link_embed', 'kategori_bencana.photos', 'kecamatan.kecamatan as nama_kecamatan', 'desa.desa as nama_desa')
                ->join('kategori_bencana', 'kategori_bencana.id', 'berita_bencana.id_kategori_bencana')
                ->join('kecamatan', 'kecamatan.id', 'berita_bencana.kecamatan_id')
                ->join('desa', 'desa.id', 'berita_bencana.desa_id')
                ->where('kecamatan.kecamatan', 'LIKE', '%' . $kecamatan . '%')
                ->where('berita_bencana.id_kategori_bencana', $kategori)
                ->where('berita_bencana.title', 'LIKE', '%' . $title . '%')
                ->get();
            if ($data == '') {
                $response = [
                    'success' => false,
                    'message' => 'data tidak ada BLOK.',

                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
