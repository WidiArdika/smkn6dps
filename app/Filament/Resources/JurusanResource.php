<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Jurusan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JurusanResource\Pages;
use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JurusanResource\RelationManagers;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static ?string $navigationGroup = 'Jurusan Sekolah';

    protected static ?string $navigationLabel = 'Daftar Jurusan';

    protected static ?string $modelLabel = 'Jurusan';
    protected static ?string $pluralModelLabel = 'Jurusan';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $activeNavigationIcon = 'heroicon-s-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Jurusan'),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('jurusan-images')
                    ->required()
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
                    ->placeholder('Select an image file'),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi Jurusan')
                    ->required()
                    ->columnSpan(2)
                    ->fileAttachmentsDirectory('jurusan-images/rich')
                    ->fileAttachmentsDisk('public'),
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

                Tables\Columns\TextColumn::make('nama')
                    ->label('Judul')
                    ->searchable()
                    ->wrap()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Jurusan')
                    ->formatStateUsing(fn (string $state): string => 
                        Str::limit(strip_tags($state), 500, '...')
                    )
                    ->html()
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'jurusan-images/rich');
                        ImageHelper::deleteLivewireTmpFiles();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'jurusan-images/rich');
                                ImageHelper::deleteLivewireTmpFiles();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Jurusan');
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
            'index' => Pages\ListJurusans::route('/'),
            'create' => Pages\CreateJurusan::route('/create'),
            'edit' => Pages\EditJurusan::route('/{record}/edit'),
        ];
    }
}
