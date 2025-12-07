<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class GalleriesRelationManager extends RelationManager
{
    protected static string $relationship = 'galleries';

    protected static ?string $title = 'Galleries';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('title.id')
                    ->label('Title (Indonesian)')
                    ->required(),
                
                Forms\Components\Textarea::make('description')
                    ->rows(3),
                
                Forms\Components\TextInput::make('file_path')
                    ->label('Image URL')
                    ->placeholder('https://example.com/image.jpg or gallery/filename.jpg')
                    ->helperText('Enter image URL (e.g., https://picsum.photos/800/600) or local path (e.g., gallery/image.jpg)')
                    ->required(),
                
                Forms\Components\Select::make('visibility')
                    ->options([
                        'public' => 'Public',
                        'member_only' => 'Member Only',
                    ])
                    ->default('public')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Image')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->formatStateUsing(fn ($record) => $record->getTranslatedTitle())
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('visibility')
                    ->colors([
                        'success' => 'public',
                        'warning' => 'member_only',
                    ]),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
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
            ->defaultSort('created_at', 'desc');
    }
}
