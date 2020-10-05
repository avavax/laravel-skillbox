<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create()
    {
        return view('contacts.index');
    }

    public function store(Request $request)
    {
        $message = $this->validate(request(), [
            'email' => 'required|email',
            'content' => 'required',
        ]);

        Message::create($message);

        return redirect()->route('contacts')->with('message', 'Сообщение успешно отправлено');
    }

    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.feedback', compact('messages'));
    }

}
