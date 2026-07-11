<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Message Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">Thank You for Contacting Us!</h2>
        
        <p>Dear {{ $contact->name }},</p>
        
        <p>Thank you for reaching out to Kanggui RCM. We have successfully received your message and our team will review it shortly.</p>
        
        <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
            <p><strong>Your Message:</strong></p>
            <p style="white-space: pre-wrap;">{{ $contact->message }}</p>
            <p><strong>Received:</strong> {{ $contact->created_at->format('F j, Y g:i A') }}</p>
        </div>
        
        <p>We typically respond within 1-2 business days. If your matter is urgent, please don't hesitate to call us directly at <strong>+1 (555) 123-4567</strong>.</p>
        
        <p>Best regards,<br>
        <strong>The Kanggui RCM Team</strong><br>
        info@kangguircm.com</p>
        
        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
        <p style="color: #6b7280; font-size: 14px;">This is an automated confirmation email. Please do not reply directly to this message.</p>
    </div>
</body>
</html>
