<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopicResource\Pages;
use App\Filament\Resources\TopicResource\RelationManagers;
use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Темы';
    protected static ?string $pluralLabel = 'Темы';
    protected static ?string $modelLabel = 'Тема';
    protected static ?string $navigationGroup = 'Форум';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Категория')
                    ->relationship('category', 'title')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('content')
                    ->label('Текст темы')
                    ->rows(6)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категория')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Автор')
                    ->sortable(),

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
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
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
