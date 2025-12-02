<?php

namespace App\Filament\Resources\CategoryResource\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                Tabs\Tab::make('Indonesian')
                                    ->schema([
                                        TextInput::make('name.id')
                                            ->label('Name (Indonesian)')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                                if (empty($get('slug'))) {
                                                    $set('slug', Str::slug($state));
                                                }
                                            }),
                                    ]),
                                
                                Tabs\Tab::make('English')
                                    ->schema([
                                        TextInput::make('name.en')
                                            ->label('Name (English)')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                        TextInput::make('name.ar')
                                            ->label('Name (Arabic)')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columnSpanFull(),
                        
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the name'),
                    ])
                    ->columns(1),
            ]);
    }
}
