<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">New Job Application Received</h2>
        
        <p>You have received a new job application for <strong>{{ $application->job->title }}</strong>:</p>
        
        <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Applicant Name:</strong> {{ $application->name }}</p>
            <p><strong>Email:</strong> {{ $application->email }}</p>
            @if($application->phone)
                <p><strong>Phone:</strong> {{ $application->phone }}</p>
            @endif
            <p><strong>Position:</strong> {{ $application->job->title }}</p>
            <p><strong>Department:</strong> {{ $application->job->department ?? 'N/A' }}</p>
            <p><strong>Location:</strong> {{ $application->job->location ?? 'N/A' }}</p>
            
            @if($application->message)
                <p><strong>Cover Message:</strong></p>
                <p style="white-space: pre-wrap;">{{ $application->message }}</p>
            @endif
            
            @if($application->resume_path)
                <p><strong>Resume:</strong> {{ $application->resume_path }}</p>
            @endif
            
            @if($application->cover_letter_path)
                <p><strong>Cover Letter:</strong> {{ $application->cover_letter_path }}</p>
            @endif
            
            <p><strong>Applied:</strong> {{ $application->created_at->format('F j, Y g:i A') }}</p>
        </div>
        
        <p style="color: #6b7280; font-size: 14px;">This email was sent from your Kanggui RCM website.</p>
    </div>
</body>
</html>
