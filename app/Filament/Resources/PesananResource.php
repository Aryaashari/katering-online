<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $label = "Pesanan";

    protected static ?string $navigationLabel = "Pesanan";

    protected static ?string $pluralLabel = "Pesanan";

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pengguna_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('nama_paket')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_skema')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('periode_hari')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga_satuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kuantitas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_harga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_periode_hari')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required(),
                Forms\Components\TextInput::make('status_order')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('pengguna.name')
                    ->label('Nama Pengguna')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pengguna.telp')
                    ->label('Telp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_order')
                    ->color(fn(string $state): string => match ($state) {
                        'NEW' => 'gray',
                        'PENDING' => 'warning',
                        'PAID' => 'success',
                        'FAILED' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_paket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_skema')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periode_hari')
                    ->suffix(' Hari')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->money('IDR')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kuantitas_periode')
                    ->suffix('x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kuantitas_orang')
                    ->suffix('x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_harga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_periode_hari')
                    ->suffix(' Hari')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([])
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
