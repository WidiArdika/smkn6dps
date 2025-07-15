<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Filament\Resources\PrestasiResource\RelationManagers;
use App\Models\Prestasi;
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
use Filament\Forms\Components\DatePicker;
use App\Helpers\ImageHelper;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $activeNavigationIcon = 'heroicon-s-trophy';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Prestasi Siswa';
    protected static ?string $modelLabel = 'Prestasi Siswa';
    protected static ?string $pluralModelLabel = 'Prestasi Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->label('Judul Prestasi')
                    ->maxLength(255),

                FileUpload::make('gambar')
                    ->disk('public')
                    ->label('Gambar (Opsional)')
                    ->directory('prestasi')
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
                    ->label('Deskripsi Prestasi')
                    ->required()
                    ->columnSpan(2)
                    ->fileAttachmentsDirectory('prestasi/rich')
                    ->fileAttachmentsDisk('public'),

                DatePicker::make('tanggal')
                    ->required()
                    ->helperText('Tanggal pencapaian prestasi'),
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
                    ->label('Judul Prestasi')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Prestasi')
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
                        ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'prestasi/rich');
                        ImageHelper::deleteLivewireTmpFiles();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'prestasi/rich');
                                ImageHelper::deleteLivewireTmpFiles();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Prestasi');
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
