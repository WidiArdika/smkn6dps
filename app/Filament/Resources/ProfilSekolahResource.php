<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilSekolahResource\Pages;
use App\Filament\Resources\ProfilSekolahResource\RelationManagers;
use App\Models\ProfilSekolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilSekolahResource extends Resource
{
    protected static ?string $model = ProfilSekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $activeNavigationIcon = 'heroicon-s-building-library';

    protected static ?string $navigationGroup = 'Tentang Sekolah';

    protected static ?string $navigationLabel = 'Profil Sekolah';

    protected static ?string $modelLabel = 'Profil Sekolah';

    protected static ?string $pluralModelLabel = 'Profil Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('video_url')
                    ->label('URL YouTube (Embed)')
                    ->required()
                    ->url()
                    ->rule('regex:/^https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+$/')
                    ->helperText('Tempel kode embed Youtube dari https sampai di depan tanda tanya ( ? ), Contoh: https://www.youtube.com/embed/LtWWvuqggC8'),

                Forms\Components\RichEditor::make('visi_misi')
                    ->label('Visi dan Misi')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->columnSpan(2),

                Forms\Components\RichEditor::make('profil')
                    ->label('Profil Sekolah')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->columnSpan(2),
                    ]);
    }

    public static function canCreate(): bool
    {
        return \App\Models\ProfilSekolah::count() < 1;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (\App\Models\ProfilSekolah::count() >= 1) {
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
                ViewColumn::make('custom_card')
                    ->label('')
                    ->sortable(false)
                    ->toggleable(false)
                    ->view('filament.resources.profil-sekolah.card-view')
                    ->viewData(fn ($record) => [
                        'record' => $record
                    ]),
            ])
            ->paginated(false)
            ->emptyStateHeading('Tidak ada data Profil Sekolah');
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
            'index' => Pages\ListProfilSekolahs::route('/'),
            'create' => Pages\CreateProfilSekolah::route('/create'),
            'edit' => Pages\EditProfilSekolah::route('/{record}/edit'),
        ];
    }
}
