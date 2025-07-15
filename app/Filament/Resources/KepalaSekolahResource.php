<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KepalaSekolahResource\Pages;
use App\Filament\Resources\KepalaSekolahResource\RelationManagers;
use App\Models\KepalaSekolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\HtmlString;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KepalaSekolahResource extends Resource
{
    protected static ?string $model = KepalaSekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationGroup = 'Tentang Sekolah';

    protected static ?string $navigationLabel = 'Kepala Sekolah';

    protected static ?string $modelLabel = 'Kepala Sekolah';

    protected static ?string $pluralModelLabel = 'Kepala Sekolah';

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
                            'Gunakan Rasio Gambar [ 2:3 ]<br>' .
                            'Contoh ukuran dalam pixel : 1280x1920<br>' .
                            'Ukuran file maksimal : 2MB'
                        ))
                        ->uploadingMessage('Uploading image...')
                        ->placeholder('Select an image file'),
            ]);
    }

    public static function canCreate(): bool
    {
        return \App\Models\KepalaSekolah::count() < 1;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (\App\Models\KepalaSekolah::count() >= 1) {
            Notification::make()
                ->title('Maksimal 1 Profil')
                ->body('Hanya satu data profil yang diperbolehkan.')
                ->danger()
                ->persistent()
                ->send();

            abort(403, 'Sudah ada satu data profil.');
        }

        return $data;
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
                    ->sortable(),

                TextColumn::make('nip')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateHeading('Tidak ada data Kepala Sekolah');
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
            'index' => Pages\ListKepalaSekolahs::route('/'),
            'create' => Pages\CreateKepalaSekolah::route('/create'),
            'edit' => Pages\EditKepalaSekolah::route('/{record}/edit'),
        ];
    }
}
