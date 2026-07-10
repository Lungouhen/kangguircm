<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactFormSubmitted;
use App\Mail\ContactConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'new';

        $contact = Contact::create($validated);

        // Send notification email to admin
        Mail::to(config('mail.from.address', 'admin@kangganui-rcm.com'))
            ->send(new ContactFormSubmitted($contact));

        // Send confirmation email to user
        Mail::to($contact->email)->send(new ContactConfirmation($contact));

        Log::info('New contact form submission', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
        ]);

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
