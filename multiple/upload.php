<?php  
    // Nas versões do PHP que antecedem a versão 4.1.0, é preciso usar o $HTTP_POST_FILES em vez do $_FILES.

    $uploaddir = '../uploads/';
    $uploadfile = $_FILES['fileToUpload']['name']; 
           
    echo "<pre>";
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploaddir . $uploadfile)) {
          echo "O arquivo é valido e foi carregado com sucesso.\n";
   } else {
         echo "Algo está errado aqui!\n";
   }
          
   echo "Aqui estão algumas informações de depuração para você:";
   print_r($_FILES);
          
   print "</pre>";
 ?>