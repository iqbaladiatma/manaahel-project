<?php

namespace App\Filament\Resources\ProgramResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Information')
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
                                        
                                        RichEditor::make('description.id')
                                            ->label('Description (Indonesian)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                                
                                Tabs\Tab::make('English')
                                    ->schema([
                                        TextInput::make('name.en')
                                            ->label('Name (English)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        RichEditor::make('description.en')
                                            ->label('Description (English)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                                
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                        TextInput::make('name.ar')
                                            ->label('Name (Arabic)')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        RichEditor::make('description.ar')
                                            ->label('Description (Arabic)')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),
                        
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the name'),
                        
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'academy' => 'Academy',
                                'competition' => 'Competition',
                            ])
                            ->required()
                            ->native(false),
                        
                        Toggle::make('status')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Only active programs are visible to users'),
                        
                        TextInput::make('fees')
                            ->label('Fees')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                        
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }
}
