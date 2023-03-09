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
    <img class="ctr" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px; margin-top: 0; margin-bottom: 0rem;">RELATÓRIO DE PÓS VENDA CHIAPERINI</p>
  </header>
</head>
<body style="background-color: #d8d8d8; ">
  <!-- card da pagina mostra caixa onde sao exibidos todos os clientes ja cadastrados na empresa -->
  <div class="cardd">
    <div style="display: flex; justify-content: center;">
      <p style="font-size: 25px; color: black;">LISTA DE CLIENTES</p>

      <form action="" aria-label="search" method="post">
        <div>
          <input type="text" aria-label="Realizar busca" autocomplete="off" name="id" id="id" value="" class="input" placeholder="Buscar Clientes" style="padding: 8px; margin-left: 15px;">
          <?php 
            try{
              //acessa o banco de dados
              include 'con-chiaperini.php';
                          
              $sql = "SELECT A1_COD FROM SA1010 
              WHERE SA1010.D_E_L_E_T_ = ' ' AND A1_FILIAL = '01'
              ORDER BY A1_COD ASC";

              foreach($conn->query($sql)as $row){
                                     
                //armazenando as colunas necessarias do banco em variaveis
                $CLIENTE = $row['A1_COD'];

              }

            } catch(PDOException $e){
              echo $e->getMEssage();

            }
                
            ?>
        </div>
      </form>
    </div>
    <br>

    <form method="get" class="scroll" style="border-color: black;">
      <table style="width: 99.9%;">
          <tr class="titulico">
            <th style="padding: 10px 20px;">CLIENTE</th>
            <th style="padding: 10px;">LOJA</th>
            <th style="padding: 10px;">NOME</th>
            <th style="padding: 10px;">LOCALIDADE</th>
            <th style="padding: 10px;">CPF/CNPJ</th>
            <th style="padding: 10px 20px;">DATA ULT. COMPRA</th>

            <?php
              try{
                //acessa o banco de dados
                include 'con-chiaperini.php';

                if (!isset($_POST['id'])){
                  $_POST['id'] = "";
              
                }

                $sql2 = $_POST['id'];

                if ($sql2 == '' or $sql2 == NULL){
                  //consulta devolve os 100 ultimos clientes cadastrados
                  $sql = "SELECT A1_COD CODIGO_CLIENTE, A1_LOJA LOJA, A1_CGC CGC_CNPJ, A1_NOME NOME, A1_MUN CIDADE, A1_EST ESTADO, A1_END ENDERECO, 
                  TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'DD') AS DIA, TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'MM') AS MES, 
                  TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'YYYY') AS ANO FROM SA1010 WHERE SA1010.D_E_L_E_T_ = ' ' AND A1_FILIAL = '01' 
                  ORDER BY A1_COD DESC FETCH FIRST 100 ROWS ONLY";

                } else{
                  //consulta devolve o cliente que o usuario desejar procurar
                  $sql = "SELECT A1_COD CODIGO_CLIENTE, A1_LOJA LOJA, A1_CGC CGC_CNPJ, A1_NOME NOME, A1_MUN CIDADE, A1_EST ESTADO, A1_END ENDERECO,
                  TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'DD') AS DIA, TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'MM') AS MES, 
                  TO_CHAR(TO_DATE(TRIM(A1_ULTCOM),'YYYYMMDD'),'YYYY') AS ANO FROM SA1010 WHERE SA1010.D_E_L_E_T_ = ' ' AND A1_FILIAL = '01' 
                  AND A1_COD = '$sql2' ORDER BY A1_COD DESC";

                }

                foreach($conn->query($sql)as $row){       
                  
                  //armazenando as colunas necessarias do banco em variaveis
                  $result = $row['CODIGO_CLIENTE'];
                  $CLIENTE = $row['CODIGO_CLIENTE'];
                  $LOJA = $row['LOJA'];
                  $NOME = $row['NOME'];
                  $DOC = $row['CGC_CNPJ'];
                  $ENDERECO = $row['ENDERECO'];
                  $CIDADE = $row['CIDADE'];
                  $ESTADO = $row['ESTADO'];
                  $DIA = $row['DIA'];
                  $MES = $row['MES'];
                  $ANO = $row['ANO'];
                  
                  $linked = $result;
                  $link2 = "href='poschiaperini.php?id=".$linked."'";

                 if ($sql2 == '' or $sql2 == NULL){
                    //consulta devolve os 100 ultimos clientes cadastrados
                    echo '
                    <tr style="padding: 10px 20px;" class="sim" onclick="location.'.$link2.'">
                      <td style="padding: 10px 20px;">'.$CLIENTE.'</td>
                      <td style="padding: 10px 20px;">'.$LOJA.'</td>
                      <td style="padding: 10px 20px;">'.utf8_encode($NOME).'</td>
                      <td style="padding: 10px 20px;">'.utf8_encode($ENDERECO) . '-' . utf8_encode($CIDADE) . '/' . utf8_encode($ESTADO) . '</td>
                      <td style="padding: 10px 20px;">'.$DOC.'</td>
                      <td style="padding: 10px 20px;">'. $DIA. '/' .$MES. '/' .$ANO.'</td>
                    </tr>    
                  ';
  
                  } else{
                    //consulta devolve o cliente que o usuario desejar procurar com os ultimos 5 pedidos
                    echo '
                    <tr style="padding: 10px 20px;" class="sim" onclick="location.'.$link2.'">
                      <td style="padding: 10px 20px;">'.$CLIENTE.'</td>
                      <td style="padding: 10px 20px;">'.$LOJA.'</td>
                      <td style="padding: 10px 20px;">'.utf8_encode($NOME).'</td>
                      <td style="padding: 10px 20px;">'.utf8_encode($ENDERECO) . '-' . utf8_encode($CIDADE) . '/' . utf8_encode($ESTADO) . '</td>
                      <td style="padding: 10px 20px;">'.$DOC.'</td>
                      <td style="padding: 10px 20px;">'. $DIA. '/' .$MES. '/' .$ANO.'</td>
                    </tr>    
                  ';

                  }
                }
                             
                if ($result == '' or $result == NULL){
                  echo '<script>
                            window.location.href = "/teste/index.php";
                        </script>';

                }                          
                        
              }catch(PDOException $e){
                echo $e->getMEssage();

              }
            ?>
      </table>
    </form>
    <br>

  </div>
  <br>

  <div class="flex ctr">
    <!-- botao voltar que direciona a pagina de escolha abrir uma nova ou consultar uma ordem de serviço -->
    <a href="/teste/index.php" class="novo">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 17">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg> VOLTAR
    </a>
  </div>
</body>
</html>