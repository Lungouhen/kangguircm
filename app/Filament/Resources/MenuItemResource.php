<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Menu Items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menu Item Details')
                    ->schema([
                        Forms\Components\Select::make('menu_id')
                            ->relationship('menu', 'name')
                            ->required()
                            ->label('Parent Menu'),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make('url')
                            ->label('URL (leave empty for route)')
                            ->maxLength(255),
                        Forms\Components\Select::make('route_name')
                            ->label('Route Name (if no URL)')
                            ->options([
                                'home' => 'Home',
                                'services' => 'Services',
                                'about' => 'About',
                                'contact' => 'Contact',
                                'blog' => 'Blog',
                                'careers' => 'Careers',
                            ])
                            ->native(false),
                        Forms\Components\TextInput::make('route_params')
                            ->label('Route Parameters (JSON)')
                            ->placeholder('{"id": 1}'),
                        Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'title')
                            ->label('Parent Item (for dropdowns)')
                            ->native(false),
                        Forms\Components\Toggle::make('is_mega_menu')
                            ->label('Enable Mega Menu')
                            ->helperText('Show multi-column content on hover'),
                        Forms\Components\RichEditor::make('mega_menu_content')
                            ->columnSpanFull()
                            ->label('Mega Menu Content')
                            ->visible(fn ($get) => $get('is_mega_menu') === true)
                            ->helperText('Add headings, links, and descriptions for mega menu panel'),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Class (e.g., heroicon-o-home)'),
                        Forms\Components\Toggle::make('open_in_new_tab')
                            ->label('Open in new tab'),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('menu.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Parent')
                    ->badge()
                    ->color('gray'),
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
                Tables\Filters\SelectFilter::make('menu')
                    ->relationship('menu', 'name'),
                Tables\Filters\SelectFilter::make('parent')
                    ->relationship('parent', 'title'),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
