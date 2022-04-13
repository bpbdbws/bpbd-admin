<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    private $param;
    public function index()
    {
        try {   
            $param['listFeedback'] = \DB::table('feedback')
                                      ->select('feedback.id', 'users.name', 'feedback.pesan', 'feedback.status')
                                      ->join('users', 'feedback.user_id', 'users.id')
                                      ->get();
            return view('admin.feedback.list', $param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'message' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
            ],
            [
                'message' => 'Pesan',
            ],
        );

        try {
            $feedback = new Feedback();

            $feedback->user_id = \Auth::user()->id;
            $feedback->pesan = $request->message;
            $feedback->status = $request->status;
            $feedback->save();

            return redirect('/back-feedback')->withStatus('Berhasil menambah data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, Feedback $feedback)
    {
        try {
            $feedback = Feedback::find($feedback->id);
            $feedback->status = 'dilihat';
            $feedback->save();

            return redirect('/back-feedback')->withStatus('Berhasil memperbarui data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function destroy(Feedback $feedback)
    {
        try {
            Feedback::find($feedback->id)->delete();
            return redirect('/back-feedback')->withStatus('Berhasil menghapus data');
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
