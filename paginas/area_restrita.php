<?php

if(!isset($_SESSION["nome"])){
    header('Location: ?pg=login/formulario');
}
$sql = "SELECT * FROM contato c";        
$result = $conn->query($sql, PDO::FETCH_ASSOC);
?>

<br><br>
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">Área Restrita</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>            
        </div>
        <h2 class="page-section-heading text-center text-uppercase text-white">Lista de contatos recebidos</h2>
        <!-- About Section Content-->
        <div class="row bg-light">
        <table class="table">
            <thead>
                <tr>                
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Mensagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($linha = $result->fetch()){
                ?>
                    <tr>                    
                    <td><?= $linha["Nome"] ?></td>
                    <td><?= $linha["email"] ?></td>
                    <td>@<?= $linha["mensagem"] ?></td>                
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            </table>
        </div>        
    </div>
</section>