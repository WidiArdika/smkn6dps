<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IconContentResource\Pages;
use App\Filament\Resources\IconContentResource\RelationManagers;
use App\Models\IconContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ViewColumn;

class IconContentResource extends Resource
{
    protected static ?string $model = IconContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $activeNavigationIcon = 'heroicon-s-squares-2x2';

    protected static ?string $navigationLabel = 'Konten Icon Cards';

    protected static ?string $modelLabel = 'Konten Icon Cards';

    protected static ?string $pluralModelLabel = 'Konten Icon Cards';

    protected static ?string $navigationGroup = 'Halaman Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul')
                    ->placeholder('Contoh: Jumlah Jurusan'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(500)
                    ->label('Deskripsi')
                    ->placeholder('Contoh: Memiliki 6 Jumlah Jurusan')
                    ->rows(3),

                Forms\Components\Select::make('icon')
                    ->required()
                    ->label('Icon')
                    ->options(self::getHeroiconsOptions())
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('icon_component')
                ->label('Icon')
                ->view('filament.tables.columns.icon-preview'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->paginated(false) // Hilangkan pagination sepenuhnya
            ->defaultSort('created_at', 'desc') // Urutkan berdasarkan terbaru
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateHeading('Tidak ada data Konten Icon Cards');
    }

    protected static function getHeroiconsOptions(): array
    {
        return [
            'academic-cap' => 'Academic Cap (Topi Wisuda)',
            'archive-box' => 'Archive Box (Kotak Arsip)',
            'banknotes' => 'Banknotes (Uang)',
            'book-open' => 'Book Open (Buku Terbuka)', 
            'briefcase' => 'Briefcase (Tas Kerja)',
            'building-library' => 'Building Library (Perpustakaan)',
            'calculator' => 'Calculator (Kalkulator)',
            'calendar-days' => 'Calendar (Kalender)',
            'chart-bar' => 'Chart Bar (Grafik Batang)',
            'clock' => 'Clock (Jam)',
            'computer-desktop' => 'Computer (Komputer)',
            'document-text' => 'Document (Dokumen)',
            'home' => 'Home (Rumah)',
            'light-bulb' => 'Light Bulb (Lampu)',
            'map-pin' => 'Location (Lokasi)',
            'presentation-chart-line' => 'Presentation (Presentasi)',
            'trophy' => 'Trophy (Trofi)',
            'user-group' => 'User Group (Grup Pengguna)',
            'users' => 'Users (Pengguna)',
            'puzzle-piece' => 'puzzle-piece (Keping Puzzle)',
        ];
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
            'index' => Pages\ListIconContents::route('/'),
            'create' => Pages\CreateIconContent::route('/create'),
            'edit' => Pages\EditIconContent::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return \App\Models\IconContent::count() < 3;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (\App\Models\IconContent::count() >= 3) {
            Notification::make()
                ->title('Maksimal Konten Tercapai')
                ->body('Hanya diperbolehkan maksimal 3 konten icon.')
                ->danger()
                ->persistent() // agar tidak langsung hilang
                ->send();

            abort(403, 'Maksimal 3 konten icon diperbolehkan.');
        }

        return $data;
    }
}
