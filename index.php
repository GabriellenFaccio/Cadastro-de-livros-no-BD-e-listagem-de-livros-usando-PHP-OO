<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";


	$minhaConexao = new Conexao("localhost", "livraria", "root", "");
	$minhaConexao->setTable('livros_3');


	if(!filter_input(INPUT_POST, 'txtTitulo') == ""){ 
		
		$Titulo = filter_input(INPUT_POST, 'txtTitulo');
		$Autor = filter_input(INPUT_POST, 'txtAutor');
		$Categoria = filter_input(INPUT_POST, 'txtCategoria');

		//Cria um objeto e passar pelo método construtor
		$novoLivro = new Livros($Titulo,$Autor,$Categoria);
		$novoLivro->cadastraLivros($minhaConexao->iniciaConexao());	
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>**  Livraria  **</title>
</head>
<body>
	<form action="index.php" method="POST">
		<button id="btnCadastra"><a href="index.php"> Cadastra </a></button>
		<button id="btnConculta"><a href="Consulta.php"> Consultar </a></button>
		
		<br><br>

		<label> Titulo : </label><input type="text" name="txtTitulo">
		<label> Autor : </label><input type="text" name="txtAutor">

		<label> Categoria :  </label>
			<select name='txtCategoria'>
				<option value="Suspense" > Suspense </option>
				<option value="Romance"> Romance </option>
				<option value="Ficcao"> Ficcao </option>
				<option value="Infantil" selected="true"> Infantil </option>
			</select>

		<br><br>
		<button id="btnCadastrar"> Inserir </button>
	</form>
</body>
</html>