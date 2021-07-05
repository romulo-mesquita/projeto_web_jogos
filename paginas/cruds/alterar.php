<br><br><br><br>
<?php
    
    if(!isset($_SESSION["nome"])){
        header('Location: ?pg=login/formulario');
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM jogo j WHERE j.id =". $id;        
    $result = $conn->query($sql, PDO::FETCH_ASSOC);
    
    $sqlCategorias = "SELECT * FROM categoria c";
    $resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);

    $sqlJogoCategorias = "SELECT * FROM jogo_categoria jc
        WHERE fk_jogo = " .$id;
    $resultJogoCategorias = $conn->query($sqlJogoCategorias, PDO::FETCH_ASSOC);

    if(!empty($_POST)){        
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];        
        $categorias = $_POST["categoria"];
        
        if($_FILES["foto"]['name'] != ""){
            $extensao = strtolower(substr($_FILES["foto"]['name'], -4)); //pega a extensao do arquivo
            $target_path="uploads/";
            $novo_nome = md5(time()) . $extensao; //define o nome do arquivo
            $target_path=dirname(__DIR__)."/".$target_path.$novo_nome;
            
            $caminhoBanco = "paginas/uploads/".$novo_nome;
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_path);  
            # Insert no banco de dados
            $stmt = $conn->prepare("UPDATE jogo set nome = :nome, descricao = :descricao,  imagem = :foto WHERE jogo.id =".$id );

            $bind_param = ["nome" => $nome, "descricao" => $descricao, "foto" => $caminhoBanco];
            // print_r();
            if (!unlink($_SESSION["caminho"]))
            {
            echo ("Erro ao alterar". $_SESSION["caminho"]);
            }
            else
            {
            echo ("Arquivo alterado com sucesso!");
            }
        }
        else{
            $stmt = $conn->prepare("UPDATE jogo set nome = :nome, descricao = :descricao");

            $bind_param = ["nome" => $nome, "descricao" => $descricao];
        }
        try {            
            $stmt->execute($bind_param);
            echo '<div class="alert alert-success" role="alert">Registro alterado com sucesso!</div>';
        } catch(PDOExecption $e) {
            $conn->rollback();
            echo '<div class="alert alert-danger" role="alert">Erro ao alterar registro no banco: ' . $e->getMessage() . '</div>';
        }
        if ($categorias != []){
            while($linha2 = $resultJogoCategorias->fetch()){
                $sqlDelet = $conn->prepare("DELETE FROM jogo_categoria WHERE fk_jogo =".$id);
                $sqlDelet->execute();
                
                // $aux2 = 0;
                // foreach ($categorias as $c){
                //     if($linha2["fk_categoria"] == $c ){
                //         $aux2 = 1;
                //     }
                // }
                // if($aux2 == 0){
                //     $sqlDelet = $conn->prepare("DELETE FROM jogo_categoria WHERE id =".$linha2['id']);
                //     $stmt->execute();
                // }
            }
            foreach ($categorias as $c){
                $stmt = $conn->prepare("INSERT INTO jogo_categoria (fk_jogo, fk_categoria) VALUES (:fk_jogo, :fk_categoria)");

                $bind_param = ["fk_jogo" => $id, "fk_categoria" => $c];
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
    }    
?>

 
<section class="page-section" id="contact">
    <div class="container">
        
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Editar Jogo</h2>
        
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">                
                <form id="contactForm" method="POST" enctype="multipart/form-data">
                <?php
                    while($linha1 = $result->fetch()){
                        $_SESSION["caminho"] = $linha1["Imagem"];
                ?>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="nome" value="<?=$linha1['Nome']?>" name="nome" type="text" placeholder="Insira seu nome..." data-sb-validations="required" required/>
                            <label for="name">Nome</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">O campo de nome é obrigatório.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control"  id="descricao" name="descricao" type="text" placeholder="Informe a descricação do jogo..." style="height: 10rem" data-sb-validations="required" required><?= $linha1["Descricao"]?></textarea>
                            <label for="message">Descrição</label>
                            <div class="invalid-feedback" data-sb-feedback="descricao:required">O campo de descricao é obrigatório.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="categoria">Categorias</label>
                            <select class="form-select" id="categoria" name="categoria[]" multiple="multiple">                        
                            <?php
                                while($linha = $resultCategorias->fetch()){
                                    // $aux = 0;
                                    // while($linha2 = $resultJogoCategorias->fetch()){
                                    //     if($linha2["fk_categoria"] == $linha["id"]){
                                    //         $aux = 1;
                                    //         break;
                                    //     }
                                    // }
                                    // if($aux == 0){
                            ?>
                                    <option value="<?= $linha["id"] ?>"><?= $linha["Nome"] ?></option>
                            <!-- <?php
                                    // }
                                    // else{
                                        
                            ?> -->
                                    
                            <?php
                                    // } 
                                } 
                            ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="foto">Imagem do Jogo</label><br>
                            <input type="file" class="form-control-file" name="foto" id="foto">
                        </div>
                <?php
                    }
                ?>
                    <!-- <div class="form-group mb-3">
                        <label class="form-label" for="foto">Imagem do Jogo</label><br>
                        <input type="file" class="form-control-file" name="foto" id="foto" required>
                    </div> -->
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>