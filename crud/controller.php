<?php
require_once "Conexao.php";
class Controller
{

	private function __contruct(){}

		public static $instance;

		public static function getInstance()
		{
			if(!isset(self::$instance))
				self::$instance = new Controller();
	
			return self::$instance;
		}

	public function Index(){
		try
		{

		}catch(PDOException $e)
		{
			
		}
	}

	public function Lista(){
		$pdo = Conexao::getInstance();
		try{
        $consulta = $pdo->query( 'SELECT * FROM contatos;' );

        /*while( $linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "Nome:<br>";
		}	*/
		
		return $consulta;
		
        } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();

        }
	}

	public function Get($id){
		$pdo = Conexao::getInstance();
		try{
        $consulta = $pdo->query( 'SELECT * FROM contatos WHERE id ='.$id );

		return $consulta;
		
        } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();

        }
	}

	public function Create($dados){
		$pdo = Conexao::getInstance();

        try{
           $stmt = $pdo->prepare( 'INSERT INTO contatos (nome, email, celular) VALUES (:nome, :email, :celular)' );
        $stmt->execute( array(
            ':nome' => ''.$dados["nome"].'',
            ':email' => ''.$dados["email"].'',
            ':celular' => ''.$dados["celular"].''
        )); 
		header("Location:index.php");
        //echo $stmt->rowCount(); 
        } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();

        }
	}

	public function Delete(){
		$id = 1;
        try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare( 'DELETE FROM contatos WHERE id = :id' );
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo $stmt->rowCount();
        } catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }
	}

	public function Update($dados){
		try{
            $pdo = Conexao::getInstance();

            $stmt = $pdo->prepare( 'UPDATE contatos SET nome = :nome WHERE id = :id' );
            $stmt->execute( array( 
                ':id' => $dados["id"],
                ':nome' => $dados["nome"]
            ) );
            
            echo $stmt->rowCount();
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
    
        }
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $Controller = new Controller;
	
	if(isset($_POST['update']))
	{
		$Controller->Update($_POST);
	}else if(isset($_POST['Add'])){
		
	$Controller->Create($_POST);
	}
}

?>