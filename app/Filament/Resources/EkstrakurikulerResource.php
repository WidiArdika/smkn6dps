<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakurikulerResource\Pages;
use App\Filament\Resources\EkstrakurikulerResource\RelationManagers;
use App\Models\Ekstrakurikuler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Helpers\ImageHelper;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $activeNavigationIcon = 'heroicon-s-puzzle-piece';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Ekstrakurikuler';
    protected static ?string $modelLabel = 'Ekstrakurikuler';
    protected static ?string $pluralModelLabel = 'Ekstrakurikuler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->label('Judul Ekstrakurikuler')
                    ->maxLength(255),

                FileUpload::make('gambar')
                    ->disk('public')
                    ->label('Gambar (Opsional)')
                    ->directory('ekstrakurikuler')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->maxSize(2048)
                    ->helperText(new HtmlString(
                        'Boleh dikosongkan<br>' .
                        '<br>' .
                        'Nama file maksimal 50 karakter tanpa menggunakan symbols<br>' .
                        'Format: JPEG, JPG, PNG, WebP<br>' .
                        'Gunakan Rasio [3:2] (misalnya 1920x1280)<br>' .
                        'Ukuran maksimal: 2MB'
                    )),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi Ekstrakurikuler')
                    ->required()
                    ->columnSpan(2)
                    ->fileAttachmentsDirectory('ekstrakurikuler/rich')
                    ->fileAttachmentsDisk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->width(144)
                    ->height(96)
                    ->defaultImageUrl(asset('images/fallback.jpg')),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Ekstrakurikuler')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Ekstrakurikuler')
                    ->searchable()
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
                        ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'ekstrakurikuler/rich');
                        ImageHelper::deleteLivewireTmpFiles();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'ekstrakurikuler/rich');
                                ImageHelper::deleteLivewireTmpFiles();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Ekstrakurikuler');
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
            'index' => Pages\ListEkstrakurikulers::route('/'),
            'create' => Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
