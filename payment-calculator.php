<!-- Payment Calculator Form -->

<!-- Modal -->
<div class="modal fade" id="payment-calcuclator-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-calculator"></i> &nbsp Payment Calcuclator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body bg-light">
            <form>
                <div class="form-group">
                    <label for="vehicle-price">Vehicle Price</label>
                    <input type="text" class="form-control" id="vehicle-price"  value="<?php echo htmlspecialchars($car['price']); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="intrest-rate">Intrest Rate</label>
                        <input type="text" class="form-control" id="intrest-rate" value="5.7">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="loan-term">Loan Term</label>
                        <select id="loan-term" class="form-control">
                        <option>48 Months</option>
                        <option selected>60 Months</option>
                        <option>72 Months</option>
                        <option>84 Months</option>
                    </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="down-payment">Down Payment $</label>
                        <input type="text" class="form-control" id="down-payment" value="5000">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="trade-in">Trade In Value $</label>
                        <input type="text" class="form-control" id="trade-in">
                    </div>
                    
                </div>

            
                <button id="calculate-btn" class="btn btn-primary">Calculate My Payment</button>
            </form>
            
        </div>
      <div class="modal-footer">
        <div class="container text-center p-3" style="display:none" id="monthly-payment-div">
            <p>Your monthly payment:</p>
            <h3 id="monthly-payment-amount">$</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script to calculate the payment and show it in the modal -->
<script>
    document.getElementById('calculate-btn').addEventListener('click',function(e){
        e.preventDefault()
        let vehiclePrice = document.getElementById('vehicle-price').value
        let rate = document.getElementById('intrest-rate').value
        let term = document.getElementById('loan-term').value.split(' ')[0]
        let downPayment = document.getElementById('down-payment').value
        let tradeIn = document.getElementById('trade-in').value

        // calculate the payment
        let loan = vehiclePrice - downPayment - tradeIn
        let adjustedRate = ((rate/100)/12)
        let factor = (((1 + adjustedRate) ** term) - 1) / (adjustedRate *((1 + adjustedRate) ** term))
        console.log(factor)
        let payment = loan / factor
        payment = Math.floor(payment)

        //show the payment amount in the modal
        document.getElementById('monthly-payment-amount').textContent = '$'+ payment;
        $('#monthly-payment-div').show(200,'linear');
    })
</script>