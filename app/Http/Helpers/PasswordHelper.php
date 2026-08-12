<?php

namespace App\Http\Helpers;

use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class PasswordHelper
{
    public function sendPasswordResetLink($request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Crypt::encrypt($request->email);
        if ($user != null) {
            $data=[];
            $data['email'] = $request->email;
            $data['token'] = $token;
            $data['title'] = 'Recupero de contraseña';
            $data['body'] = 'Hola, para crear una nueva contraseña puedes hacer click en el siguiente boton.';
            $data['actionURL'] = env('APP_URL') . '/auth/password/reset/' . $token;
            $data['actionBtnText'] = 'Restablecer contraseña';
            $data['subject'] = 'Recupero de contraseña';
            Mail::send('emails.password', ['data' => (object) $data], function ($message) use ($data) {
                $message->from('us@example.com', 'Laravel');
                $message->subject($data['subject']);
                $message->to($data['email']);
            });
        }

        $user->reset_password = $token;
        $user->update();

    }
}