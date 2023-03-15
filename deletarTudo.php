<?php

session_start();

$pasta = 'uploads/';

if(is_dir($pasta))
{
	$diretorio = dir($pasta);
	while($arquivo = $diretorio->read())
	{
		if(($arquivo != '.') && ($arquivo != '..'))
		{
			unlink($pasta.$arquivo);
			echo 'Arquivo '.$arquivo.' foi apagado com sucesso. <br />';
		}
	}
	$diretorio->close();
	header('Location:index.php');
	
	if (unlink($pasta.$arquivo))
{
	$retorno=true;
}
else
{
	$retorno=false;
}
echo $retorno;
	
}
else
{
	echo 'A pasta não existe.';
}
?>