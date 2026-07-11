<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageBlockResource\Pages;
use App\Models\PageBlock;
use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageBlockResource extends Resource
{
    protected static ?string $model = PageBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Page Blocks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Block Assignment')
                    ->schema([
                        Forms\Components\Select::make('page_slug')
                            ->options([
                                'home' => 'Home Page',
                                'about' => 'About Page',
                                'services' => 'Services Page',
                                'contact' => 'Contact Page',
                                'blog' => 'Blog Page',
                                'careers' => 'Careers Page',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('block_id')
                            ->relationship('block', 'title')
                            ->required()
                            ->label('Block')
                            ->native(false),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->label('Display Order'),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_slug')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('-', ' ', $state)))
                    ->sortable(),
                Tables\Columns\TextColumn::make('block.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('block.type')
                    ->badge(),
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
                Tables\Filters\SelectFilter::make('page_slug')
                    ->options([
                        'home' => 'Home',
                        'about' => 'About',
                        'services' => 'Services',
                        'contact' => 'Contact',
                        'blog' => 'Blog',
                        'careers' => 'Careers',
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
            'index' => Pages\ListPageBlocks::route('/'),
            'create' => Pages\CreatePageBlock::route('/create'),
            'edit' => Pages\EditPageBlock::route('/{record}/edit'),
        ];
    }
}
