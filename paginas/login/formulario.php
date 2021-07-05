<br><br><br><br>
<?php

if(isset($_SESSION["nome"])){
    header("Location: ?pg=area_restrita");
}

?>

   
<section class="page-section" id="contact">
    <div class="container">
        
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Login</h2>
        
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">                
                <form id="contactForm" method="POST" action="?pg=login/processar_formulario">                    
                    <div class="form-floating mb-3">
                        <label class="form-label" for="email">Email</label>
                        <br>
                        <input class="form-control" id="email" name="email" type="email" placeholder="nome@example.com" data-sb-validations="required,email" />
                        
                        <div class="invalid-feedback" data-sb-feedback="email:required">O campo de email e obrigatório.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email não é valido.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <label class="form-label" for="senha">Senha</label>
                        <br>
                        <input class="form-control" id="senha" name="senha" type="password" data-sb-validations="required,senha" />
                        <div class="invalid-feedback" data-sb-feedback="senha:required">O campo de senha e obrigatório.</div>
                        <div class="invalid-feedback" data-sb-feedback="senha:senha">Senha não valida.</div>
                    </div>
                    <button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>