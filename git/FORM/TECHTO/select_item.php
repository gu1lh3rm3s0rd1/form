<?php
  //banco de dados
  include 'con-techto.php';
                                        
  $categoria = $_GET['pedido'];

  $query = $conn->prepare("
  SELECT p.DESCRICAO AS DESCRICAO
  FROM AVEC85IT ipv 
  INNER JOIN ACEC1101 p ON ipv.codigo = p.codigo 
  WHERE ipv.NUMERO_PEDIDO = :NUMERO_PEDIDO");

  $data = ['NUMERO_PEDIDO' => $categoria];
  $query->execute($data);

  $registros = $query->fetchAll(PDO::FETCH_ASSOC);

  //echo '<option value="">SELECIONE UMA SUBTCHEBA</option>';

  foreach($registros as $option) {
  ?>
      <option value="<?php echo $option['DESCRICAO']?>"><?php echo $option['DESCRICAO']?></option>
  <?php
  }

?>