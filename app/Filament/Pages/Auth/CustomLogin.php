<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;

class CustomLogin extends Login
{
    protected static string $view = 'filament-panels::pages.auth.login';

    public ?array $data = [];

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email / Username')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2])
            ->hint(filament()->hasPasswordReset() ? new HtmlString(
                Blade::render(
                    '<x-filament::link :href="filament()->getRequestPasswordResetUrl()" tabindex="3">Lupa password?</x-filament::link>'
                )
            ) : null);
    }

    protected function getRememberFormComponent(): Component
    {
        return Checkbox::make('remember')
            ->label('Ingat saya');
    }

    /**
     * Override ini untuk cek: inputnya email atau name?
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        $loginKey = str_contains($data['email'], '@') ? 'email' : 'name';

        return [
            $loginKey => $data['email'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.email' => 'Email / Username atau password salah.',
        ]);
    }
}
