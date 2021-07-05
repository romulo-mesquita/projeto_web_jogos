<br><br><br><br>
<?php
// if(!isset($_SESSION["nome"])){
//     header('Location: ?pg=login/formulario');
// }
$sqlCategorias = "SELECT * FROM categoria c";
$resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);


if(!empty($_POST)){ 
    
    $nome = $_POST["nome"];
    $codigo = $_POST["codigo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];
    
    if($categoria != ""){
        $texto = "";
        foreach ($categoria as $c){
            if($texto){
                $texto = $texto."," .$c;
            }
            else{
                $texto = $c;
            }
        }        
        $sqlfiltro = "SELECT jc.fk_jogo FROM jogo_categoria jc WHERE fk_categoria IN (".$texto.")";
        
        $resultFiltro = $conn->query($sqlfiltro, PDO::FETCH_ASSOC);
        $lista = "";
        while($linha = $resultFiltro->fetch()){            
            if($lista){
                $lista = $lista."," .$linha["fk_jogo"];
            }
            else{
                $lista = $linha["fk_jogo"];
            }
        }
        if($codigo){
            $sql = "SELECT * FROM jogo j WHERE j.id =". $codigo."AND j.id IN (".$lista.")";        
            
        }
        elseif($nome){
            $sql = "SELECT * FROM jogo j WHERE j.Nome LIKE '%". $nome ."%' AND j.id IN (".$lista.")";
        }
        else{
            $sql = "SELECT * FROM jogo j WHERE j.Descricao LIKE '%". $descricao ."%' AND j.id IN (".$lista.")";
        }

    }
    else{
    
        if($codigo){
            $sql = "SELECT * FROM jogo j WHERE j.id =". $codigo;        
            
        }
        elseif($nome){
            $sql = "SELECT * FROM jogo j WHERE j.Nome LIKE '%". $nome ."%'";
        }
        else{
            $sql = "SELECT * FROM jogo j WHERE j.Descricao LIKE '%". $descricao ."%'";
        }
    }
    
    $result = $conn->query($sql, PDO::FETCH_ASSOC);
    $result2 = $conn->query($sql, PDO::FETCH_ASSOC);
    

}
else{
    $nome ="";
    $codigo ="";
    $descricao ="";
    $sql = "SELECT * FROM jogo j";        
    $result = $conn->query($sql, PDO::FETCH_ASSOC);
    $result2 = $conn->query($sql, PDO::FETCH_ASSOC);
}
?>
<!-- Portfolio Section-->

<section class="page-section portfolio" id="portfolio">
    <div class="container">
        
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Jogos</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <form id="contactForm" method="POST">
            <div class="row align-items-stretch mb12">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="codigo" name="codigo" value="<?= $codigo?>" type="text" placeholder="Pesquisar pro Codigo"/>
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="nome" name="nome" type="text" value="<?= $nome?>"  placeholder="Pesquisar por nome"/>                        
                    </div>                    
                </div>
                <br><br>
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="descricao" name="descricao" type="text" value="<?= $descricao?>"  placeholder="Pesquisar por descrição" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Pesquisar</button>
                </div>
                
            </div>
        
        
            <div class="row align-items-stretch mb12">
                <div class="col-md-6">                
                        <label class="form-label" for="categoria">Filtrar por categoria</label>
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
                
                <div class="col-md-6">
                    <br><br>
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
        <div class="row justify-content-center">
            <?php
                while($linha = $result->fetch()){
            ?>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#Modal_<?= $linha["id"]?>">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="<?=$linha['Imagem']?>" alt="..." />
                        </div>
                    </div>
            <?php
                }
            ?>
            
        </div>
    </div>
    
    <?php
        
        while($linha2 = $result2->fetch()){
    ?>      
            <div class="portfolio-modal modal fade" id="Modal_<?= $linha2["id"]?>" tabindex="-1" aria-labelledby="Modal_<?= $linha2["id"]?>" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                        <div class="modal-body text-center pb-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <!-- Portfolio Modal - Title-->
                                        <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?=$linha2['Nome']?></h2>
                                        <!-- Icon Divider-->
                                        <div class="divider-custom">
                                            <div class="divider-custom-line"></div>
                                            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
                                            <div class="divider-custom-line"></div>
                                        </div>
                                        <h5>Codigo do jogo:</h5>
                                        <p class="mb-4"><?=$linha2['id']?></p>
                                        <!-- Portfolio Modal - Text-->
                                        <h5>Descrição do jogo:</h5>
                                        <p class="mb-4"><?=$linha2['Descricao']?></p>
                                        <!-- Portfolio Modal - Image-->
                                        <img class="img-fluid rounded mb-5" src="<?=$linha2['Imagem']?>" alt="..." />
                                        <h5>Categorias</h5>
                                        <?php
                                            $sql = "SELECT c.Nome from categoria c 
                                            INNER JOIN  jogo_categoria jc 
                                            ON  jc.fk_categoria = c.id 
                                            and jc.fk_jogo =".$linha2["id"];        
                                            $result4 = $conn->query($sql, PDO::FETCH_ASSOC);
                                            while($linha3 = $result4->fetch()){
                                        ?>
                                            
                                            <span class="badge bg-secondary"><?=$linha3["Nome"]?></span>
                                            
                                        <?php
                                            }
                                            if(isset($_SESSION["nome"])){
                                        ?>  
                                            <br><br>
                                            <a class="btn btn-warning" href="?pg=cruds/alterar&id=<?=$linha2['id']?>">
                                                <i class="fas fa-times fa-fw"></i>
                                                Editar
                                            </a>
                                            <a class="btn btn-danger" href="?pg=cruds/excluir&id=<?=$linha2['id']?>">
                                                <i class="fas fa-times fa-fw"></i>
                                                Excluir
                                            </a>
                                        <?php 
                                            }
                                        ?>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>

</section>
