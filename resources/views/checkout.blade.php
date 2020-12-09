@extends('layouts.front-user')

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Número do Cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Mês de Expiração</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Ano de Expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Código de Segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>
                    <div class="col-md-12 installments form-group"></div>
                </div>
                <button class="btn btn-success btn-lg">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup', () => {
            if(cardNumber.value.length >= 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: (response) => {
                        let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png">`;
                        spanBrand.innerHTML = imgFlag;

                        getInstallments(40, response.brand.name);
                    },
                    error: (error) => {
                        console.error(error);
                    },
                    complete: (response) => {
                    
                    }
                });
            }
        });

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

            select += '<select class="form-control">';

            for(let installment of installments) {
                select += `<option value="${installment.quantity}|${installment.installmentAmount}">${installment.quantity}x de ${installment.installmentAmount} - Total fica ${installment.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
        }
    </script>
@endsection