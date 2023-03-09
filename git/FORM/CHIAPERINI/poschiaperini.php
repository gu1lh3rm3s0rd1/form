<?php 
  session_start();

  if (!isset( $_SESSION['empresa'])){
    header('index.php');

  }

  //chama conexao com banco de dados
  include 'con-chiaperini.php';

  //seleciona os dados através do input com nome 'codigo' e retorna como array
  if (!isset($_POST['contato_nome'])){
    $_POST['contato_nome'] = "";

  }

  if (!isset($_POST['contato_cargo'])){
    $_POST['contato_cargo'] = "";

  }

  if (!isset($_POST['contato_email'])){
    $_POST['contato_email'] = "";

  }

  if (!isset($_POST['contato_telefone'])){
    $_POST['contato_telefone'] = "";

  }

  if (!isset($_POST['apont_tipo'])){
    $_POST['apont_tipo'] = "";

  }

  if (!isset($_POST['apont_area'])){
    $_POST['apont_area'] = "";

  }

  if (!isset($_POST['obs'])){
    $_POST['obs'] = "";

  }

  //Oculta erros de código nos campos do input
  error_reporting(0);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>PÓS VENDA</title>

  <!-- lib´s bootstrap/javascript -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <!-- Faixa azul e logo no topo -->
  <header class="top auto ctr">
    <img class="ctr" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px; margin-top: 0; margin-bottom: 0rem;">PÓS VENDA CHIAPERINI</p>
  </header>
</head>

<!-- formulario para consultar cliente -->
<form action="" method="get">
  <?php
    try{
      //acessa o banco de dados
      include 'con-chiaperini.php';

      $sql = $_GET['id'];
      //$_GET['id'];
                              
      $query = "SELECT A1_COD CODIGO_CLIENTE, A1_CGC CGC_CNPJ, A1_NOME NOME, A1_MUN CIDADE, A1_EST ESTADO, A1_END ENDERECO, A1_BAIRRO BAIRRO
      FROM SA1010 
      WHERE A1_COD = '$sql'";

      foreach($conn->query($query)as $row){
                                
        //armazenando as colunas necessarias do banco em variaveis
        $cod = $row['CODIGO_CLIENTE'];
        $cod_cli = $row['CODIGO_CLIENTE'];
        $nome = $row['NOME'];
        $cpf = $row['CGC_CNPJ'];
        $endereco = $row['ENDERECO'];
        $cidade = $row['CIDADE'];
        $estado = $row['ESTADO'];
        $bairro = $row['BAIRRO'];

      }

      //retorna dados formatados para cpf/cnpj
      include 'format.php';

      $cnpj = "$cpf";
      //echo "CNPJ Formatado: ".formata_cpf_cnpj($cnpj);

                          
    }catch(PDOException $e){
        echo $e->getMEssage();

    }
    
  ?>
</form>

