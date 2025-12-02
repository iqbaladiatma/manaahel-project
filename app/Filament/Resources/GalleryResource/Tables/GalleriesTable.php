<?php

namespace App\Filament\Resources\GalleryResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->height(50)
                    ->width(50),
                
                BadgeColumn::make('visibility')
                    ->label('Visibility')
                    ->colors([
                        'success' => 'public',
                        'warning' => 'member_only',
                    ])
                    ->formatStateUsing(fn ($state) => $state === 'public' ? 'Public' : 'Member Only')
                    ->sortable(),
                
                TextColumn::make('batch_filter')
                    ->label('Batch Filter')
                    ->sortable()
                    ->placeholder('All Members')
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('visibility')
                    ->label('Visibility')
                    ->options([
                        'public' => 'Public',
                        'member_only' => 'Member Only',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
