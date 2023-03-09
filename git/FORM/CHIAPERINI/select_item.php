<?php
  //banco de dados
  include 'con-chiaperini.php';
                                        
  $categoria = $_GET['pedido'];

  $query = $conn->prepare("
  SELECT B1_DESC FROM SB1010
  INNER JOIN SC6010 ON SB1010.B1_COD = SC6010.C6_PRODUTO
  WHERE SB1010.B1_FILIAL = '01' AND SB1010.D_E_L_E_T_ = ' ' AND SC6010.C6_NUM = :C6_NUM
  ");

  $data = ['C6_NUM' => $categoria];
  $query->execute($data);

  $registros = $query->fetchAll(PDO::FETCH_ASSOC);

  //echo '<option value="">SELECIONE UMA SUBTCHEBA</option>';

  foreach($registros as $option) {
  ?>
      <option value="<?php echo $option['B1_DESC']?>"><?php echo $option['B1_DESC']?></option>
  <?php
  }

?>