<!-- Adequa em uma main para responsividade -->
<main>
    <body class="claro">
      <form action="submit.php" method="post">
        <div class="mg">
          <h1 style="margin:15px; font-size: 22px;">CLIENTE</h1>
        </div>

        <div class="flex">
          <div class="box1">
            <label for="codigo">Cliente: </label>
            <input class="info-codigo" id="codigo" style="opacity: 0.7;" required type="text" readonly name="codigo" value="<?php echo utf8_encode($cod_cli); ?>" placeholder="Código">
          </div>

          <div class="box2">
            <label for="cnpj">CPF/CNPJ: </label>
            <input class="info-cnpj" id="cnpj" style="opacity: 0.7;" type="text" name="cnpj" readonly value="<?php echo formata_cpf_cnpj($cnpj); ?>" placeholder="CPF/CNPJ">
          </div>

          <div class="box3">
            <label for="nome" style="margin-left: 15px;">Nome: </label>
            <input class="info-nome" id="nome" style="opacity: 0.7;" type="text" name="nome" readonly value="<?php echo utf8_encode($nome); ?>" placeholder="Nome">
          </div>

          <div class="box7">
            <label for="estado" style="margin-left: 15px;">UF: </label>
            <input class="info-estado" id="estado" style="opacity: 0.7;" type="text" name="estado" readonly value="<?php echo utf8_encode($estado); ?>" placeholder="Estado">
          </div>
        </div>
        <br>

        <div class="flex">
          <div class="box4">
              <label for="end">Endereço: </label>
              <input class="info-end" type="text" id="endereco" style="opacity: 0.7;" name="endereco" readonly value="<?php echo utf8_encode($endereco); ?>" placeholder="Endereço">
          </div>

          <div class="box5">
            <label for="bairro">Bairro: </label>
            <input class="info-bairro" id="bairro" style="opacity: 0.7;" type="text" name="bairro" readonly value="<?php echo utf8_encode($bairro); ?>" placeholder="Bairro">
          </div>

          <div class="box6">
            <label for="mun">Município: </label>
            <input class="info-municipio" id="municipio" style="opacity: 0.7;" type="text" name="municipio" readonly value="<?php echo utf8_encode($cidade); ?>" placeholder="Município" >
          </div>
        </div>
        <br><br><br>

        <div class="mg2">
          <h1 style="margin:15px; font-size: 22px;">PEDIDO</h1>
        </div>

        <div class="flex">
          <div class="box8">
            <label for="pedido">Pedido: </label>
            <select class="info-pedido" id="pedido" name="pedido">
              <option value="">Selecione</option>
                <?php
                  try{
                    //acessa o banco de dados
                    include 'con-chiaperini.php';

                    $sql = $conn->query("
                    SELECT DISTINCT(C6_NUM) C6_NUM FROM SC6010
                    INNER JOIN SC5010 ON C6_FILIAL = C5_FILIAL AND C6_NUM = C5_NUM AND SC5010.D_E_L_E_T_ = ' ' AND SC6010.D_E_L_E_T_ = ' '
                    INNER JOIN SF4010 ON F4_CODIGO = C6_TES AND SF4010.D_E_L_E_T_ = ' '
                    WHERE C5_FILIAL = '01' AND F4_DUPLIC = 'S' AND C5_TIPO = 'N' AND C6_BLQ <> 'R' AND C6_CLI = '$cod'
                    ORDER BY C5_EMISSAO DESC FETCH FIRST 5 ROWS ONLY
                    "); 

                    $registros = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($registros as $option) {
                        //$op = $option['funcionario'];
                ?>
                      <option value="<?php echo $option['C6_NUM'];?>"><?php echo $option['C6_NUM'];?></option>
                <?php
                      }

                    }catch(PDOException $e){
                      echo $e->getMEssage();
              
                  }

                ?>
            </select>
          </div>

          <div class="box9">
            <label for="desc">Pedido Item: </label>
            <select name="desc" class="info-pedido-item" id="desc">
              <option value="">Selecione</option>
                <!--?php
                  try{
                    $NOMENCLATURA = $conn->prepare("SELECT ACEC1101.DESCRICAO AS DESCRICAO
                    FROM AUGC0301 
                    INNER JOIN AVEC8501 ON (AVEC8501.CODIGO_CLIENTE = AUGC0301.CODIGO_CLIENTE)
                    INNER JOIN AVEC85IT ON (AVEC85IT.NUMERO_PEDIDO = AVEC8501.NUMERO_PEDIDO)
                    INNER JOIN ACEC1101 ON (ACEC1101.CODIGO = AVEC85IT.CODIGO)
                    WHERE AUGC0301.CODIGO_CLIENTE = '$cod'");
                    $NOMENCLATURA->execute();
                    $NC = $NOMENCLATURA->fetchAll(PDO::FETCH_OBJ);
            
                    foreach ($NC as $row) {
                        $NAMED = "{$row->DESCRICAO}";
                        $selected =  ($desc == utf8_encode($NAMED)) ? 'selected' : '';

                        echo '<option value="'.utf8_encode($NAMED).'"'.$selected.'>'.'PEDIDO - '.$PED.' - '. utf8_encode($NAMED) .'</option>';
    
                    }
                                            
                  }catch(PDOException $e){
                    echo $e->getMEssage();
                  
                  }
                  
                ?-->
            </select>
          </div>

          <!-- select do produto dos pedidos -->
          <script type="text/javascript">
            let selectCod = document.getElementById('pedido');

            selectCod.onchange = () => {
                let selectItem = document.getElementById('desc');
                let valor = selectCod.value;

                fetch('select_item.php?pedido=' + valor)
                    .then(
                        response => {
                            return response.text();
                        }
                    )
                    .then(
                        texto => {
                          selectItem.innerHTML = texto;
                        }
                    );
            }

          </script>

        </div>
        <br><br><br>

        <div class="mg3">
          <h1 style="margin:15px; font-size: 22px;">CONTATO</h1>
        </div>

        <div class="flex">
          <div class="box10">
            <input class="info-contato" required id="contato_nome" type="text" name="contato_nome" placeholder="Nome">
          </div>

          <div class="box11">
            <input class="info-contato" required id="contato_cargo" type="text" name="contato_cargo" placeholder="Cargo">
          </div>

          <div class="box12">
            <input class="info-contato" required id="contato_email" type="text" name="contato_email" placeholder="E-mail">
          </div>

          <div class="box13">
            <input class="info-contato" required id="contato_telefone" type="text" name="contato_telefone" placeholder="Telefone">
          </div>
        </div>
        <br><br><br>

        <div class="mg4">
          <h1 style="margin:15px; font-size: 22px;">APONTAMENTO</h1>
        </div>

        <div class="flex">
          <div class="box14">
            <label for="ot">Tipo: </label>
            <select class="info-tipo" name="apont_tipo" id="apont_tipo">
              <option value="SUGESTÃO">SUGESTÃO</option>
              <option value="RECLAMAÇÃO">RECLAMAÇÃO</option>
            </select>

            <select class="info-tipo" name="apont_area" id="apont_area">
              <option value="TRANSPORTADORA">TRANSPORTADORA</option>
              <option value="PEDIDO">PEDIDO</option>
            </select>
          </div>
        </div>
        <br>

        <div class="obs">
          <textarea class="observacao" style="resize: none" required type="text" class="sugestão" name="obs" id="obs" placeholder="Observação"></textarea>
        </div>
        <br>

        <!-- botao salvar cancelar, encerra sessao e retorna ao index -->
        <script language=javascript>
          function confirmacao(){
            if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
              window.location.href = "/teste/index.php";
          }

        </script>

        <!-- botao salvar adequado dentro de uma div para ser orientado a esquerda da pagina -->
        <div class="tirex">
          <div class="archivedy" onclick="return confirmacao();">CANCELAR</div>
          <button class="archive" type="submit">SALVAR</button>
        </div>
      </form>
    </body>
</main>
</html>