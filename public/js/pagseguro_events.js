let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');
cardNumber.addEventListener('keyup', () => {
    if (cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber.value.substr(0, 6),
            success: (response) => {
                let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png">`;
                spanBrand.innerHTML = imgFlag;
                document.querySelector('input[name=card_brand]').value = response.brand.name;

                getInstallments(amountTransaction, response.brand.name);
            },
            error: (error) => {
                console.error(error);
            },
            complete: (response) => {

            }
        });
    }
});

let submitButton = document.querySelector('button.processCheckout');

submitButton.addEventListener('click', (event) => {
    event.preventDefault();

    document.querySelector('div.msg').innerHTML = '';

    let buttonBuy = event.target;

    buttonBuy.disabled = true;
    buttonBuy.innerHTML = 'Processando...';

    PagSeguroDirectPayment.createCardToken({
        cardNumber: document.querySelector('input[name=card_number]').value,
        brand: document.querySelector('input[name=card_brand]').value,
        cvv: document.querySelector('input[name=card_cvv]').value,
        expirationMonth: document.querySelector('input[name=card_month]').value,
        expirationYear: document.querySelector('input[name=card_year]').value,
        success: (response) => {
            processPayment(response.card.token, buttonBuy);
        },
        error: (error) => {
            buttonBuy.disabled = false;
            buttonBuy.innerHTML = 'Efetuar Pagamento';

            for(let erro in error.errors){
                document.querySelector('div.msg').innerHTML = showErrorMessages(errorsMapPagSeguro(erro));
            }
        }
    });
});
