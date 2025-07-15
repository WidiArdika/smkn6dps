<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageCarouselResource\Pages;
use App\Filament\Resources\ImageCarouselResource\RelationManagers;
use App\Models\ImageCarousel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\ImageColumn;

class ImageCarouselResource extends Resource
{
    protected static ?string $model = ImageCarousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $activeNavigationIcon = 'heroicon-s-photo';

    protected static ?string $navigationLabel = 'Image Carousel';

    protected static ?string $modelLabel = 'Image Carousel';

    protected static ?string $pluralModelLabel = 'Image Carousel';
    
    protected static ?string $navigationGroup = 'Halaman Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul'),

                Forms\Components\FileUpload::make('image_path')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('images')
                    ->required()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->maxSize(2048) // 2MB
                    ->helperText(new HtmlString(
                        'Nama file maksimal 50 karakter tanpa menggunakan symbols<br>' .
                        'Format yang didukung: JPEG, JPG, PNG, WebP<br>' .
                        '<br>' .
                        'Gunakan Rasio Gambar [ 2.76:1 ]<br>' .
                        'Contoh ukuran dalam pixel : 1920x696<br>' .
                        'Ukuran file maksimal : 2MB'
                    ))
                    ->uploadingMessage('Uploading image...')
                    ->placeholder('Select an image file')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->width(324)
                    ->height(117,3)
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (ImageCarousel $record) {
                        // Hapus file gambar dari storage saat record dihapus
                        if (Storage::disk('public')->exists($record->image_path)) {
                            Storage::disk('public')->delete($record->image_path);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Hapus file gambar dari storage untuk bulk delete
                            foreach ($records as $record) {
                                if (Storage::disk('public')->exists($record->image_path)) {
                                    Storage::disk('public')->delete($record->image_path);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('id', 'desc')
            ->emptyStateHeading('Tidak ada data Image Carousel');
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
            'index' => Pages\ListImageCarousels::route('/'),
            'create' => Pages\CreateImageCarousel::route('/create'),
            'edit' => Pages\EditImageCarousel::route('/{record}/edit'),
        ];
    }
}
