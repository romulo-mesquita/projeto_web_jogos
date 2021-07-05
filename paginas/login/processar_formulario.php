<?php

if(!empty($_POST)){
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if($email == "romulo.mesquita@unincor.edu.br" && md5($senha) == md5("123")){
        $_SESSION["nome"] = "Rômulo";

?>  
        <br><br><br>
        <div class="alert alert-success" role="alert">
            Login efetuado com sucesso!
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "?pg=area_restrita";
            }, 1000);
        </script>
<?php
    }
    else{
?>
        <div class="alert alert-danger" role="alert">>Dados inválidos! Tente novamente.</div>
        <p><a href="javascript:history.back();">Voltar</a></p>
<?php
    }
}
else{
    header("Location: ?pg=login/formulario");
}
?>
