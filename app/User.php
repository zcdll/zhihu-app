<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        // 模板变量
        $data = [
            'url' => url(config('app.url').route('password.reset', $token, false)),
        ];
        $template = new SendCloudTemplate('test_template_active', $data);

        Mail::raw($template, function ($message) {
            $message->from('2747240770@qq.com', 'zcdll');
            $message->to($this->email);
        });
    }
}
