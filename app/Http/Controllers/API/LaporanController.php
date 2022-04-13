<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\LaporanNotifikasiMail;
use App\Models\BeritaBencana;
use App\Models\KategoriBencana;
use App\Models\LaporanTahun;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->only('title', 'alamat', 'desc');
        // $fields = Validator::make($request->all(),[
        $fields = Validator::make($data, [
            'title' => ['required', 'string'],
            'alamat' => ['required'],
            'desc' => ['required'],
            // 'file' => ['required'],
            // 'tmpfile' => ['required']
        ]);

        if ($fields->fails()) {
            return response()->json($fields->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $createLaporan = new BeritaBencana;
            $createLaporan->title = $request->title;
            $createLaporan->deskripsi = $request->desc;
            $createLaporan->alamat = $request->alamat;
            $createLaporan->longitude = $request->longitude;
            $createLaporan->latitude = $request->latitude;
            $createLaporan->status = 'pending';
            $createLaporan->id_user = auth()->user()->id;
            // if ($createLaporan->gambar != null && $request->file != '') {

            //     $replace = substr($request->tmpfile, 0, strpos($request->tmpfile, ',') + 1);

            //     // find substring fro replace here eg: data:image/png;base64,

            //     $image = str_replace($replace, '', $request->tmpfile);

            //     $image = str_replace(' ', '+', $image);
            //     \File::put(public_path('image/mitigasi/') . $request->file, base64_decode($image));
            // }

            if ($request->file && $request->tmpfile) {
                $replace = substr($request->tmpfile, 0, strpos($request->tmpfile, ',') + 1);

                // find substring fro replace here eg: data:image/png;base64,

                $image = str_replace($replace, '', $request->tmpfile);

                $image = str_replace(' ', '+', $image);
                \File::put(public_path('image/mitigasi/') . $request->file, base64_decode($image));
                $createLaporan->gambar = $request->file;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada gambar.',
                ], Response::HTTP_BAD_REQUEST);
            }

            // Mail::to($request->user())->send(new \App\Mail\LaporanNotifikasiMail($data));
            if ($createLaporan->save()) {
                $details = $createLaporan;
                $email = User::select('email')->where('role','admin')->first();
                Mail::to($email)->send(new LaporanNotifikasiMail($details));
            }
            $response = [
                'success' => true,
                'message' => 'Berhasil menyimpan data',
                // 'data' => $createLaporan,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.' . $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function laporanTahun()
    {
        try {
            $data = LaporanTahun::all();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data.',
                'data' => $data
            ],Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan'
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
