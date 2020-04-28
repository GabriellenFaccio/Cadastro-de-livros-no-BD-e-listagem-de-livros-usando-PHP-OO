<?php
	
	class Conexao
	{
		private $dbHost;
		private $dbName;
		private $dbUser;
		private $dbPass;
		private $table;

		public  $conexao;


		public function __construct($ipServidor, $nomeBanco, $usuarioBanco, $senhaBanco)
		{
			$this->dbHost = $ipServidor;
			$this->dbName = $nomeBanco;
			$this->dbUser = $usuarioBanco;
			$this->dbPass = $senhaBanco;
		}


		public function setTable(string $tableName)
		{

			$this->table = $tableName;
		}


		public function iniciaConexao()
		{
			$this->conexao = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}",$this->dbUser,$this->dbPass);

			return $this;
		}


		public function encerraConexao()
		{

		}

	
		public function getTable()
		{
			$select = $this->conexao->query("SELECT * FROM {$this->table}");
			$result = $select->fetchAll();

			return $result;
		}


		public function getOneTable($colunaProcurada, $palavraProcurada)
		{
			$select = $this->conexao->query("SELECT * FROM {$this->table} WHERE $colunaProcurada LIKE '%$palavraProcurada%'");
			$result = $select->fetchAll();

			return $result;
		}


		//insere apenas 1 no banco, usado no salvar do edição
		public function updateOneBanco( $identificador, $valores)
		{

			$update = $this->conexao->query("UPDATE {$this->table} SET $opcao = \"$newTitulo\" WHERE id = $idFixo");
			$update->execute();

		}


		public function updateOnBanco($dataUpdate, $dataCondicao)
		{
			//$dataU : É meu objeto pronto para update
			//$dataC : É apenas o id do meu objeto
			
			$queryUpdate = "UPDATE {$this->table} SET ";
			
			// conta quantos itens tem no array
			$countData = count((array)$dataUpdate);
			
			foreach ($dataUpdate as $key => $value) {
				//pega a chave e valor do array, tipo: titulo - livro 1
				$queryUpdate .= "{$key} = '{$value}'";
				$countData--;
				//aqui ele vai ver se o número de itens é igual a 0, se não for quer dizer que tem mais, então coloca ,
				$queryUpdate .= ($countData == 0 ? "" : ", ");
			}

			//array_keys: esta pegando a palavra id, e o values o valor de id, como DataC só tem 1 casa por isso é 0
			$queryUpdate .= " WHERE " .  array_keys($dataCondicao)[0] . " = " . array_values($dataCondicao)[0];


			$update = $this->conexao->query($queryUpdate);
		}


		public function insereBanco($dataInsert)
		{
			//Como eu não tenho um Where, não preciso de condição.

			$queryInsert = "INSERT INTO {$this->table} (";

			$countArrays = count((array)$dataInsert);

			foreach ($dataInsert as $key => $value) {
				
				$queryInsert .= "{$key}";
				$countArrays--;
				$queryInsert .= ($countArrays == 0 ? ") VALUES ( " : ", "); 
			}

			$countArrays = count((array)$dataInsert);

			foreach ($dataInsert as $key => $value) {
				
				$queryInsert .= ":{$key}";
				$countArrays--;
				$queryInsert .= ($countArrays == 0 ? ")" : ", ");
			}

			$insert = $this->conexao->prepare($queryInsert);

			foreach ($dataInsert as $key => $value) {
				$insert->bindValue(":{$key}", $value);
			}
			print_r($queryInsert);

			$insert->execute();

			//funcao do PDO para debugar o objeto: $objeto->debugDumpParams();
			
		}


		public function deleteOneBanco($id)
		{
			$delete = $this->conexao->query("DELETE FROM {$this->table} WHERE id = $id");
		}

}