<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Показывает страницу с формой (пункты 2 и 5 задания)
    public function show()
    {
        return view('contact', ['platformName' => 'GameHub']);
    }

    // Принимает форму: валидация, письмо, редирект (пункт 12 и доп. задание)
    public function send(ContactRequest $request)
    {
        $data = $request->validated();

        Mail::to(config('mail.from.address'))->send(new ContactMessage($data));

        return redirect()->route('contact.thanks')
            ->with('sender_name', $data['name']);
    }

    // Показывает страницу подтверждения
    public function thanks()
    {
        return view('contact-thanks');
    }
}
