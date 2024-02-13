# Sobre o projeto

Tutorial sobre o JWT no Laravel 10

- [Documentação oficial](https://jwt-auth.readthedocs.io/en/develop/quick-start/)
- [Tutorial Youtube - Code Experts](https://www.youtube.com/watch?v=N1QQ1qQP0wo).
- [Conhecendo o JWT](https://www.youtube.com/watch?v=noke3sqRryw&list=PL73TuEpYuGGRgN35JyhpFOD4EscR4_-tI).

- [Tutorial Youtube | Wisdom Diala | Vídeo 01 - Laravel 10 REST API development with JWT. Part One: Installing JWT Auth package](https://www.youtube.com/watch?v=pWcDLDAm1M4)
- [Tutorial Youtube | Wisdom Diala | Vídeo 02 - Laravel 10 REST API development with JWT. Part Two: Registration and Login endpoint](https://www.youtube.com/watch?v=mA9xGXrgrmI)
- [Tutorial Youtube | Wisdom Diala | Vídeo 03 (Parte 01) - Laravel 10 REST API development with JWT. Part 3: Email Verification ep1](https://www.youtube.com/watch?v=TkgW8yGdEGM)
- [Tutorial Youtube | Wisdom Diala | Vídeo 03 (Parte 02) - Laravel 10 REST API development with JWT. Part 3: Email Verification ep2](https://www.youtube.com/watch?v=30UFunHZymU)
- [Tutorial Youtube | Wisdom Diala | Vídeo 04 - Laravel 10 REST API development with JWT. Part 4: Change password](https://www.youtube.com/watch?v=KsQcpiJ9qOo)

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

## Instalar a biblioteca JWT-auth
```
composer require tymon/jwt-auth
```

## publicar no projeto o config do jwt que será copiado do pacote para o diretório config/jwt.php deste projeto

```
composer require tymon/jwt-auth
```
escolher a opção: Provider: Tymon\JWTAuth\Providers\LaravelServiceProvider

Etapas:

1. Configurar o JWT:
    - [Documentação oficial](https://jwt-auth.readthedocs.io/en/develop/quick-start/)

2. Criar a classe FormRequest onde ficarão as validações para regitrar um usuário
```
php artisan make:request RegistrationRequest
```

3. Criar o AuthController
    3.1 - Criar o método register
    3.2 - Criar o método login

