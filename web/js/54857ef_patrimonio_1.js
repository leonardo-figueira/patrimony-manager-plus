$(document).ready(function() {
    $('#patrimonioDtAquisicao').mask('99-99-9999');


});

function validarFormulario(){
    if($('#patrimoniPlaqueta').val() == ''){
        alert('Numero da Plaqueta � um campo Obrigat�rio');
        $('#patrimoniPlaqueta').focus();
        return false;
    }

    if($('#patrimonioDescicao').val() == ''){
        alert('Descri��o do Patrimonio � um campo Obrigat�rio');
        $('#patrimonioDescicao').focus();
        return false;
    }

    if($('#patrimonioDtAquisicao').val() == ''){
        alert('Data � um campo Obrigat�rio');
        $('#patrimonioDtAquisicao').focus();
        return false
    }

    if($('#patrimonioSituacao').val() == ''){
        alert('Situa��o � um campo Obrigat�rio');
        $('#patrimonioSituacao').focus();
        return false
    }

    if($('#patrimonioNotaFiscal').val() == ''){
        alert('Numero da Nota Fiscal � um campo Obrigat�rio');
        $('#patrimonioNotaFiscal').focus();
        return false
    }

    if($('#patrimonioCentroCusto').val() == ''){
        alert('Centro de Custo � um campo Obrigat�rio');
        $('#patrimonioCentroCusto').focus();
        return false
    }

    if($('#patrimonioContaPatrimonial').val() == '') {
        alert('Conta Patrimonial � um campo Obrigat�rio');
        $('#patrimonioContaPatrimonial').focus();
        return false
    }
    return true;
}