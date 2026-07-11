<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Service;
use App\Models\Post;
use App\Models\JobListing;
use App\Models\Contact;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Services', Service::count())
                ->description('Active services offered')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),
            
            Stat::make('Blog Posts', Post::count())
                ->description('Published articles')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
            
            Stat::make('Job Openings', JobListing::where('status', 'active')->count())
                ->description('Current openings')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning'),
            
            Stat::make('Contact Messages', Contact::where('status', 'new')->count())
                ->description('Unread messages')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
