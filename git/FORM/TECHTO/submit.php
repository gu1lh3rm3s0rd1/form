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

    try{
        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=POS_VENDA","postgres", "Dwf6127d4l5k6@");
        
        $query = "SELECT max(id_formulario) as id_formulario FROM formulario";

        foreach($myPDO->query($query)as $row){
            $sql = $row['id_formulario'];

      }

    }catch(PDOException $e){
        echo $e->getMEssage();
             
    }

    //$id_formulario = $_POST['nome'];
    $cod_cliente = $_POST['codigo'];
    $cliente_cpf_cnpj = $_POST['cnpj'];
    $cliente_nome = $_POST['nome'];
    $cliente_uf = $_POST['estado'];
    $cliente_municipio = $_POST['municipio'];
    $cliente_endereco = $_POST['endereco'];
    $cliente_bairro = $_POST['bairro'];
    $cod_pedido = $_POST['pedido'];
    $cod_item_pedido = $_POST['desc'];
    $contato_nome = $_POST['contato_nome'];
    $contato_cargo = $_POST['contato_cargo'];
    $contato_email = $_POST['contato_email'];
    $contato_telefone = $_POST['contato_telefone'];
    $apont_tipo = $_POST['apont_tipo'];
    $apont_area = $_POST['apont_area'];
    $obs = $_POST['obs'];

    $empresa = $_SESSION['empresa'];

    $result_insert = pg_query($conexao, "INSERT INTO formulario 
    (empresa, cod_cliente, cliente_cpf_cnpj, cliente_nome, cliente_uf, cliente_municipio, cliente_endereco, cliente_bairro, cod_pedido, 
    cod_item_pedido, contato_nome, contato_cargo, contato_email, contato_telefone, apontamento_tipo, apontamento_area, observacao) 
    VALUES ('$empresa', '$cod_cliente', '$cliente_cpf_cnpj', '$cliente_nome', '$cliente_uf', '$cliente_municipio', '$cliente_endereco', 
    '$cliente_bairro', '$cod_pedido', '$cod_item_pedido', '$contato_nome', '$contato_cargo', '$contato_email', '$contato_telefone', 
    '$apont_tipo', '$apont_area', '$obs')");

    if (!$result_insert){
        echo '<script>
            window.alert("Algo deu errado, por favor contate o suporte para reportar este erro.")
        </script>';
    }else{
        echo '<script>window.alert("Dados salvos com sucesso!")
            window.location.href = "techto.php";
        </script>';
    };

?>