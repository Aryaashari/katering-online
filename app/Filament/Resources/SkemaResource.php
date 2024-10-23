<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkemaResource\Pages;
use App\Filament\Resources\SkemaResource\RelationManagers;
use App\Models\Skema;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkemaResource extends Resource
{
    protected static ?string $model = Skema::class;

    protected static ?string $label = "Skema";

    protected static ?string $navigationLabel = "Skema";

    protected static ?string $pluralLabel = "Skema";

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_skema')
                            ->required(),
                TextInput::make('periode_hari')
                            ->required()
                            ->integer(),
                TextInput::make('satuan')
                            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_skema'),
                TextColumn::make('periode_hari'),
                TextColumn::make('satuan')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSkemas::route('/'),
        ];
    }
}
