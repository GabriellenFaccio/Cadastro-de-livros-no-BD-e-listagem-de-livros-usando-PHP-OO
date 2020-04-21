<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";

	if(!$_REQUEST['txtTitulo'] == ""){ 
		
		$Titulo = $_POST['txtTitulo'];
		$Autor = $_POST['txtAutor'];
		$Categoria = $_POST['txtCategoria'];

		//cria o objeto e cadastra no banco
		$Livro1 = new Livros;
		$Livro1->cadastraLivros($conn,$Titulo,$Autor,$Categoria);
		//$Livro1->resgataLivros($conn);
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
				<option value="Suspense"> Suspense </option>
				<option value="Romance"> Romance </option>
				<option value="Ficcao"> Ficcao </option>
				<option value="Infantil"> Infantil </option>
			</select>

		<br><br>
		<button id="btnCadastrar"> Inserir </button>
	</form>
</body>
</html>