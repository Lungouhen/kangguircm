<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    /**
     * Display a listing of job opportunities.
     */
    public function index()
    {
        $jobs = JobListing::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('careers.index', compact('jobs'));
    }

    /**
     * Display the specified job listing.
     */
    public function show(string $slug)
    {
        $job = JobListing::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedJobs = JobListing::where('is_active', true)
            ->where('id', '!=', $job->id)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->when($job->department, function ($query) use ($job) {
                return $query->where('department', $job->department);
            })
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('careers.show', compact('job', 'relatedJobs'));
    }

    /**
     * Handle job application submission.
     */
    public function apply(Request $request, string $slug)
    {
        $job = JobListing::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'], // 5MB max
            'cover_letter' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        // Store resume
        $resumePath = $request->file('resume')->store('resumes', 'public');
        $validated['resume_path'] = $resumePath;

        // Store cover letter if provided
        if ($request->hasFile('cover_letter')) {
            $coverLetterPath = $request->file('cover_letter')->store('cover_letters', 'public');
            $validated['cover_letter_path'] = $coverLetterPath;
        }

        $validated['job_id'] = $job->id;
        $validated['status'] = 'pending';

        $application = JobApplication::create($validated);

        // Send notification email to admin/HR
        Mail::to(config('mail.from.address', 'hr@kangganui-rcm.com'))
            ->send(new JobApplicationReceived($application));

        // Send confirmation email to applicant
        Mail::to($application->email)->send(new JobApplicationConfirmation($application));

        Log::info('New job application received', [
            'job_id' => $job->id,
            'job_title' => $job->title,
            'applicant_name' => $validated['name'],
            'applicant_email' => $validated['email'],
        ]);

        return back()->with('success', 'Thank you for your application! We will review it and get back to you soon.');
    }
}
