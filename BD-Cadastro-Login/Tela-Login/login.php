<?php
try{
    session_start();
    // abre a conexao
    $con = mysqli_connect("localhost","root","","bd_onpoint") or die ("erro de conechao");
    // puxa os dados de login
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $senha = mysqli_real_escape_string($con, $_POST["senha"]);
    
    // faz um select para ver se o usuario é existente
    $query_select = "SELECT * FROM USUARIO WHERE EMAIL = '$email' AND SENHA = '$senha';";
    $result = $con->query($query_select);
    // se for ele pega o id do usuario para manter logado
    if($result->num_rows >0){
        while($row = $result->fetch_assoc()) {
            $_SESSION["teste"] = $row['id'];
            header('location: /onPoint/BD-Cadastro-Login/home/index.html');
            
        }
    }
    else{
        // se n ele manda uma mensagem de erro
        echo "<script type='text/javascript'>alert('FALHA AO LOGAR! Email ou Senha INCORRETOS!');";
        echo "javascript:window.location='./index.html';</script>";
    }


}
catch (Exception $ex)
{
    // caso alogo de errado o try age
    echo "<br>" . $ex->getMessage();
}
?>

