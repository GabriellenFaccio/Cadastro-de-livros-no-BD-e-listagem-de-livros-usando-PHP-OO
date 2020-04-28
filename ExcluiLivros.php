<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";

	$minhaConexao = new Conexao("localhost", "livraria", "root", "");
	$minhaConexao->setTable('livros_3');
	$excluiLivro = new Livros;


	$idLivro = filter_input(INPUT_GET, 'idLivro');
	$excluiLivro->excluiLivros($minhaConexao->iniciaConexao(), $idLivro);

	header("Location: Consulta.php");

?>