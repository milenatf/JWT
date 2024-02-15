<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationToken;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

/**
 * Esta classe lida com todos os processos de verificação de e-mail
 */

class EmailVerificationService
{
    /**
     * Enviar link de verificação ao usuário
     *
     * @param object $user
     */

    public function sendVerificationLink(object $user): void
    {
        Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }

    /**
     * Método que vai gerar o link de verificação que será enviao ao e-mail do usuário
     * @param string $email
     * @return string
     */

    public function generateVerificationLink(string $email): string
    {
        /**
         * As tres linhas de código logo abaixo deste comentário. fazem a verificação se já foi gerado um token de verificação de e-mail para o usuário.
         * Se sim, esse token é excluído e porteriormente outro será criado.
         *
         * Isso ocorre quando um usuário cria a sua conta e o tempo de expiração do token excede. Dessa forma o token de verificação se torna inválido
         * sendo necessário criar um outro token para que esse usuário possa verificar o seu e-mail
         */
        $checkIfTokenExists = EmailVerificationToken::where('email', $email)->first(); // Verifica se ja existe  um link que contém o e-mail do usuário

        if($checkIfTokenExists) // Se o token já existir
            $checkIfTokenExists->delete(); // Será excluído (antes de se criar um novo token)

        $token = Str::uuid(); // Novo token
        /**
         *  Cria a URL que será enviada para o usuário.
         * O trecho de código config('app.url') obtem a URL do aplicativo que está definida no arquivo .env (APP_URL)
         *
         * */
        $url = config('app.url'). "?token=".$token . "&email=".$email;

        // Salva o token dentro do banco de dados
        $saveToken = EmailVerificationToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addMinutes(60) // Token expira em 60 minutos
        ]);

        if($saveToken) // Se salvar o token
            return $url; // retorna a URL
    }


}