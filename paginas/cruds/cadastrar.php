
<br><br><br><br>
<?php
    if(!isset($_SESSION["nome"])){
        header('Location: ?pg=login/formulario');
    }
    $sqlCategorias = "SELECT * FROM categoria c";
    $resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);

    if(!empty($_POST)){
        
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];        
        $categorias = $_POST["categoria"];        
        
    
        $extensao = strtolower(substr($_FILES["foto"]['name'], -4)); //pega a extensao do arquivo
        $target_path="uploads/";
        $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
        $target_path=dirname(__DIR__)."/".$target_path.$novo_nome;
        
        $caminhoBanco = "paginas/uploads/".$novo_nome;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_path);        

        # Insert no banco de dados
        $stmt = $conn->prepare("INSERT INTO jogo (nome, descricao, imagem) VALUES (:nome, :descricao, :foto)");

        $bind_param = ["nome" => $nome, "descricao" => $descricao, "foto" => $caminhoBanco];

        try {
            $conn->beginTransaction();
            $stmt->execute($bind_param);
            echo '<div class="alert alert-success" role="alert">
                    Categoria inserida com sucesso!
                </div>';
            $id_jogo = $conn->lastInsertId();
            $conn->commit();
        } catch(PDOExecption $e) {
            $conn->rollback();
            echo '<div class="alert alert-danger" role="alert">Erro ao inserir no banco: ' . $e->getMessage() . '</div>';
        }
        
        if ($categorias){
            foreach ($categorias as $c){
                $stmt = $conn->prepare("INSERT INTO jogo_categoria (fk_jogo, fk_categoria) VALUES (:fk_jogo, :fk_categoria)");

                $bind_param = ["fk_jogo" => $id_jogo, "fk_categoria" => $c];
                try {
                    $conn->beginTransaction();
                    $stmt->execute($bind_param);                   
                    $conn->commit();
                } catch(PDOExecption $e) {
                    $conn->rollback();
                } 
            }
        }
        
        ?>
        <script>
            setTimeout(function() {
                window.location.href = "?pg=jogos";
            }, 1000);
        </script>
        <?php
        // header('Location: ?pg=cruds/listar');

    }


?>

<br><br>   
<section class="page-section" id="contact">
    <div class="container">
        
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cadastrar Jogo</h2>
        
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
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="descricao" name="descricao" type="text" placeholder="Informe a descricação do jogo..." style="height: 10rem" data-sb-validations="required" required></textarea>
                        <label for="message">Descrição</label>
                        <div class="invalid-feedback" data-sb-feedback="descricao:required">O campo de descricao é obrigatório.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="categoria">Categorias</label>
                        <select class="form-select" id="categoria" name="categoria[]" multiple="multiple">                        
                        <?php
                            while($linha = $resultCategorias->fetch()){
                        ?>
                            <option value="<?= $linha["id"] ?>"><?= $linha["Nome"] ?></option>
                        <?php 
                            } 
                        ?>
                        </select>
                    </div>                    
                    <div class="form-group mb-3">
                        <label class="form-label" for="foto">Imagem do Jogo</label><br>
                        <input type="file" class="form-control-file" name="foto" id="foto" required>
                    </div>
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>