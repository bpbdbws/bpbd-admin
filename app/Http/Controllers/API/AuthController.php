<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password','no_hp');

        $fields = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'max:13'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        //Send failed response if request is not valid
        if ($fields->fails()) {
            return response()->json($fields->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $status = 'user';
            $user = User::create([
                'name' => $request->name,
                'no_telp' => $request->no_hp,
                'email' => $request->email,
                'role' => $status,
                'is_google' => $request->is_google,
                'password' => Hash::make($request->password),
            ]);
            $response = [
                'success' => true,
                'data' => $user,
                'message' => 'BerhasiL mendaftar.',
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e;
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi atau sintax.'.$e->getMessage(),
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
    public function login(Request $request)
    {

        $data = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json($data->errors(), HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            // check email and password
            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_telp';
            if (!Auth::attempt(
                array(
                    $fieldType => $request->email,
                    'password' => $request->password
                )
            )) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak ditemukan.'
                ], HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
            // update is login
            $user = User::where($fieldType, $request->email)->first();
            $user->is_login = 1;
            $user->update();
            $token = $user->createToken('token')->plainTextToken;

            $response = [
                'success' => true,
                'token' => $token,
                'data' => $user
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi atau sintax.'
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }

    function logout(Request $request)
    {

        try {
            $status = 'user';
            $is_login = $request->is_login;
            $dataUser = User::where('id', auth()->user()->id)->first();
            $dataUser->is_login = 0;

            if ($dataUser->update() && $dataUser->role == $status) {
                auth()->user()->tokens()->delete();
            }
            return response()->json('Berhasil Keluar', 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi atau sintax.'
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
    public function getprofile($id)
    {
        try {
            $data = User::find($id);
            $response = [
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $data
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi atau sintax.'
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
    public function updateprofile(Request $request, $id)
    {
        $data = $request->only('name', 'email', 'no_telp', 'gender');
        $fields = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required'],
            'gender' => ['required', 'not_in:0'],
        ]);
        try {
            $updateUser = User::find($id);
            $updateUser->name = $request->name;
            $updateUser->email = $request->email;
            $updateUser->gender = $request->gender;
            $updateUser->no_telp = $request->no_telp;
            // if ($updateUser->photo != null && $request->file != '') {

                $replace = substr($request->tmpfile, 0, strpos($request->tmpfile, ',') + 1);

                // find substring fro replace here eg: data:image/png;base64,

                $image = str_replace($replace, '', $request->tmpfile);

                $image = str_replace(' ', '+', $image);
                \File::put(public_path('image/profil/') . $request->file, base64_decode($image));
            // } else {
            //     return response()->json('Tidak ada gambar',500);
            // }
            $updateUser->photo = $request->file;
            $updateUser->update();
            if ($updateUser != null) {
                $response = [
                    'success' => true,
                    'message' => 'Data berhasil di update.',
                    'data' => $updateUser,
                ];
                return response()->json($response, HttpFoundationResponse::HTTP_OK);

            }else{
                $response = [
                    'success' => false,
                    'message' => 'Data tidak berhasil di update.',
                    'data' => $updateUser,
                ];
                return response()->json($response,404);
            }
        } catch (QueryException $e){
            return $e;
        } catch (Exception $e) {
            return $e;
            return response()->json($e, HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }

    public function visitor($id_user)
    {
        try {
            if($id_user == 0)
                $id_user = null;

            Visitor::insert([
                'visitor' => $id_user,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $response = [
                'success' => true,
                'message' => 'Data berhasil di simpan.',
            ];

            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan : '.$e->getMessage(),
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan : '.$e->getMessage(),
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
}
