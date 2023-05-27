<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {

        $dataAPi = ['login' => $this->login, 'senha' => $this->password];

        $response = Http::post(env('UNILAB_API_ORIGIN') . '/authenticate', $dataAPi);

        $responseJ = json_decode($response->body());

        $userId  = 0;

        if (isset($responseJ->id)) {
            $userId = intval($responseJ->id);
        }
        if ($userId === 0) {
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        $headers = [
            'Authorization' => 'Bearer ' . $responseJ->access_token,
        ];
        $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/user', $headers);
        $responseJ2 = json_decode($response->body());

        // $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/bond', $headers);
        // $responseJ3 = json_decode($response->body());


        $user = User::firstOrNew(['id' => $userId]);
        $user->id = $userId;
        $user->name = $responseJ2->nome;
        $user->email = $responseJ2->email;
        // $user->login = $responseJ2->login;
        // $user->division_sig = $responseJ3[0]->sigla_unidade;
        $user->password = $this->password;

        $user->save();


        $dataAtemp = ['email' => $responseJ2->email, 'password' => $this->password];
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($dataAtemp, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
