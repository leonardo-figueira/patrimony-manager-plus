$(document).ready(function() {
    $('#patrimonioDtAquisicao').mask('99/99/9999');

});

function validarFormulario(){
    if($('#patrimoniPlaqueta').val() == ''){
        alert('Numero da Plaqueta e um campo Obrigatorio');
        $('#patrimoniPlaqueta').focus();
        return false;
    }

    if($('#patrimonioDescicao').val() == ''){
        alert('Descricao do Patrimonio e um campo Obrigatorio');
        $('#patrimonioDescicao').focus();
        return false;
    }

    if($('#patrimonioDtAquisicao').val() == ''){
        alert('Data e um campo Obrigatorio');
        $('#patrimonioDtAquisicao').focus();
        return false
    }

    if($('#patrimonioSituacao').val() == ''){
        alert('Situacao e um campo Obrigatorio');
        $('#patrimonioSituacao').focus();
        return false
    }

    if($('#patrimonioNotaFiscal').val() == ''){
        alert('Numero da Nota Fiscal e um campo Obrigatorio');
        $('#patrimonioNotaFiscal').focus();
        return false
    }

    if($('#patrimonioCentroCusto').val() == ''){
        alert('Centro de Custo e um campo Obrigatorio');
        $('#patrimonioCentroCusto').focus();
        return false
    }

    if($('#patrimonioContaPatrimonial').val() == '') {
        alert('Conta Patrimonial e um campo Obrigatorio');
        $('#patrimonioContaPatrimonial').focus();
        return false
    }
    return true;
}