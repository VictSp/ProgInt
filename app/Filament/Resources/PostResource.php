<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Сообщения';
    protected static ?string $pluralLabel = 'Сообщения';
    protected static ?string $modelLabel = 'Сообщение';
    protected static ?string $navigationGroup = 'Форум';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('topic_id')
                    ->label('Тема')
                    ->relationship('topic', 'title')
                    ->required(),

                Forms\Components\Textarea::make('content')
                    ->label('Текст сообщения')
                    ->rows(5)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('topic.title')
                    ->label('Тема')
                    ->limit(40)
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Автор')
                    ->sortable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Сообщение')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    

    public static function canViewAny(): bool
    {
        return auth()->user()?->is_admin === 1;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->is_admin === 1;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->is_admin === 1;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->is_admin === 1;
    }
}
