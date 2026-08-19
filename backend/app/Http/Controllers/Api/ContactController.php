<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = Contact::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'subject' => $request->validated('subject'),
            'message' => $request->validated('message'),
            'ip_address' => $request->ip(),
        ]);

        // Automatically forward to recipient Gmail
        try {
            $toEmail = config('mail.from.address', 'khounvyvy@gmail.com');
            $subject = 'Portfolio Inquiry: ' . ($contact->subject ?: 'New Message from ' . $contact->name);
            $body = "New message received from your Portfolio website:\n\n"
                  . "Name: {$contact->name}\n"
                  . "Email: {$contact->email}\n"
                  . "Subject: {$contact->subject}\n\n"
                  . "Message:\n{$contact->message}\n\n"
                  . "---\nSent from Portfolio Contact Engine";

            Mail::raw($body, function ($msg) use ($contact, $subject) {
                $msg->to('khounvyvy@gmail.com')
                    ->subject($subject)
                    ->replyTo($contact->email, $contact->name);
            });
        } catch (\Throwable $e) {
            Log::warning('Contact email notification error: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you! Your message has been sent directly to Khonn Vy.',
            'data' => $contact
        ], 201);
    }
}
