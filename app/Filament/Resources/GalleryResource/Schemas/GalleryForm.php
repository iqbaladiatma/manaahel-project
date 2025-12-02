<?php

namespace App\Filament\Resources\GalleryResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Item')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        
                        FileUpload::make('file_path')
                            ->label('Image/Video')
                            ->disk('public')
                            ->directory('gallery')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->required()
                            ->helperText('Upload an image or video file'),
                        
                        Select::make('visibility')
                            ->label('Visibility')
                            ->options([
                                'public' => 'Public',
                                'member_only' => 'Member Only',
                            ])
                            ->required()
                            ->default('public')
                            ->native(false)
                            ->helperText('Public items are visible to everyone, member-only items require authentication'),
                        
                        TextInput::make('batch_filter')
                            ->label('Batch Filter')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->helperText('Optional: Restrict visibility to specific batch year (leave empty for all members)')
                            ->placeholder('e.g., 2023'),
                    ])
                    ->columns(2),
            ]);
    }
}
