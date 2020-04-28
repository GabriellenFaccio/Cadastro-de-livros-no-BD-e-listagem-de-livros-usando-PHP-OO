<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";

	$minhaConexao = new Conexao("localhost", "livraria", "root", "");
	$minhaConexao->setTable('livros_3');
	

	$idLivro = filter_input(INPUT_GET, 'idLivro');
	
	$editLivro = new Livros;
	$editLivro->getOneLivro($minhaConexao->iniciaConexao(), "id", $idLivro);

	
	$opcao = filter_input(INPUT_GET, 'action');
	

	if ($opcao == 'editarLivro')  {

		$idLivro 		= filter_input(INPUT_POST, 'idLivro');
		$newTitulo 		= filter_input(INPUT_POST, 'txtEditT');
		$newAutor 		= filter_input(INPUT_POST, 'txtEditA');
		$newCategoria 	= filter_input(INPUT_POST, 'txtEditC');

		$editLivro = new Livros($newTitulo, $newAutor, $newCategoria, $idLivro);
		$editLivro->salvar('edicao', $minhaConexao->iniciaConexao());
		header("Location: Consulta.php");
		die;
	}

		$oneLivro = $editLivro->editaLivro($minhaConexao->iniciaConexao(), "id", $idLivro);




?>
<!DOCTYPE html>
<html>
<head>
	<title>**  Livraria  **</title>
	<style type="text/css">
		#btnEditar{
			margin-left: 70px;
			margin-right: 10px;
		}
	</style>
</head>
<body>
	
	<table border=1>
		<tr>
			<td></td>
			<td>ID</td>
			<td>TITULO</td>
			<td>AUTOR</td>
			<td>CATEGORIA</td>
		<tr>
			
		<?php
			foreach ($oneLivro as $key => $value) {
						//tr: linha      td:coluna
						echo "
							<tr>
								<td><label> Livro : </label>
								<td>{$value['id']}</td>
								<td>{$value['titulo']}</td>
								<td>{$value['autor']}</td>
								<td>{$value['categoria']}</td>
							</tr>";

				$tit = $value['titulo'];
				$aut = $value['autor'];
				$cat = $value['categoria'];
			}
		?>
	</table><br>
	
	<hr>

	<form action="EditarLivros.php?action=editarLivro" method="POST">
		<input type="hidden" name="idLivro" value="<?= $editLivro->id; ?>"></input>

		<p>
			<label>Titulo:</label>
			<input type="text" name="txtEditT" value="<?= $editLivro->titulo; ?>"></input>
		</p>
		

		<p>
			<label>Autor:</label>
			<input type="text" name="txtEditA" value="<?= $editLivro->autor; ?>"></input>
		</p>

		<p>
			<label> Categoria :  </label>
			<select name='txtEditC'>
				<option value="Suspense" <?=($editLivro->categoria == "Suspense")? "selected=\"true\"": "n"?>> Suspense </option>
				<option value="Romance" <?=($editLivro->categoria == "Romance")? "selected=\"true\"": "n"?>> Romance </option>
				<option value="Ficcao" <?=($editLivro->categoria == "Ficcao")? "selected=\"true\"": "n"?>> Ficcao </option>
				<option value="Infantil" <?=($editLivro->categoria == "Infantil")? "selected=\"true\"": "n"?>> Infantil </option>
			</select>
		</p>


		<p>
			<input type="submit" name="btnSalvar" value="Salvar">
			<a href="Consulta.php"> Voltar </a>
		</p>
	</form>

</body>
</html>
