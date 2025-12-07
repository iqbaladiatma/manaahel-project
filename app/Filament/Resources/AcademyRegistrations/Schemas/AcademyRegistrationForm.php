<?php

namespace App\Filament\Resources\AcademyRegistrations\Schemas;

use Filament\Schemas\Schema;

class AcademyRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Forms\Components\Select::make('academy_program_id')
                    ->label('Program')
                    ->relationship('academyProgram', 'name')
                    ->required()
                    ->searchable(),

                \Filament\Forms\Components\Select::make('user_id')
                    ->label('User (Optional)')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->helperText('Leave empty for guest registration'),

                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                \Filament\Forms\Components\Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull(),

                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->default('pending'),

                \Filament\Forms\Components\TextInput::make('whatsapp_group_link')
                    ->label('WhatsApp Group Link')
                    ->url()
                    ->columnSpanFull(),
            ]);
    }
}
