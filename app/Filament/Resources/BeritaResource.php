<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\HtmlString;
use App\Helpers\ImageHelper;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Informasi';
    protected static ?string $navigationLabel = 'Berita dan Kegiatan';
    protected static ?string $modelLabel = 'Berita dan Kegiatan';
    protected static ?string $pluralModelLabel = 'Berita dan Kegiatan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul')
                ->required()
                ->label('Judul Berita')
                ->maxLength(255),

            Forms\Components\FileUpload::make('gambar')
                ->disk('public')
                ->label('Gambar')
                ->directory('berita')
                ->image()
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                ->maxSize(2048)
                ->helperText(new HtmlString(
                    'Nama file maksimal 50 karakter tanpa simbol<br>' .
                    'Format: JPEG, JPG, PNG, WebP<br>' .
                    'Rasio: 3:2 (Contoh: 1920x1280)<br>' .
                    'Ukuran max: 2MB'
                ))
                ->uploadingMessage('Uploading image...')
                ->placeholder('Pilih gambar')
                ->required(),

            Forms\Components\RichEditor::make('deskripsi')
                ->label('Deskripsi Berita')
                ->required()
                ->columnSpan(2)
                ->fileAttachmentsDirectory('berita/rich')
                ->fileAttachmentsDisk('public'),

            Forms\Components\DatePicker::make('tanggal')
                ->required(),

            // Field status publish/draft
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft')
                ->visible(fn () => Gate::allows('publish', Berita::class)), // cek policy
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
                    ->label('Deskripsi')
                    ->searchable()
                    ->formatStateUsing(fn (string $state) =>
                        Str::limit(strip_tags($state), 500, '...')
                    )
                    ->html()
                    ->wrap(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                    ]),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
