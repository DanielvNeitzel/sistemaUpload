<?php
session_start();

$dir = 'uploads/';

$arquivo = $_GET['arquivo'];

$delArquivo = $dir.$arquivo;

if (unlink($delArquivo))
{
	$retorno=true;
}
else
{
	$retorno=false;
}
echo $retorno;

?>