<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration Details')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        
                        Select::make('program_id')
                            ->label('Program')
                            ->relationship('program', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn ($record) => is_array($record->name) ? ($record->name['en'] ?? $record->name['id'] ?? '') : $record->name),
                        
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending'),
                        
                        FileUpload::make('payment_proof')
                            ->label('Payment Proof')
                            ->disk('private')
                            ->directory('payment-proofs')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
