<?php

	class Livros{

		public $titulo;
		public $autor;
		public $categoria;
		//public $livroEdicaoT;


		public function __construct($tituloLivro = null, $autorLivro = null, $categoriaLivro = null, $idLivro = null)
		{
			$this->titulo 		= $tituloLivro;
			$this->autor  		= $autorLivro;
			$this->categoria 	= $categoriaLivro;
			$this->id			= $idLivro;
			//$this->livroEdicaoT = "Primeira";
		}


		public function cadastraLivros($minhaConexao)
		{

			$minhaConexao->insereBanco($this);
		}


		//faz o updade quando é feito a edicao
		public function updateLivro($minhaConexao)
		{
		
			$minhaConexao->updateOnBanco($this, ['id' => $this->id]);

		}


		public function allLivros($minhaConexao)
		{
			$result = $minhaConexao->getTable();

			return $result;
		}


		public function editaLivro($minhaConexao, $opcao, $idEdit)
		{
			$result = $minhaConexao->getOneTable($opcao, $idEdit);
			return $result;
		}

		public function getOneLivro($minhaConexao, $coluna, $campo)
		{
			$result = $minhaConexao->getOneTable($coluna, $campo);
			
			$this->fillLivro($result[0]);

			return $this->getLivro();
		}


		public function salvar($action, $minhaConexao)
		{
			if ($action == 'edicao') {
				$this->updateLivro($minhaConexao);
			}
		}


		//Pesquisar por id, titulo, autor ou categoria
		public function pesquisar($minhaConexao, $opcao, $pesquisado)
		{
			$result = $minhaConexao->getOneTable($opcao, $pesquisado);

			return $result;
		}


		public function setEdLivro($livroEdicao)
		{

			$this->livroEdicaoT = $livroEdicao;
		}


		public function excluiLivros($minhaConexao, $idExcluir)
		{

			$minhaConexao->deleteOneBanco( $idExcluir);
		}

		private function fillLivro($data)
		{
			$this->id 			= $data['id'];
			$this->titulo 		= $data['titulo'];
			$this->categoria 	= $data['categoria'];
			$this->autor 		= $data['autor'];
		}

		private function getLivro()
		{
			return $this;
		}
	}