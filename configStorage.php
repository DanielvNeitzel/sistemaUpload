<?php
// DEFINIÇÕES
// Numero de campos de upload
$numeroCampos = 99;
// Tamanho máximo do arquivo (em bytes)
$tamanhoMaximo = 9999999999999; // 20MB
// Extensões aceitas
$extensoes = array(".mov", ".svg", ".jpeg", ".bmp", ".gif", ".png", ".jpg",".doc", ".txt", ".pdf", ".docx", ".psd", ".zip", ".sql", ".apk");
// Caminho para onde o arquivo será enviado
$caminho = 'uploads/';
// Substituir arquivo já existente (true = sim; false = nao)
$substituir = false;

for ($i = 0; $i < $numeroCampos; $i++) {

// Informações do arquivo enviado
  $nomeArquivo = $_FILES["arquivo"]["name"][$i];
  $tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
  $nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];

// Verifica se o arquivo foi colocado no campo
  if (!empty($nomeArquivo)) {

    $erro = false;

// Verifica se o tamanho do arquivo é maior que o permitido
    if ($tamanhoArquivo > $tamanhoMaximo) {
      $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
    } 
// Verifica se a extensão está entre as aceitas
    elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
      $erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
    } 
// Verifica se o arquivo existe e se é para substituir
    elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
      $erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
    }

// Se não houver erro
    if (!$erro) {
// Move o arquivo para o caminho definido
      move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
// Mensagem de sucesso
      header('Location: ./index.php');
    } 
// Se houver erro
    else {
// Mensagem de erro
      echo $erro . "<br />";
    }
  }
}
?>