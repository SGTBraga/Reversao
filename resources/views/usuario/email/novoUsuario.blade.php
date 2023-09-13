<html>
    <body>
        <p>Prezado(a) Sr(a) {{ $user->NOME }},</p>
        <p>Conforme solicitado, segue a senha de acesso ao Sistema de Exercícios Anteriores - Módulo REVERSÃO</p>
        <p>O sistema pode ser acessado através do link: <a href="http://reversao.dirad.intraer/reversao/public/">http://reversao.dirad.intraer/reversao/public/</a></p>
        <p><b>Sua senha: {{ $senha }}</b></p>
        <hr>
        <p>Solicito a V.Sa. trocar a senha já no primeiro acesso ao sistema.</p>
        <p>Att, <br>
            <b>Subdiretoria de Pagamento de Pessoal - SDPP</b></p>
        <p>Assessoria de Sistemas - PPSIS</p>
        <img src="{{ asset('images/domPpsis.png') }}" align="center" width="30px">
    </body>
</html>