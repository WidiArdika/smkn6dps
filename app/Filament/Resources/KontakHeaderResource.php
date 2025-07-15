<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontakHeaderResource\Pages;
use App\Filament\Resources\KontakHeaderResource\RelationManagers;
use App\Models\KontakHeader;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KontakHeaderResource extends Resource
{
    protected static ?string $model = KontakHeader::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $activeNavigationIcon = 'heroicon-s-information-circle';

    protected static ?string $navigationLabel = 'Kontak Navbar';

    protected static ?string $navigationGroup = 'Kontak';

    protected static ?string $modelLabel = 'Kontak Navbar';
    protected static ?string $pluralModelLabel = 'Kontak Navbar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(50)
                    ->label('Informasi Kontak'),

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
                ViewColumn::make('icon')
                    ->label('Icon')
                    ->view('filament.tables.columns.icon-preview'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable(),

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
            ->emptyStateHeading('Tidak ada data Kontak Navbar');
    }

    protected static function getHeroiconsOptions(): array
    {
        return [
            'inbox' => 'Inbox (Arsip)',
            'archive-box' => 'Archive Box (Kotak Arsip)',
            'phone' => 'Telephone (Telepon)',
            'megaphone' => 'Megaphone (Toa)', 
            'envelope-open' => 'Envelope Open (Amplop Terbuka)',
            'envelope' => 'Envelope (Amplop)',
            'calendar-days' => 'Calendar (Kalender)',
            'at-symbol' => 'at Symbol (Symbol @)',
            'clock' => 'Clock (Jam)',
            'bell' => 'Bell (Lonceng)',
            'chat-bubble-oval-left-ellipsis' => 'Chat Oval (Pesan Bulat)',
            'chat-bubble-bottom-center-text' => 'Chat Bubble (Pesan Bubble)',
            'question-mark-circle' => 'Question Circle (Tanda Tanya Bulat)',
            'exclamation-circle' => 'Exclamation Circle (Tanda Seru Bulat)',
            'home' => 'Home (Rumah)',
            'light-bulb' => 'Light Bulb (Lampu)',
            'map-pin' => 'Location (Lokasi)',
            'user-group' => 'User Group (Grup Pengguna)',
            'users' => 'Users (Pengguna)',
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
            'index' => Pages\ListKontakHeaders::route('/'),
            'create' => Pages\CreateKontakHeader::route('/create'),
            'edit' => Pages\EditKontakHeader::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return \App\Models\KontakHeader::count() < 3;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (\App\Models\KontakHeader::count() >= 3) {
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
