@extends('layouts.front-user')

@section('stylessheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

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
                        <label>Nome no Cartão</label>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Número do Cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
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
                <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script>
        let amountTransaction = '{{$total}}';
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup', () => {
            if(cardNumber.value.length >= 6){
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

        submitButton.addEventListener('click', () => {
            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand: document.querySelector('input[name=card_brand]').value,
                cvv: document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: (response) => {
                    processPayment(response.card.token);
                }
            });
        });

        function processPayment(token)
        {
            let data = {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installment').value,
                card_name:  document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            }

            $.ajax({
                type: 'POST',
                url: '{{route("checkout.proccess")}}',
                data: data,
                dataType: 'json',
                success: (response) => {
                   toastr.success(response.data.message, 'Sucesso')
                   window.location.href = '{{route('checkout.thanks')}}?order=' + response.data.order;
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

            for(let installment of installments) {
                select += `<option value="${installment.quantity}|${installment.installmentAmount}">${installment.quantity}x de ${installment.installmentAmount} - Total fica ${installment.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
        }
    </script>
@endsection