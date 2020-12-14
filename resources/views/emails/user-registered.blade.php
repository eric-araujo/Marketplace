@php
    date_default_timezone_set('America/Sao_Paulo'); 
@endphp
<h1>Bem vindo {{$user->name}} ao Marketplace!!!
    
<h3>Obrigado por sua inscrição! :)</h3>

<p>
    Faça bom proveito e excelentes compras em nosso marketplace<br>
    Seu email de cadastro é: <strong>{{$user->email}}</strong><br>
    Sua senha: <strong>Por questões de segurança não enviamos sua senha</strong>
</p>

<hr>
Email enviado em {{date('d/m/Y H:i:s')}}.