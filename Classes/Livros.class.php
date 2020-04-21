<?php

	class Livros{

		public function cadastraLivros($conn,$titulo,$autor,$categoria){
			$comando = $conn->prepare('INSERT INTO livros_3( titulo, autor, categoria) VALUES ( :titulo, :autor, :categoria)');

			$comando->bindValue(':titulo',$titulo);
			$comando->bindValue(':autor',$autor);
			$comando->bindValue(':categoria',$categoria);
			$comando->execute();
		}

		public function resgataLivros($conn, $nomeP){
			if($nomeP == "")
				$select = $conn->query("SELECT titulo FROM livros_3");
			else
				$select = $conn->query("SELECT titulo FROM livros_3 where titulo like '%$nomeP%'");


			while($row = $select->fetch()) {
			    //print_r($row);
			    echo $row['titulo']."<br>";

			}
		}
	}

?>