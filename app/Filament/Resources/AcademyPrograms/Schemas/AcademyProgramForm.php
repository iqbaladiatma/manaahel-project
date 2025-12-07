<?php

namespace App\Filament\Resources\AcademyPrograms\Schemas;

use Filament\Schemas\Schema;

class AcademyProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Schemas\Components\Section::make('Informasi Program')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama Program')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        \Filament\Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->dehydrated(),

                        \Filament\Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                \Filament\Schemas\Components\Section::make('Detail Program')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('details')
                            ->label('Detail')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                \Filament\Schemas\Components\Section::make('Pengaturan')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('whatsapp_group_link')
                            ->label('Link Grup WhatsApp')
                            ->url()
                            ->placeholder('https://chat.whatsapp.com/...')
                            ->helperText('Link grup WhatsApp untuk peserta yang mendaftar'),

                        \Filament\Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        \Filament\Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai'),

                        \Filament\Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai'),

                        \Filament\Forms\Components\TextInput::make('max_participants')
                            ->label('Kuota Maksimal')
                            ->numeric()
                            ->helperText('Kosongkan untuk unlimited'),

                        \Filament\Forms\Components\FileUpload::make('image')
                            ->label('Gambar Program')
                            ->image()
                            ->directory('academy-programs'),

                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
