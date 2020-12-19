function processPayment(token, buttonBuy) {
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installment').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf
    }

    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: (response) => {
            //toastr.success(response.data.message, 'Sucesso')
            window.location.href = `${urlThanks}?order=` + response.data.order;
        },
        error: (error) => {
            buttonBuy.disabled = false;
            buttonBuy.innerHTML = 'Efetuar Pagamento';
            
            let message = JSON.parse(error.responseText);
            document.querySelector('div.msg').innerHTML = showErrorMessages(message.data.message.error.message);
        },
    });
}

function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: (response) => {
            let selectInstallments = drawSelectInstallments(response.installments[brand]);

            document.querySelector('div.installments').innerHTML = selectInstallments;
        },
        error: (error) => {
            console.error(error);
        },
        complete: (response) => {

        }
    });
}

function drawSelectInstallments(installments) {

    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installment">';

    for (let installment of installments) {
        select += `<option value="${installment.quantity}|${installment.installmentAmount}">${installment.quantity}x de ${installment.installmentAmount} - Total fica ${installment.totalAmount}</option>`;
    }

    select += '</select>';

    return select;
}

function showErrorMessages(message) {
    return `
        <div class="alert alert-danger">${message}</div>
    `;
}

function errorsMapPagSeguro(code) {
    switch (code) {
        case "10000":
            return 'Bandeira do cartão inválida!';

        case "10001":
            return 'Número do Cartão com tamanho inválido!';

        case "10002":
        case "30405":
            return 'Data com formato inválido!';

        case "10003":
            return 'Código de segurança inválido';

        case "10004":
            return 'Código de segurança é obrigatório!';

        case "10006":
            return 'Tamanho do código de segurança inválido!';

        default:
            return 'Houve um erro na validação do seu cartão de crédito!';

    }
}
