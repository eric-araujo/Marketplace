function processPayment(token) {
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
        }
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
