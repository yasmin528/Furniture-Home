function changeQuantity(action, productId) {
    var quantityInput = document.getElementById('quantity-' + productId);
    var currentQuantity = parseInt(quantityInput.value);
    let maxQuantity = parseInt(quantityInput.max);

    if (action === 'plus' && currentQuantity < maxQuantity) {
        quantityInput.value = currentQuantity + 1;
    } else if (action === 'minus' && currentQuantity > 0) {
        quantityInput.value = currentQuantity - 1;
    }
    checkQuantity(quantityInput.value ,productId );
}

function checkQuantity(quantity,productId)
{
    var btn = document.getElementById('btn-' + productId);
    if (quantity > 0) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function changeQuantityAndTotalPrice(action, productId, orderId){
    var quantityInput = document.getElementById('quantity-' + productId);
    var currentQuantity = parseInt(quantityInput.value);
    let maxQuantity = parseInt(quantityInput.max);

    if (action === 'plus' && currentQuantity < maxQuantity) {
        quantityInput.value = currentQuantity + 1;
    } else if (action === 'minus' && currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
    fetch('/order/' + orderId, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify({
            quantity: quantityInput.value
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var totalPriceElement = document.getElementById('total-price-' + orderId);
                totalPriceElement.textContent = 'Total Price: $' + data.total_price;
            } else {
                console.error('An error occurred while updating the quantity.');
            }
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
}
