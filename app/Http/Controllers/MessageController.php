<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
}
