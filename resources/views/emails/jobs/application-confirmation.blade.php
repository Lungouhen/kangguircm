<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">Thank You for Your Application!</h2>
        
        <p>Dear {{ $application->name }},</p>
        
        <p>Thank you for applying to the <strong>{{ $application->job->title }}</strong> position at Kanggui RCM. We have successfully received your application.</p>
        
        <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Position:</strong> {{ $application->job->title }}</p>
            <p><strong>Department:</strong> {{ $application->job->department ?? 'N/A' }}</p>
            <p><strong>Location:</strong> {{ $application->job->location ?? 'N/A' }}</p>
            <p><strong>Application Date:</strong> {{ $application->created_at->format('F j, Y') }}</p>
        </div>
        
        <p>Our hiring team will review your application and get back to you within 5-7 business days. If your qualifications match our requirements, we will contact you to schedule an interview.</p>
        
        <p>In the meantime, feel free to explore other opportunities on our <a href="{{ route('careers') }}" style="color: #2563eb;">careers page</a>.</p>
        
        <p>Best regards,<br>
        <strong>The Kanggui RCM Team</strong></p>
        
        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
        <p style="color: #6b7280; font-size: 14px;">This is an automated confirmation email. Please do not reply directly to this message.</p>
    </div>
</body>
</html>
