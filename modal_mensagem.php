<?php 
if (!isset($acao)){
    $acao="";
}
if (!isset($mensagem)){
    $mensagem="";
}
if (!isset($titulo)){
    $titulo="";
}
?>	
	<div class="modal fade" id="modalMensagem" tabindex="-1" role="dialog" aria-labelledby="modalMensagemLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h4 class="modal-title" id="modalMensagemLabel"><?php echo $titulo;?></h4>
    			</div>
    			<div class="modal-body">
    				<?php echo $mensagem;?>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" id='confirmar' data-dismiss="modal">Fechar</button>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script >
$(document).ready(function(){//Equivalente ao window.onload porem mais rapido
	if('<?php echo $mensagem;?>'!=""){
		$('#modalMensagem').modal('show');
	}
});

$("button[id=confirmar]").click(function(){
	if("<?php echo $acao;?>"=="Sair"){
		history.back();
	}else if("<?php echo $acao;?>"=="Login"){
		window.location = 'index.php';
	}
});
</script>