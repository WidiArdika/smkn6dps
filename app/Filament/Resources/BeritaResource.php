<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Helpers\ImageHelper;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $activeNavigationIcon = 'heroicon-s-newspaper';

    protected static ?string $navigationGroup = 'Informasi';

    protected static ?string $navigationLabel = 'Berita dan Kegiatan';

    protected static ?string $modelLabel = 'Berita dan Kegiatan';
    protected static ?string $pluralModelLabel = 'Berita dan Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->label('Judul Berita')
                    ->maxLength(255),

                FileUpload::make('gambar')
                    ->disk('public')
                    ->label('Gambar')
                    ->directory('berita')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->maxSize(2048)
                    ->helperText(new HtmlString(
                        'Nama file maksimal 50 karakter tanpa menggunakan symbols<br>' .
                        'Format yang didukung: JPEG, JPG, PNG, WebP<br>' .
                        '<br>' .
                        'Gunakan Rasio Gambar [ 3:2 ]<br>' .
                        'Contoh ukuran dalam pixel : 1920x1280<br>' .
                        'Ukuran file maksimal : 2MB'
                    ))
                    ->uploadingMessage('Uploading image...')
                    ->placeholder('Select an image file')
                    ->required(),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi Berita')
                    ->required()
                    ->columnSpan(2)
                    ->fileAttachmentsDirectory('berita/rich')
                    ->fileAttachmentsDisk('public'),

                DatePicker::make('tanggal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->width(144)
                    ->height(96)
                    ->disk('public'),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Berita')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => 
                        Str::limit(strip_tags($state), 500, '...')
                    )
                    ->html()
                    ->wrap(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'berita/rich');
                        ImageHelper::deleteLivewireTmpFiles();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'berita/rich');
                                ImageHelper::deleteLivewireTmpFiles();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Berita');
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
