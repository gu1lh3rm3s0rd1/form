<?php
    session_start();
    
    $servidor = "192.168.0.4";
    $porta = 5432;
    $banco = "POS_VENDA";
    $usuario = "postgres";
    $senha = "Dwf6127d4l5k6@";

    # Conecta com o servidor de banco de dados
    $conexao = pg_connect("host=$servidor
                        port=$porta
                        dbname=$banco
                        user=$usuario
                        password=$senha")

    or die ("Não foi possível conectar ao servidor PostGreSQL");

    $_SESSION['empresa'] = $_POST['empresa'];

    $empresa = $_SESSION['empresa'];



    switch ($empresa) {

        case 'TECHTO BRASIL LTDA':
            $link = "TECHTO/techto.php";
            break;

        case 'CHIAPERINI INDUSTRIAL LTDA':
            $link = "CHIAPERINI/chiaperini.php";
            break;

        case 'FUNDICAO NATIVIDADE LTDA':
            $link = "FUNDICAO/fundicao.php";
            break;
    
        case 'MERCADAO LOJISTA LTDA':
            $link = "MERCADAO/3dla.php";
            break;

    }

    //$result = pg_query($conexao, "INSERT INTO formulario (empresa) VALUES ('$empresa')");

    if (!$empresa) {
       echo '<script>
       window.alert("Algo deu errado, por favor contate o suporte para reportar este erro.");
       window.location.href = "index.php";
       </script>';

    }else{
       echo '<script>
       window.location.href = "'.$link.'";
       </script>';

    };

?>