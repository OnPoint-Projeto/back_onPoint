<?php
session_start();
// puxa a descricao do evento
$id_usuario = $_SESSION["teste"];
$con = mysqli_connect("localhost","root","","bd_onpoint") or die ("erro de conechao");
$evento = mysqli_real_escape_string($con, $_POST["evento"]);
$estilo = mysqli_real_escape_string($con, $_POST["estilo"]);
$horario = mysqli_real_escape_string($con, $_POST["horario"]);
$clima = mysqli_real_escape_string($con, $_POST["clima"]);
$descricao = mysqli_real_escape_string($con, $_POST["descricao"]);
$receptor = mysqli_real_escape_string($con, $_POST["receptor"]);

// confere se o email do receptor é valido
$query_select = "select * from usuario where email = '$receptor';";

$result = $con->query($query_select);
        // se funcionar ele cria o pedido se n, avisa que deu erro
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $receptor = $row['id'];
        $query_insert = "INSERT INTO ajudar VALUES
        (NULL,'$evento','$estilo','$horario','$clima','$descricao','$id_usuario','$receptor','$id_usuario');";
        $query_run = mysqli_query($con, $query_insert);
        if($query_run){
            // redirecionar para a home
            header('location: /onPoint/BD-Cadastro-Login/pedir_ajuda/index.html');
        }else{
            echo "<script type='text/javascript'>alert('falha ao enviar');";
            echo "javascript:window.location='./index.html';</script>";
        }
    }else{
        echo "<script type='text/javascript'>alert('usuario nao existente');";
        echo "javascript:window.location='./index.html';</script>";
    }

?>