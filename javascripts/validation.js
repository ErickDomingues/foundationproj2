function valida(pTagIndicaErro,pCampoValidado, pTagIndicada, pNomeCampo, pIdRetorno,pRequerido, pTamanhoMin, pNumero, pEmail, pData) {
	var i = 1;
	var mensagemRequrido = "";
	var mensagemTamanho = "";
	var mensagemENumero = "";
	var mensagemEEmail = "";
	var erro = false;
	if (pRequerido == 1) {
		if (pCampoValidado == "") {
			var mensagemRequrido = ', é requrido ';
			erro = true;
		}
	}
	if (pTamanhoMin > 0) {
		if (pCampoValidado.length < pTamanhoMin && pCampoValidado != "") {
			var mensagemTamanho = ',tem o tamanho mínimo de ' + pTamanhoMin
					+ " caractéres";
			erro = true;
		}
	}
	if (pNumero == 1 && pCampoValidado != "") {
		pCampoValidado=replaceAll(pCampoValidado,'.','');
		pCampoValidado=replaceAll(pCampoValidado,',','.');
		if (!$.isNumeric(pCampoValidado)) {
			var mensagemENumero = ', aceita apenas numeros ';
			erro = true;
		}
	}
	if (pEmail == 1 && pCampoValidado != "") {
		var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

		if (filtro.test(pCampoValidado)==false) {
			var mensagemEEmail = ', aceita apenas endereços de email válidos ';
			erro = true;
		}
	}
	if (pData == 1 && pCampoValidado != "") {
		if (validaDat(pCampoValidado)==false) {
			var mensagemEEmail = ', aceita apenas datas válidas ';
			erro = true;
		}
	}

	var mensagemErro = mensagemRequrido + mensagemTamanho + mensagemENumero+ mensagemEEmail + ".";

	mensagemErro = mensagemErro.substring(1, mensagemErro.length);

	if (erro == true) {	
		$('div[id='+pTagIndicaErro+']').show();
		$("." + pIdRetorno).remove();
		$(pTagIndicada).removeClass('has-success');
		$(pTagIndicada).addClass('has-error');
		var mensagem = "<li class='" + pIdRetorno + "'>O campo <strong>" + pNomeCampo+ "</strong> " + mensagemErro + "</li>";
		$('p[id='+pTagIndicaErro+']').append(mensagem);
		return false;
	} else {
		$(pTagIndicada).removeClass('has-error');
		$(pTagIndicada).addClass('has-success');
		$("." + pIdRetorno).remove();
		if ($('p[id='+pTagIndicaErro+']').html() == "<strong>ATENÇÃO:</strong>") {
			$('div[id='+pTagIndicaErro+']').hide();
			return true;	
		}
	}

}

function validaDat(valor) {
	var date=valor;
	var ardt=new Array;
	var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt=date.split("/");
	erro=false;
	if ( date.search(ExpReg)==-1){
		erro = true;
		}
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if ( ardt[1]==2) {
		if ((ardt[0]>28)&&((ardt[2]%4)!=0))
			erro = true;
		if ((ardt[0]>29)&&((ardt[2]%4)==0))
			erro = true;
	}
	if (erro) {
		return false;
	}
	return true;
}

function replaceAll(str, de, para){
    var pos = str.indexOf(de);
    while (pos > -1){
		str = str.replace(de, para);
		pos = str.indexOf(de);
	}
    return (str);
}