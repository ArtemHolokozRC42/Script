<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Показує сторінку з формою зворотного зв'язку
    public function showContactForm()
    {
        return view('contact', [
            'platformName' => 'GameHub',
            'topics'       => ContactRequest::TOPICS,
        ]);
    }

    // Приймає форму: валідація (ContactRequest), лист, редирект
    public function submitContactForm(ContactRequest $request)
    {
        $data = $request->validated();

        Mail::to(config('mail.from.address'))->send(new ContactMessage($data));

        return redirect()->route('contact.thanks')
            ->with('sender_name', $data['name']);
    }

    // Показує сторінку підтвердження після успішної відправки
    public function showContactThanks()
    {
        return view('contact-thanks');
    }
}
