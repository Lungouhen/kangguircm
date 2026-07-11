<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::all());
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        // Process uploaded files and update paths
        if (isset($data['website']['logo']) && is_array($data['website']['logo'])) {
            $data['website']['logo'] = $data['website']['logo'][0] ?? null;
        }
        if (isset($data['website']['favicon']) && is_array($data['website']['favicon'])) {
            $data['website']['favicon'] = $data['website']['favicon'][0] ?? null;
        }
        if (isset($data['seo']['og_image']) && is_array($data['seo']['og_image'])) {
            $data['seo']['og_image'] = $data['seo']['og_image'][0] ?? null;
        }

        Setting::set('website', $data['website']);
        Setting::set('contact', $data['contact']);
        Setting::set('business', $data['business']);
        Setting::set('seo', $data['seo']);
        Setting::set('features', $data['features']);

        Setting::clearCache();

        notification()->success('Settings saved successfully!');
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Website Settings')
                ->schema([
                    TextInput::make('website.name')
                        ->label('Site Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('website.tagline')
                        ->label('Tagline')
                        ->maxLength(255),
                    TextInput::make('website.description')
                        ->label('Description')
                        ->maxLength(500),
                    FileUpload::make('website.logo')
                        ->label('Logo')
                        ->image()
                        ->directory('logos')
                        ->maxSize(2048),
                    FileUpload::make('website.favicon')
                        ->label('Favicon')
                        ->image()
                        ->directory('favicons')
                        ->maxSize(512),
                    Select::make('website.timezone')
                        ->label('Timezone')
                        ->options(timezone_identifiers_list()),
                    Select::make('website.locale')
                        ->label('Language')
                        ->options([
                            'en' => 'English',
                            'zh' => 'Chinese',
                            'es' => 'Spanish',
                            'fr' => 'French',
                        ]),
                ])->columns(2),

            Section::make('Contact Information')
                ->schema([
                    TextInput::make('contact.email')
                        ->label('Email')
                        ->email()
                        ->required(),
                    TextInput::make('contact.phone')
                        ->label('Phone'),
                    TextInput::make('contact.address')
                        ->label('Address')
                        ->columnSpanFull(),
                    Repeater::make('contact.social_media')
                        ->schema([
                            TextInput::make('linkedin')->label('LinkedIn URL'),
                            TextInput::make('twitter')->label('Twitter URL'),
                            TextInput::make('facebook')->label('Facebook URL'),
                            TextInput::make('instagram')->label('Instagram URL'),
                        ])->columns(2)->columnSpanFull(),
                ])->columns(2),

            Section::make('Business Hours')
                ->schema([
                    Repeater::make('business.hours')
                        ->schema([
                            Toggle::make('enabled')->label('Open'),
                            TextInput::make('open')->label('Open Time'),
                            TextInput::make('close')->label('Close Time'),
                        ])
                        ->reorderable(false)
                        ->collapsible()
                        ->items([
                            'monday' => ['label' => 'Monday'],
                            'tuesday' => ['label' => 'Tuesday'],
                            'wednesday' => ['label' => 'Wednesday'],
                            'thursday' => ['label' => 'Thursday'],
                            'friday' => ['label' => 'Friday'],
                            'saturday' => ['label' => 'Saturday'],
                            'sunday' => ['label' => 'Sunday'],
                        ]),
                    Toggle::make('business.holiday_mode')
                        ->label('Holiday Mode'),
                    TextInput::make('business.holiday_message')
                        ->label('Holiday Message')
                        ->columnSpanFull(),
                ])->columns(1),

            Section::make('SEO Settings')
                ->schema([
                    TextInput::make('seo.meta_title')
                        ->label('Meta Title')
                        ->maxLength(60),
                    TextInput::make('seo.meta_description')
                        ->label('Meta Description')
                        ->maxLength(160),
                    TextInput::make('seo.meta_keywords')
                        ->label('Meta Keywords'),
                    FileUpload::make('seo.og_image')
                        ->label('Open Graph Image')
                        ->image()
                        ->directory('og-images'),
                    TextInput::make('seo.google_analytics_id')
                        ->label('Google Analytics ID')
                        ->placeholder('UA-XXXXXXXXX-X'),
                    TextInput::make('seo.google_tag_manager_id')
                        ->label('Google Tag Manager ID')
                        ->placeholder('GTM-XXXXXXX'),
                ])->columns(2),

            Section::make('Feature Toggles')
                ->schema([
                    Toggle::make('features.enable_blog')
                        ->label('Enable Blog'),
                    Toggle::make('features.enable_careers')
                        ->label('Enable Careers'),
                    Toggle::make('features.enable_contact_form')
                        ->label('Enable Contact Form'),
                    Toggle::make('features.enable_newsletter')
                        ->label('Enable Newsletter'),
                    Toggle::make('features.maintenance_mode')
                        ->label('Maintenance Mode'),
                    TextInput::make('features.maintenance_message')
                        ->label('Maintenance Message')
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }
}
