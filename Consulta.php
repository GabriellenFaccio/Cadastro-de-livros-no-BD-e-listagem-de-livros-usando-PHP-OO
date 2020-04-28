<?php
	include_once "Classes/Conexao.class.php";
	include_once "Classes/Livros.class.php";
	
	$minhaConexao = new Conexao("localhost", "livraria", "root", "");
	$minhaConexao->setTable('livros_3');

	$novoLivro = new Livros;

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
	<button id="btnCadastra"><a href="index.php"> Cadastra </a></button>
	<button id="btnConculta"><a href="Consulta.php"> Consultar </a></button>

	<hr>

	<form action="Consulta.php" method="POST">
		<label> Opções :  </label>
			<select name='txtOpcao'>
				<option value="id"> Id </option>
				<option value="titulo"> Titulo </option>
				<option value="autor"> Autor </option>
				<option value="categoria"> Categoria </option>
			</select>
		<label> Pesquisar : </label><input type="text" name="txtPesquisar" placeholder="Pesquisar">
		<input type="submit" name="btnProcurar" value="Procurar">
	</form>

	<hr>

	<table border="1">
		<?php 
			// comparandose o botao pesquisar esta preenchido
			if(!filter_input(INPUT_POST, 'txtPesquisar') == ""){
				$pesquisado = filter_input(INPUT_POST, 'txtPesquisar');
				$opcao = filter_input(INPUT_POST, 'txtOpcao');

				//enviando dados para "conexao", como a minha tabela e a palavra
				$allLivros = $novoLivro->pesquisar($minhaConexao->iniciaConexao(), $opcao, $pesquisado);
			}else{
				//caso nao tenha nada, é para mostrar todos os cadastrados
				$opcao = "titulo";
				$allLivros = $novoLivro->allLivros($minhaConexao->iniciaConexao());
			}

			//independente de qual acima seja, ele vai printar da mesma forma.
			foreach ($allLivros as $key => $value) {
				//tr: linha      td:coluna
				echo "
					<tr>
						<td>{$value['titulo']}</td>
						<td>{$value['autor']}</td>
						<td>{$value['categoria']}</td>
						<td><a name='btnEditar' href=\"EditarLivros.php?idLivro={$value['id']}\"> Editar </a></td>
						<td><a name='btnExcluir' href=\"ExcluiLivros.php?idLivro={$value['id']}\"> Excluir </a></td>
					</tr>";
			}
		?>
	</table>
</body>
</html>