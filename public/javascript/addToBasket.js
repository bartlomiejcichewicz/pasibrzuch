function changeAmount(basketId) {
    let Val = $('#basket'+basketId).val();
    let Data = {
        "BasketId": basketId,
        "Amount": Val
    }
    $.ajax({
        type: "POST",
        url: "http://localhost/pasibrzuch/dodaj-do-koszyka/0",
        data: Data,
        success: function() {
            $('#basket-amount-'+basketId).html(Val);
        }
    });
}