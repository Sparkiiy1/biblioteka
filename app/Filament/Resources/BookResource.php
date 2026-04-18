<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationLabel = 'Books';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            TextInput::make('author')->required(),
            TextInput::make('isbn')->required(),
            TextInput::make('published_year')->numeric(),
            TextInput::make('copies_total')->numeric()->default(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('author')->searchable(),
            TextColumn::make('isbn'),
            TextColumn::make('copies_available'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
        ];
    }
}