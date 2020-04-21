<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";
	
	$nomeP = "";
	$Livro1 = new Livros;
?>

<!DOCTYPE html>
<html>
<head>
	<title>**  Livraria  **</title>
</head>
<body>
	<form action="Consulta.php" method="POST">
		<button id="btnCadastra"><a href="index.php"> Cadastra </a></button>
		<button id="btnConculta"><a href="Consulta.php"> Consultar </a></button>
		<br><br>

		<label> Pesquisar : </label><input type="text" name="txtPesquisar" placeholder="Pesquisar">

		<br><br>
		<button id="btnProcurar"> Procurar </button>

		<br><br>

		<?php

		if(!$_REQUEST['txtPesquisar'] == "")
			$nomeP = $_POST['txtPesquisar'];
		
			$Livro1->resgataLivros($conn, $nomeP);
		?>
	</form>
</body>
</html>