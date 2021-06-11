$(document).ready(function () {
    // check quantity
    $('#product-quantity').on('change', function () {
        // get value of input
        let quantity = $(this).val();
        
        // call function processCheckQuantity
        processCheckQuantity(quantity, '#product-quantity');
    });

    // process check quantity and submit form
    $('#frm-add-cart').on('submit', function (evt) {
        // block submit event
        evt.preventDefault();

        // get value of input
        let quantity = $('#product-quantity').val();
                
        // call function processCheckQuantity
        processCheckQuantity(quantity, '#product-quantity');
    });
});

function processCheckQuantity(quantity, selector) {
    /**
     * Process Ajax to check Quantity
     * 
     * @check quantity between Form Request and Database
     * @if OK then nothing
     * @else NotOk then show error message
     */
     $.ajax({
        url: AJAX_PRODUCT_CHECK_QUANTITY_URL,
        type: 'GET',
        data: {
            'quantity': quantity
        },
        success: function (response) {
            // success is show success message
            console.log(response);
            // Display a success toast, with a title
            alert(response.message);

            // set border red for input quantity
            $(selector).removeClass('border border-danger');
        },
        error: function (err) {
            // error is show error message
            alert(err.responseJSON.message);

            // set border red for input quantity
            $(selector).addClass('border border-danger');
        },
        dataType: 'json'
    });
}