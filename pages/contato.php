<?php  
        $botaoClicado= $Ferramenta->get_post_action('sendFormulario');
        
        if (isset($_POST[$botaoClicado])) {
            
            // filter_input_array => Acessa os dados informados no form em um formato de array
            // Atribui o array dos dados informados a variável $SendClienteFornecedor
            $SendFormulario = filter_input_array(trim(INPUT_POST, FILTER_DEFAULT));
            unset($_POST[$botaoClicado]);
            // unset => Exclui a variável informada do array $SendClienteFornecedor
            unset($SendFormulario[$botaoClicado]);
            //EXECUTA A INSERÇÃO NO BANCO                
           
            //Passa para as variaveis a mensagem de confirmação
            $titulo="Sucesso!";
            $mensagem="Assim que sua mensagem for analisada nós retornaremos o contato.<br> Muito Obrigado!";
			$mensagem=$mensagem."<br><br>Nome: ".$SendFormulario[CTS_ST_NOME];
			$mensagem=$mensagem."<br>Sobrenome: ".$SendFormulario[CTS_ST_SOBRENOME];
			$mensagem=$mensagem."<br>Email: ".$SendFormulario[CTS_ST_EMAIL];
			$mensagem=$mensagem."<br>Titulo mensagem: ".$SendFormulario[CTS_ST_TITULO];
			$mensagem=$mensagem."<br>Mensagem: ".$SendFormulario[CTS_ST_MENSAGEM];
        }
    
?>
<div class="container marketing">
      <div class="row featurette">
        <h2 class="featurette-heading">Deixe sua mensagem.</h2>
        <hr>
            <form method="post" action="" >
                <div class="col-md-6">
                     
                    <div class="col-xs-4 ">
                        <label >Nome</label>
                        <input type="text" class="form-control" name="CTS_ST_NOME" placeholder="Ex: João">
                    </div>    
                    <div class="col-xs-8 ">
                        <label >Sobrenome</label>
                        <input type="text" class="form-control" name="CTS_ST_SOBRENOME" placeholder="Ex: Pereira">
                    </div>
                    <div class="col-xs-12 ">
                        <label >Email</label>
                        <input type="text" class="form-control" name="CTS_ST_EMAIL" placeholder="Ex: joao@pereira.com.br">
                    </div>
                    <div class="col-xs-12 ">
                        <label >Titulo</label>
                        <input type="text" class="form-control" name="CTS_ST_TITULO" placeholder="Ex: questionamento sobre os planos do BF-Sysadmin">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-12 ">
                        <label >Mensagem</label>
                        <textarea class="form-control" rows="7" name="CTS_ST_MENSAGEM" placeholder="Ex: Existe um plano especial para mim?"></textarea>
                    </div>
                </div>
                <div class="btn btn-group col-md-offset-10">
                       <button class="btn btn-primary btn-lg" name="sendFormulario" type="submit">&nbsp;&nbsp;&nbsp;&nbsp; Enviar &nbsp;&nbsp;&nbsp;&nbsp;</button>
                </div>
            </form>
    </div>
    <?php include 'modal_mensagem.php';?>