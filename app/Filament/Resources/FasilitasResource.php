<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Fasilitas;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FasilitasResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FasilitasResource\RelationManagers;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $activeNavigationIcon = 'heroicon-s-building-office';
    protected static ?string $navigationGroup = 'Tentang Sekolah';
    protected static ?string $navigationLabel = 'Fasilitas Sekolah';
    protected static ?string $modelLabel = 'Fasilitas Sekolah';
    protected static ?string $pluralModelLabel = 'Fasilitas Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Fasilitas'),

                FileUpload::make('gambar_360')
                    ->label('Gambar 360°')
                    ->disk('public')
                    ->label('Gambar 360°')
                    ->directory('fasilitas')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->helperText(new HtmlString(
                        'Nama file maksimal 50 karakter tanpa menggunakan symbols<br>' .
                        'Format yang didukung: JPEG, JPG, PNG<br>' .
                        'Ukuran Maksimal 10MB<br>' .
                        'Disarankan Rasio Gambar : Horizontal (Rasio 2:1) atau Gambar hasil dari kamera 360°'
                    ))
                    ->preserveFilenames(false)
                    ->required()
                    ->uploadingMessage('Uploading image...')
                    ->placeholder('Select an image file'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                ImageColumn::make('gambar_360')->disk('public')->label('Preview'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Fasilitas $record) {
                        // Hapus file gambar dari storage saat record dihapus
                        if (Storage::disk('public')->exists($record->gambar_360)) {
                            Storage::disk('public')->delete($record->gambar_360);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                                // Hapus file gambar dari storage untuk bulk delete
                                foreach ($records as $record) {
                                    if (Storage::disk('public')->exists($record->gambar_360)) {
                                        Storage::disk('public')->delete($record->gambar_360);
                                    }
                                }
                            }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Fasilitas');
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
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
