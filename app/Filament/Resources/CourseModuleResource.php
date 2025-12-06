<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseModuleResource\Pages;
use App\Models\CourseModule;
use App\Models\Course;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class CourseModuleResource extends Resource
{
    protected static ?string $model = CourseModule::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?string $navigationLabel = 'Course Modules';
    
    protected static string | \UnitEnum | null $navigationGroup = 'Learning Management';
    
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        // Left Column - Main Info
                        Forms\Components\Grid::make(2)
                            ->columnSpan(2)
                            ->schema([
                                Section::make('Module Information')
                                    ->schema([
                                        Forms\Components\Select::make('course_id')
                                            ->label('Course')
                                            ->relationship('course', 'title')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('program_id', Course::find($state)?->program_id)),
                                        
                                        Forms\Components\TextInput::make('title')
                                            ->label('Module Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Short Description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                                
                                Section::make('Content')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Module Content')
                                            ->columnSpanFull()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'link',
                                                'heading',
                                                'bulletList',
                                                'orderedList',
                                                'blockquote',
                                                'codeBlock',
                                            ]),
                                        
                                        Forms\Components\TextInput::make('video_url')
                                            ->label('Video URL (YouTube)')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->helperText('Paste YouTube video URL here')
                                            ->visible(fn ($get) => $get('delivery_type') === 'online_course'),
                                    ])
                                    ->visible(fn ($get) => $get('delivery_type') === 'online_course'),
                            ]),
                        
                        // Right Column - Settings
                        Forms\Components\Grid::make(2)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Delivery Type')
                                    ->schema([
                                        Forms\Components\Select::make('delivery_type')
                                            ->label('Module Type')
                                            ->options([
                                                'online_course' => '📚 Online Course (Video/Text)',
                                                'live_session' => '🎥 Live Session (Zoom/GMeet)',
                                            ])
                                            ->default('online_course')
                                            ->required()
                                            ->reactive()
                                            ->helperText('Choose how this module will be delivered'),
                                    ]),
                                
                                Section::make('Live Session Details')
                                    ->schema([
                                        Forms\Components\DateTimePicker::make('scheduled_at')
                                            ->label('Session Date & Time')
                                            ->required()
                                            ->seconds(false)
                                            ->helperText('When the live session will start'),
                                        
                                        Forms\Components\TextInput::make('meeting_link')
                                            ->label('Meeting Link')
                                            ->url()
                                            ->placeholder('https://zoom.us/j/...')
                                            ->helperText('Zoom/GMeet meeting link')
                                            ->required(),
                                    ])
                                    ->visible(fn ($get) => $get('delivery_type') === 'live_session'),
                                
                                Section::make('Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('order')
                                            ->label('Order')
                                            ->numeric()
                                            ->default(1)
                                            ->required()
                                            ->helperText('Display order in course'),
                                        
                                        Forms\Components\TextInput::make('duration_minutes')
                                            ->label('Duration (minutes)')
                                            ->numeric()
                                            ->default(60)
                                            ->required()
                                            ->suffix('min'),
                                        
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true)
                                            ->helperText('Make module visible to students'),
                                    ]),
                                
                                Section::make('Info')
                                    ->schema([
                                        Forms\Components\Placeholder::make('created_at')
                                            ->label('Created')
                                            ->content(fn (?CourseModule $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                        
                                        Forms\Components\Placeholder::make('updated_at')
                                            ->label('Last Modified')
                                            ->content(fn (?CourseModule $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                                    ])
                                    ->hidden(fn (?CourseModule $record) => $record === null),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Module Title')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->weight('bold'),
                
                Tables\Columns\BadgeColumn::make('delivery_type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'online_course' => '📚 Online',
                        'live_session' => '🎥 Live',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'online_course',
                        'success' => 'live_session',
                    ])
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->label('Scheduled')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Duration')
                    ->sortable()
                    ->suffix(' min')
                    ->alignCenter(),
                
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\SelectFilter::make('delivery_type')
                    ->label('Module Type')
                    ->options([
                        'online_course' => 'Online Course',
                        'live_session' => 'Live Session',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Status')
                    ->placeholder('All modules')
                    ->trueLabel('Published only')
                    ->falseLabel('Unpublished only'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseModules::route('/'),
            'create' => Pages\CreateCourseModule::route('/create'),
            'edit' => Pages\EditCourseModule::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['course.program']);
    }
}
