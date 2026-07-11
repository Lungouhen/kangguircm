<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Post;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        $latestPosts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('home.index', compact('services', 'latestPosts'));
    }
}
