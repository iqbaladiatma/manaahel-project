<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementsRelationManager extends RelationManager
{
    protected static string $relationship = 'achievements';

    protected static ?string $title = 'Achievements';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('title.id')
                    ->label('Title (Indonesian)')
                    ->required(),
                
                Forms\Components\TextInput::make('title.en')
                    ->label('Title (English)'),
                
                Forms\Components\Textarea::make('description.id')
                    ->label('Description (Indonesian)')
                    ->rows(3),
                
                Forms\Components\TextInput::make('icon')
                    ->label('Icon (Emoji)')
                    ->placeholder('🏆'),
                
                Forms\Components\DatePicker::make('achieved_at')
                    ->label('Achievement Date')
                    ->default(now()),
                
                Forms\Components\FileUpload::make('certificate_url')
                    ->label('Certificate')
                    ->image()
                    ->directory('certificates'),
                
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('title')
                    ->formatStateUsing(fn ($record) => $record->getTranslation('title', app()->getLocale()))
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('achieved_at')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\ImageColumn::make('certificate_url')
                    ->label('Certificate')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }
}
