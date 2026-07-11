<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">New Contact Form Submission</h2>
        
        <p>You have received a new contact form submission from your website:</p>
        
        <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            @if($contact->phone)
                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            @endif
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
            <p><strong>Message:</strong></p>
            <p style="white-space: pre-wrap;">{{ $contact->message }}</p>
            <p><strong>IP Address:</strong> {{ $contact->ip_address }}</p>
            <p><strong>Submitted:</strong> {{ $contact->created_at->format('F j, Y g:i A') }}</p>
        </div>
        
        <p style="color: #6b7280; font-size: 14px;">This email was sent from your Kanggui RCM website.</p>
    </div>
</body>
</html>
