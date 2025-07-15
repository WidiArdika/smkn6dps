<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileInfoResource\Pages;
use App\Filament\Resources\ProfileInfoResource\RelationManagers;
use App\Models\ProfileInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProfileInfoResource extends Resource
{
    protected static ?string $model = ProfileInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';

    protected static ?string $navigationGroup = 'Halaman Beranda';

    protected static ?string $navigationLabel = 'Informasi Profil Singkat';

    protected static ?string $modelLabel = 'Informasi Profil Singkat';

    protected static ?string $pluralModelLabel = 'Informasi Profil Singkat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->placeholder('Contoh : SMK NEGERI 6 DENPASAR')
                    ->maxLength(255),

                TextInput::make('youtube_url')
                    ->label('URL YouTube (Embed)')
                    ->required()
                    ->url()
                    ->rule('regex:/^https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+$/')
                    ->helperText('Tempel kode embed Youtube dari https sampai di depan tanda tanya ( ? ), Contoh : https://www.youtube.com/embed/LtWWvuqggC8'),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(8)
                    ->required()
                    ->maxLength(700) // Atau 600 kalau mau aman
                    ->helperText('Maksimal 700 karakter (sekitar 100 kata)'),
            ]);
    }

    public static function canCreate(): bool
    {
        return \App\Models\ProfileInfo::count() < 1;
    }

    public static function mutateFormDataBeforeCreate(array $profile): array
    {
        if (\App\Models\ProfileInfo::count() >= 1) {
            Notification::make()
                ->title('Maksimal 1 Profil')
                ->body('Hanya satu data profil yang diperbolehkan.')
                ->danger()
                ->persistent()
                ->send();

            abort(403, 'Sudah ada satu data profil.');
        }

        return $profile;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                ->label('Judul'),

                TextColumn::make('youtube_url')
                    ->label('Video Youtube')
                    ->url(fn ($record) => $record->youtube_url)
                    ->formatStateUsing(fn () => 'Lihat Video')
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-play-circle')
                    ->extraAttributes(['class' => 'text-yellow-700 font-semibold']),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->wrap()
                    ->html() // jika mengandung tag HTML kecil seperti <br>
                    ->extraAttributes([
                        'class' => 'whitespace-normal text-justify',
                    ]),
                ])
            ->filters([
                //
            ])
            ->paginated(false)
            ->emptyStateHeading('Tidak ada data Profil');
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
            'index' => Pages\ListProfileInfos::route('/'),
            'create' => Pages\CreateProfileInfo::route('/create'),
            'edit' => Pages\EditProfileInfo::route('/{record}/edit'),
        ];
    }
}
