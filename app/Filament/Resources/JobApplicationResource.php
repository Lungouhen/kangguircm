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

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Careers';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Candidate Information')
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
                    ])->columns(2),
                
                Forms\Components\Section::make('Application Details')
                    ->schema([
                        Forms\Components\FileUpload::make('resume_path')
                            ->label('Resume')
                            ->directory('resumes')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(2048)
                            ->required()
                            ->helperText('PDF or DOCX, max 2MB'),
                        Forms\Components\FileUpload::make('cover_letter_path')
                            ->label('Cover Letter')
                            ->directory('resumes')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(2048)
                            ->helperText('PDF or DOCX, max 2MB'),
                        Forms\Components\Textarea::make('message')
                            ->columnSpanFull()
                            ->rows(4),
                    ])->columns(1),
                
                Forms\Components\Section::make('AI Analysis (Auto-Parsed)')
                    ->schema([
                        Forms\Components\TagsInput::make('parsed_skills')
                            ->label('Detected Skills')
                            ->disabled()
                            ->helperText('Automatically extracted from resume'),
                        Forms\Components\Textarea::make('parsed_experience')
                            ->label('Experience Summary')
                            ->disabled()
                            ->rows(3),
                        Forms\Components\TextInput::make('match_score')
                            ->label('Job Match Score')
                            ->disabled()
                            ->suffix('%')
                            ->helperText('AI-calculated match percentage'),
                        Forms\Components\Toggle::make('is_auto_rejected')
                            ->label('Auto-Rejected')
                            ->disabled()
                            ->helperText('True if score is below threshold'),
                    ])->columns(2)->visible(fn ($record) => $record && $record->parsed_skills),
                
                Forms\Components\Section::make('Review & Status')
                    ->schema([
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
                            ->required()
                            ->live(),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull()
                            ->rows(3)
                            ->helperText('Internal notes about this application'),
                    ])->columns(1),
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
                Tables\Columns\IconColumn::make('is_auto_rejected')
                    ->label('Auto-Reject')
                    ->boolean()
                    ->colors([
                        'danger' => true,
                    ])
                    ->tooltip('Auto-rejected by AI'),
                Tables\Columns\TextColumn::make('match_score')
                    ->label('Match %')
                    ->numeric(2)
                    ->suffix('%')
                    ->color(fn (string $state): string => match (true) {
                        $state >= 80 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),
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
