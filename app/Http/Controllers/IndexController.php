<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Bid;
use App\Http\Requests\FormCallbackRequest;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index()
    {
        return view('form_callback')->with('result', ['success', 'error']);
    }

    public function send(FormCallbackRequest $data)
    {
        $files = '';
        $bid = new Bid;

        if ($data->input('files')) {
            foreach ($data->input('files') as $f) {
//                    copy()
//                    $data->file('files')->move(storage_path('files/'.$data->input('email')), $f->getClientOriginalName());
                    if ($files != '') {
                        $files = $files.','.$f;
                    } else {
                        $files = $f;
                    }
            }
        } else {
            return response()->json(['errors' => 'Пожалуйста, загрузите файлы'], 422);
        }
        $bid->fill([
            'email' => $data->input('email'),
            'name' => $data->input('name'),
            'question' => $data->input('question'),
            'files' => $files
        ]);
        $GLOBALS['sender'] = $data->input('admin_email');
       $bid->save();
        Mail::send('emails_new_bid', $_POST, function ($message) {
            $message->from('anastasiya.bibik@list.ru');
            $message->subject('Новая заявка');
            $message->to($GLOBALS['sender']);
        });
       return response()->json(['success' => $GLOBALS['sender']], 200);
    }

    public function show_bids()
    {
        $bids = Bid::all();
        return view('bids_list')->with('bids', $bids);
    }

    public function processing_bids(Request $request)
    {
        if ($request->input('id') != ''){
            $id = $request->input('id');
            $bid = Bid::find($id)->first()->delete();
            return response()->json(['success' => 'Запись удалена'], 200);
        } else if ($request->input('email') != '') {
            $GLOBALS['mailUsers'] = ['recipient' => $request->input('email')];
            Mail::send('emails.answer', $GLOBALS['mailUsers'], function ($message) {
                $message->from('anastasiya.bibik@list.ru');
                $message->subject('Ответ на вашу заявку');
                $message->to( $GLOBALS['mailUsers']['recipient']);
            });
        }
    }
}
