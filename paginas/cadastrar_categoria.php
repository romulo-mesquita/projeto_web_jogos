
<br><br><br><br>
<?php
    if(!isset($_SESSION["nome"])){
        header('Location: ?pg=login/formulario');
    }
    $sqlCategorias = "SELECT * FROM categoria c";
    $resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);

    if(!empty($_POST)){
        
        $nome = $_POST["nome"];              

        # Insert no banco de dados
        $stmt = $conn->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

        $bind_param = ["nome" => $nome];

        try {
            $conn->beginTransaction();
            $stmt->execute($bind_param);
            echo '<div class="alert alert-success" role="alert">
                    Categoria inserida com sucesso!
                </div>';
            ?>
            
            <script>
                setTimeout(function() {
                    window.location.href = "?pg=cadastrar_categoria";
                }, 1000);
            </script>
            <?php
            $conn->commit();
        } catch(PDOExecption $e) {
            $conn->rollback();
            echo '<div class="alert alert-danger" role="alert">Erro ao inserir no banco: ' . $e->getMessage() . '</div>';
        } 
        
    
        

        
        // header('Location: ?pg=cruds/listar');

    }


?>

<br><br>   
<section class="page-section" id="contact">
    <div class="container">
        
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cadastrar Categoria</h2>
        
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">                
                <form id="contactForm" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Insira seu nome..." data-sb-validations="required" required/>
                        <label for="name">Nome</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">O campo de nome é obrigatório.</div>
                    </div>                    
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Categorias já cadastradas</h2>                
                <ul class="list-group">
                <?php
                    while($linha = $resultCategorias->fetch()){
                ?>
                        <li class="list-group-item"><?= $linha["Nome"] ?></li>
                <?php 
                    } 
                ?>
                </ul>
            </div>
        </div>
    </div>
</section>