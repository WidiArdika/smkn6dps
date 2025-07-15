<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Staf;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StafResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StafResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class StafResource extends Resource
{
    protected static ?string $model = Staf::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';

    protected static ?string $navigationGroup = 'Tentang Sekolah';

    protected static ?string $navigationLabel = 'Staf dan Guru';

    protected static ?string $modelLabel = 'Staf dan Guru';

    protected static ?string $pluralModelLabel = 'Staf dan Guru';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('nama')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('nip')
                        ->label('NIP')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->required()
                        ->maxLength(255),

                    FileUpload::make('foto')
                        ->label('Pas Foto')
                        ->image()
                        ->disk('public')
                        ->directory('staf-foto')
                        ->required()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                        ->maxSize(2048)
                        ->helperText(new HtmlString(
                            'Nama file maksimal 50 karakter tanpa menggunakan symbols<br>' .
                            'Format yang didukung: JPEG, JPG, PNG, WebP<br>' .
                            '<br>' .
                            'Gunakan Rasio Gambar [ 3:4 ]<br>' .
                            'Contoh ukuran dalam pixel : 1800x2400<br>' .
                            'Ukuran file maksimal : 2MB'
                        ))
                        ->uploadingMessage('Uploading image...')
                        ->placeholder('Select an image file'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->width(48)
                    ->height(72),

                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nip')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jabatan')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Staf $record) {
                        // Hapus file gambar dari storage saat record dihapus
                        if (Storage::disk('public')->exists($record->foto)) {
                            Storage::disk('public')->delete($record->foto);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Hapus file gambar dari storage untuk bulk delete
                            foreach ($records as $record) {
                                if (Storage::disk('public')->exists($record->foto)) {
                                    Storage::disk('public')->delete($record->foto);
                                }
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Staf & Guru');
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
            'index' => Pages\ListStafs::route('/'),
            'create' => Pages\CreateStaf::route('/create'),
            'edit' => Pages\EditStaf::route('/{record}/edit'),
        ];
    }
}
