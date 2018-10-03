$(document).ready(function () {
    var _token = $('input[name="_token"]').val();
    $('.btn-buy').click(function () {
        var productId = $(this).attr('data-id');
        var quantity = $("input[rel=quantity]").val();
        if (isNaN(quantity)) {
            quantity = 1;
        } else {
            quantity = parseInt(quantity);
        }
        if (quantity < 1) {
            quantity = 1;
        }
        $.ajax({
            method: "POST",
            url: '/order/addtocart',
            data: {productId: productId, quantity: quantity, _token: _token}
        })
                .done(function (msg) {
                    window.location.href = "/thanh-toan";
                });
    });
    $('.remove-item').click(function () {
        var self = this;
        popup.confirm("Bạn chắc chắn muốn xóa sản phẩm này không?", function () {
            var rowId = $(self).attr('data-id');
            $.ajax({
                method: "POST",
                url: '/order/remove-cart',
                data: {rowId: rowId, _token: _token}
            })
                    .done(function (msg) {
                        window.location.href = "/thanh-toan";
                    });
        });
    });
    $('input[name=quantity]').on('change', function () {
        var rowId = $(this).attr('data-id');
        var quantity = $(this).val();
        if (isNaN(quantity)) {
            quantity = 1;
        } else {
            quantity = parseInt(quantity);
        }
        if (quantity < 1) {
            quantity = 1;
        }
        $.ajax({
            method: "POST",
            url: '/order/update-cart',
            data: {rowId: rowId, quantity: quantity, _token: _token}
        })
                .done(function (msg) {
                    window.location.href = "/thanh-toan";
                });
    });
});


var order = {};

order.paymentSteepOne = function () {
    ajaxSubmit({
        service: '/order/save',
        id: 'form-add',
        contentType: 'json',
        loading: true,
        done: function (rs) {
            if (rs.success) {
                window.location.href = baseUrl + 'dat-hang-thanh-cong-' + rs.data.id + '.html';
            } else {
                popup.msg(rs.message);
            }
        }
    });
};
