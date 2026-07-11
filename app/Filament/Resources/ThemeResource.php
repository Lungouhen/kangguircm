<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeResource\Pages;
use App\Models\Theme;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->label('Theme Name'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Theme')
                            ->helperText('Only one theme can be active at a time.'),
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Colors')
                    ->description('Define your brand colors')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->label('Primary Color'),
                        Forms\Components\ColorPicker::make('secondary_color')
                            ->label('Secondary Color'),
                        Forms\Components\ColorPicker::make('accent_color')
                            ->label('Accent Color'),
                        Forms\Components\ColorPicker::make('text_color')
                            ->label('Text Color'),
                        Forms\Components\ColorPicker::make('background_color')
                            ->label('Background Color'),
                    ])->columns(3),

                Forms\Components\Section::make('Typography')
                    ->schema([
                        Forms\Components\Select::make('heading_font')
                            ->options([
                                'Instrument Sans' => 'Instrument Sans',
                                'Instrument Serif' => 'Instrument Serif',
                                'Inter' => 'Inter',
                                'Poppins' => 'Poppins',
                                'Roboto' => 'Roboto',
                            ])
                            ->default('Instrument Sans'),
                        Forms\Components\Select::make('body_font')
                            ->options([
                                'Instrument Sans' => 'Instrument Sans',
                                'Inter' => 'Inter',
                                'Roboto' => 'Roboto',
                                'Open Sans' => 'Open Sans',
                            ])
                            ->default('Instrument Sans'),
                    ])->columns(2),

                Forms\Components\Section::make('Layout & Assets')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('logos')
                            ->maxSize(1024),
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('favicons')
                            ->maxSize(512),
                        Forms\Components\Textarea::make('custom_css')
                            ->rows(6)
                            ->columnSpanFull()
                            ->label('Custom CSS'),
                        Forms\Components\Textarea::make('custom_js')
                            ->rows(6)
                            ->columnSpanFull()
                            ->label('Custom JS (Footer)'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('primary_color')
                    ->color(fn (string $state): string => $state)
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListThemes::route('/'),
            'create' => Pages\CreateTheme::route('/create'),
            'edit' => Pages\EditTheme::route('/{record}/edit'),
        ];
    }
}
