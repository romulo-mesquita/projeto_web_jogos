<br><br>   
<section class="page-section" id="contact">
    <div class="container">
        
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Formulário de Contato</h2>
        
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-gamepad"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">                
                <form id="contactForm" method="POST" action="?pg=contato/processar_formulario">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Insira seu nome..." data-sb-validations="required" />
                        <label for="name">Nome Completo</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">O campo de nome e obrigatório.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" type="email" placeholder="nome@example.com" data-sb-validations="required,email" />
                        <label for="email">Email</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">O campo de email e obrigatório.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email não é valido.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="mensagem" name="mensagem" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                        <label for="message">Mensagem</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">O campo de mensagem e obrigatório.</div>
                    </div>
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>