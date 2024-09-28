<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="cartItemsList"></ul>
                <strong>Total: $<span id="totalAmount">0.00</span></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="proceedToPayment()">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>


<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span id="notificationMessage"></span>
            </div>
        </div>
    </div>
</div>
