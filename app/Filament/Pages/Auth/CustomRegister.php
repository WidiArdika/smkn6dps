<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;

class CustomRegister extends Register
{
    public function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        TextInput::make('access_code')
                            ->label('Kode Akses')
                            ->required(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function handleRegistration(array $data): Model
    {
        // Validasi access code terlebih dahulu
        $kodeAksesValid = env('ACCESS_CODE');

        if ($data['access_code'] !== $kodeAksesValid) {
            throw ValidationException::withMessages([
                'data.access_code' => 'Kode akses salah.',
            ]);
        }

        // Setelah validasi berhasil, buat user
        $user = static::getUserModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // Sudah dihash dari form component
        ]);

        // Assign role super_admin
        $user->assignRole('super_admin');

        return $user;
    }
}
