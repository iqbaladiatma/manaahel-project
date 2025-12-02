<?php

namespace App\Filament\Resources\ProgramResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['en'] ?? $state['id'] ?? '') : $state)
                    ->limit(50),
                
                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'academy',
                        'success' => 'competition',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),
                
                BadgeColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                TextColumn::make('fees')
                    ->label('Fees')
                    ->money('IDR')
                    ->sortable(),
                
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'academy' => 'Academy',
                        'competition' => 'Competition',
                    ]),
                
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
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
