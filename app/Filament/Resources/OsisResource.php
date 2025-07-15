<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OsisResource\Pages;
use App\Filament\Resources\OsisResource\RelationManagers;
use App\Models\Osis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class OsisResource extends Resource
{
    protected static ?string $model = Osis::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $activeNavigationIcon = 'heroicon-s-table-cells';
    protected static ?string $navigationLabel = 'Struktur OSIS';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $modelLabel = 'Struktur OSIS';
    protected static ?string $pluralModelLabel = 'Struktur OSIS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('periode')
                    ->label('Periode Kepengurusan')
                    ->required()
                    ->placeholder('Contoh: 2024/2025'),

                Repeater::make('anggota')
                    ->label('Daftar Anggota OSIS')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama')
                            ->required(),

                        TextInput::make('jabatan')
                            ->label('Jabatan')
                            ->required(),
                    ])
                    ->columns(2)
                    ->defaultItems(1)
                    ->minItems(1)
                    ->reorderable()
                    ->collapsible()
                    ->addActionLabel('Tambah Anggota')
                    ->label('Struktur OSIS'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('periode')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('l, d F Y')->label('Dibuat'),
            ])
            ->defaultSort('created_at', 'desc')
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
            ])
            ->emptyStateHeading('Tidak ada data Struktur OSIS');
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
            'index' => Pages\ListOses::route('/'),
            'create' => Pages\CreateOsis::route('/create'),
            'edit' => Pages\EditOsis::route('/{record}/edit'),
        ];
    }
}
