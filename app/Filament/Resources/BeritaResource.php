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
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
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

                Select::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required()
                    ->helperText('Draft: Tidak akan tampil di website. Published: Akan tampil di website.'),
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

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-check-circle' => 'published',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Published',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Berita')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => 
                        Str::limit(strip_tags($state), 100, '...')
                    )
                    ->html()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->searchable()
                    ->sortable()
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->placeholder('Semua Status'),
            ])
            ->actions([
                // Quick publish/unpublish action
                Action::make('togglePublish')
                    ->label(fn (Berita $record) => $record->status === 'published' ? 'Unpublish' : 'Publish')
                    ->icon(fn (Berita $record) => $record->status === 'published' ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Berita $record) => $record->status === 'published' ? 'warning' : 'success')
                    ->size('sm')
                    ->action(function (Berita $record) {
                        $newStatus = $record->status === 'published' ? 'draft' : 'published';
                        $record->update(['status' => $newStatus]);
                        
                        $message = $newStatus === 'published' 
                            ? 'Berita "' . Str::limit($record->judul, 30) . '" berhasil dipublish!'
                            : 'Berita "' . Str::limit($record->judul, 30) . '" berhasil di-unpublish!';
                            
                        Notification::make()
                            ->title($message)
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading(fn (Berita $record) => 
                        ($record->status === 'published' ? 'Unpublish' : 'Publish') . ' Berita'
                    )
                    ->modalDescription(fn (Berita $record) => $record->status === 'published' 
                        ? 'Berita ini akan disembunyikan dari website dan tidak dapat diakses pengunjung.' 
                        : 'Berita ini akan dipublikasikan dan dapat diakses oleh pengunjung website.'
                    )
                    ->modalSubmitActionLabel(fn (Berita $record) => $record->status === 'published' ? 'Ya, Unpublish' : 'Ya, Publish'),

                Tables\Actions\EditAction::make(),
                
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'berita/rich');
                        ImageHelper::deleteLivewireTmpFiles();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Bulk publish action
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publish Terpilih')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $count = 0;
                            $records->each(function ($record) use (&$count) {
                                if ($record->status === 'draft') {
                                    $record->update(['status' => 'published']);
                                    $count++;
                                }
                            });
                            
                            if ($count > 0) {
                                Notification::make()
                                    ->title($count . ' berita berhasil dipublish!')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Tidak ada berita yang dipublish (semua sudah published)')
                                    ->warning()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Publish Berita Terpilih')
                        ->modalDescription('Berita yang dipilih akan dipublikasikan ke website.')
                        ->modalSubmitActionLabel('Ya, Publish'),
                    
                    // Bulk unpublish action
                    Tables\Actions\BulkAction::make('unpublish')
                        ->label('Unpublish Terpilih')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(function ($records) {
                            $count = 0;
                            $records->each(function ($record) use (&$count) {
                                if ($record->status === 'published') {
                                    $record->update(['status' => 'draft']);
                                    $count++;
                                }
                            });
                            
                            if ($count > 0) {
                                Notification::make()
                                    ->title($count . ' berita berhasil di-unpublish!')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Tidak ada berita yang di-unpublish (semua masih draft)')
                                    ->warning()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Unpublish Berita Terpilih')
                        ->modalDescription('Berita yang dipilih akan disembunyikan dari website.')
                        ->modalSubmitActionLabel('Ya, Unpublish'),

                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                ImageHelper::deleteImagesFromRecord($record, 'gambar', 'deskripsi', 'berita/rich');
                                ImageHelper::deleteLivewireTmpFiles();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Berita')
            ->defaultSort('created_at', 'desc');
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

    // Menampilkan jumlah berita berdasarkan status di navigation badge
    public static function getNavigationBadge(): ?string
    {
        $published = static::getModel()::published()->count();
        $draft = static::getModel()::draft()->count();
        
        return $published . '/' . ($published + $draft);
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
}