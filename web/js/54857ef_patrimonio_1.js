$(document).ready(function() {
    $('#patrimonioDtAquisicao').mask('99-99-9999');


});

function validarFormulario(){
    if($('#patrimoniPlaqueta').val() == ''){
        alert('Numero da Plaqueta é um campo Obrigatório');
        $('#patrimoniPlaqueta').focus();
        return false;
    }

    if($('#patrimonioDescicao').val() == ''){
        alert('Descrição do Patrimonio é um campo Obrigatório');
        $('#patrimonioDescicao').focus();
        return false;
    }

    if($('#patrimonioDtAquisicao').val() == ''){
        alert('Data é um campo Obrigatório');
        $('#patrimonioDtAquisicao').focus();
        return false
    }

    if($('#patrimonioSituacao').val() == ''){
        alert('Situação é um campo Obrigatório');
        $('#patrimonioSituacao').focus();
        return false
    }

    if($('#patrimonioNotaFiscal').val() == ''){
        alert('Numero da Nota Fiscal é um campo Obrigatório');
        $('#patrimonioNotaFiscal').focus();
        return false
    }

    if($('#patrimonioCentroCusto').val() == ''){
        alert('Centro de Custo é um campo Obrigatório');
        $('#patrimonioCentroCusto').focus();
        return false
    }

    if($('#patrimonioContaPatrimonial').val() == '') {
        alert('Conta Patrimonial é um campo Obrigatório');
        $('#patrimonioContaPatrimonial').focus();
        return false
    }
    return true;
}