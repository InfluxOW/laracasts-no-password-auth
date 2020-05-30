<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{
    /**
     * Fillable fields for the model.
     *
     * @var array
     */
    protected $fillable = ['token'];

    /**
     * Generate a new token for the given user.
     *
     * @param  User $user
     * @return $this
     */
    public static function generateFor(User $user)
    {
        return $user->token()->create([
            'token'   => Str::random(50)
        ]);
    }

    /**
     * Send the token to the user.
     */
    public function send()
    {
        $url = route('auth.token', $this->token);

        Mail::raw(
            "<a href='{$url}'>{$url}</a>",
            function ($message) {
                $message->to($this->user->email)
                        ->subject('Login to YourSite');
            }
        );
    }

    /**
     * A token belongs to a registered user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
