<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Filament\Resources\PaketResource\RelationManagers;
use App\Models\Paket;
use App\Models\Skema;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $label = "Paket";

    protected static ?string $navigationLabel = "Paket";

    protected static ?string $pluralLabel = "Paket";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_paket')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(Paket::class, 'slug', ignoreRecord: true),
                RichEditor::make('deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'orderedList',
                        'redo',
                        'undo',
                    ]),
                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('uploads/paket/thumbnails')
                    ->required()
                    ->label('Thumbnail')
                    ->columnSpanFull(),
                FileUpload::make('foto')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('uploads/paket/foto')
                    ->required()
                    ->label('Foto-foto')
                    ->minFiles(4)
                    ->columnSpanFull(),

                Section::make('Skema Paket')
                    ->description('Tambahkan skema yang sesuai dengan paket')
                    ->schema([
                        Repeater::make('paketSkema')
                            ->label('')
                            ->relationship()
                            ->schema([
                                Select::make('skema_id')
                                    ->preload()
                                    ->relationship('skema', 'nama_skema')
                                    ->columnSpanFull(),

                                RichEditor::make('deskripsi')
                                    ->required()
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'italic',
                                        'orderedList',
                                        'redo',
                                        'undo',
                                    ]),

                                TextInput::make('harga')
                                    ->label('Harga')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->required()
                            ->grid(2)
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Skema')
                            ->minItems(1)
                            ->addActionAlignment(Alignment::Start),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_paket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('thumbnail'),
                // Tables\Columns\TextColumn::make('thumbnail')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPakets::route('/'),
            'create' => Pages\CreatePaket::route('/create'),
            'edit' => Pages\EditPaket::route('/{record}/edit'),
        ];
    }
}
