<?php
try{
    session_start();
    // inicia a conexao
    $con = mysqli_connect("localhost","root","","bd_onpoint") or die ("erro de conechao");
    // pega os atribultos do novo usuario
    $nome = mysqli_real_escape_string($con, $_POST["nome"]);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);
    $csenha = mysqli_real_escape_string($con, $_POST['confSenha']);
    // n lembro o qq esse md5 faz :(
    md5($senha);
    // se a senha e a confirmacao for igual
    if($senha == $csenha){
        // faz um select para verificar se o email ja existe
        $query_select = "SELECT * FROM usuario where email = '$email';";

        $result = $con->query($query_select);
        
        if ($result->num_rows > 0) {
            // se existir da uma mensagem de erro
            while($row = $result->fetch_assoc()) {
                echo "<script type='text/javascript'>alert('FALHA AO CADASTRAR! Email ja existente!');";
                echo "javascript:window.location='/onPoint/BD-Cadastro-Login/Tela-Cadstro/index.html';</script>";
              }
            } else {
                // se n ele inser o usuario
                $query_insert = "INSERT INTO USUARIO VALUES(NULL,'$nome','$email','$senha')";
                $query_run = mysqli_query($con, $query_insert);
                
                if($query_run)
                {
                    // se inserir ele busca o email e pega o id do usuario para manter logado
                    $query_select = "SELECT * FROM usuario where email = '$email';";
                    $result = $con->query($query_select);
                    if($result->num_rows >0){
                        while($row = $result->fetch_assoc()) {
                            // por meio dessa session
                            $_SESSION["teste"] = $row['id'];
                            header('location: /onPoint/BD-Cadastro-Login/home/index.html');
                            
                        }
                    }
                    else{
                        // se n da uma mensagem de erro
                        echo "<script type='text/javascript'>alert('FALHA AO LOGAR! Email ou Senha INCORRETOS!');";
                        echo "javascript:window.location='./index.html';</script>";
                    }
                    
                } 
                else
                {
                    // aqui e se n cadastrar 
                    echo "<script type='text/javascript'>alert('FALHA AO CADASTRAR!');";
                echo "javascript:window.location='/onPoint/BD-Cadastro-Login/Tela-Cadstro/index.html';</script>";
                }
            }
    
        $con->close();
    }
    else{
        // aqui e se a confirmacao for diferente da senha
        echo "<script type='text/javascript'>alert('SENHA DIFERENTE DA CONFIRMACAO!');";
        echo "javascript:window.location='/onPoint/BD-Cadastro-Login/Tela-Cadstro/index.html';</script>";
    }
    
 
}
catch (Exception $ex)
{
    // SE ALGO DER ERRADO O TRY AGE
    echo "<br>" . $ex->getMessage();
}
    
    

?>