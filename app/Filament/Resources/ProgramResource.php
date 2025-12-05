<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';
    protected static string|\UnitEnum|null $navigationGroup = 'Learning Management';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Grid::make(2)->schema([

                /* -------------------------------------------------------
                 | LEFT COLUMN (2 columns)
                 ------------------------------------------------------- */
                Grid::make(1)
                    ->columnSpan(2)
                    ->schema([

                        Section::make('Program Information')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->label('Name (English)')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('name.id')
                                    ->label('Name (Indonesian)')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('name.ar')
                                    ->label('Name (Arabic)')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from English name'),
                            ])
                            ->columns(2),

                        Section::make('Description')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\Textarea::make('description.en')
                                    ->label('Description (English)')
                                    ->required()
                                    ->rows(3),

                                Forms\Components\Textarea::make('description.id')
                                    ->label('Description (Indonesian)')
                                    ->required()
                                    ->rows(3),

                                Forms\Components\Textarea::make('description.ar')
                                    ->label('Description (Arabic)')
                                    ->rows(3),
                            ]),

                        Section::make('Syllabus')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\RichEditor::make('syllabus.en')
                                    ->label('Syllabus (English)')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'bulletList', 'orderedList'
                                    ]),

                                Forms\Components\RichEditor::make('syllabus.id')
                                    ->label('Syllabus (Indonesian)')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'bulletList', 'orderedList'
                                    ]),

                                Forms\Components\RichEditor::make('syllabus.ar')
                                    ->label('Syllabus (Arabic)')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold', 'italic', 'bulletList', 'orderedList'
                                    ]),
                            ])
                            ->collapsible(),
                    ]),

                /* -------------------------------------------------------
                 | RIGHT COLUMN (1 column)
                 ------------------------------------------------------- */
                Grid::make(1)
                    ->columnSpan(1)
                    ->schema([
                        Section::make('Settings')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'academy' => 'Academy',
                                        'competition' => 'Competition',
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('delivery_type')
                                    ->label('Delivery Method')
                                    ->options([
                                        'online_course' => '📚 Online Course (Self-paced)',
                                        'online_zoom'   => '🎥 Live Sessions (Zoom/GMeet)',
                                    ])
                                    ->default('online_course')
                                    ->required()
                                    ->reactive()
                                    ->helperText('How the program will be delivered'),

                                Forms\Components\TextInput::make('meeting_link')
                                    ->label('Meeting Link')
                                    ->url()
                                    ->placeholder('https://zoom.us/j/...')
                                    ->helperText('Default Zoom/GMeet link for this program')
                                    ->visible(fn ($get) => $get('delivery_type') === 'online_zoom'),

                                Forms\Components\DatePicker::make('start_date')
                                    ->label('Start Date')
                                    ->required(),

                                Forms\Components\DatePicker::make('end_date')
                                    ->label('End Date')
                                    ->required(),

                                Forms\Components\TextInput::make('fees')
                                    ->label('Program Fees')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),

                                Forms\Components\Toggle::make('status')
                                    ->label('Active')
                                    ->default(true)
                                    ->helperText('Make program visible'),
                            ]),
                    ]),

            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'academy',
                        'success' => 'competition',
                    ]),

                Tables\Columns\BadgeColumn::make('delivery_type')
                    ->label('Delivery')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'online_course' => '📚 Online',
                        'online_zoom'   => '🎥 Live',
                        default          => $state,
                    })
                    ->colors([
                        'primary' => 'online_course',
                        'success' => 'online_zoom',
                    ]),

                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fees')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'academy' => 'Academy',
                        'competition' => 'Competition',
                    ]),

                Tables\Filters\TernaryFilter::make('status')
                    ->label('Active'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
