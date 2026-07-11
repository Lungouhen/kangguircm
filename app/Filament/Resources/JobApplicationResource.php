<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Filament\Resources\JobApplicationResource\RelationManagers;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('job_id')
                    ->relationship('job', 'title')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('resume_path')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Path to uploaded resume file'),
                Forms\Components\TextInput::make('cover_letter_path')
                    ->maxLength(255)
                    ->helperText('Path to uploaded cover letter file'),
                Forms\Components\Textarea::make('message')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'shortlisted' => 'Shortlisted',
                        'interview' => 'Interview Scheduled',
                        'offered' => 'Offer Sent',
                        'hired' => 'Hired',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull()
                    ->helperText('Internal notes about this application'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'pending',
                        'info' => 'shortlisted',
                        'warning' => 'interview',
                        'primary' => 'offered',
                        'success' => 'hired',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'shortlisted' => 'Shortlisted',
                        'interview' => 'Interview Scheduled',
                        'offered' => 'Offer Sent',
                        'hired' => 'Hired',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('job_id')
                    ->relationship('job', 'title')
                    ->label('Job Position'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('downloadResume')
                    ->label('Download Resume')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(fn (JobApplication $record): string => asset('storage/' . $record->resume_path))
                    ->openUrlInNewTab()
                    ->requiresConfirmation(false),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
