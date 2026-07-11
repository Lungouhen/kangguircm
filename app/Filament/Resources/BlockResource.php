<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlockResource\Pages;
use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlockResource extends Resource
{
    protected static ?string $model = Block::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Block Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Forms\Components\Select::make('type')
                            ->options([
                                'hero' => 'Hero Section',
                                'features' => 'Features Grid',
                                'services' => 'Services List',
                                'cta' => 'Call to Action',
                                'testimonials' => 'Testimonials',
                                'faq' => 'FAQ Section',
                                'stats' => 'Statistics Counter',
                                'team' => 'Team Members',
                            ])
                            ->required()
                            ->native(false)
                            ->reactive(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->columnSpanFull()
                            ->label('Main Content (HTML/Text)'),
                        Forms\Components\Textarea::make('json_data')
                            ->rows(8)
                            ->columnSpanFull()
                            ->label('JSON Data (for structured content)')
                            ->helperText('Use JSON format for complex data like testimonials, team members, etc.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'hero',
                        'success' => 'features',
                        'warning' => 'cta',
                        'info' => 'testimonials',
                        'danger' => 'faq',
                    ]),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'hero' => 'Hero',
                        'features' => 'Features',
                        'services' => 'Services',
                        'cta' => 'CTA',
                        'testimonials' => 'Testimonials',
                        'faq' => 'FAQ',
                        'stats' => 'Stats',
                        'team' => 'Team',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
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
            'index' => Pages\ListBlocks::route('/'),
            'create' => Pages\CreateBlock::route('/create'),
            'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }
}
