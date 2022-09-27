var arr = $('.product-list')



function checking() {
    const product = $('#product').val()
    if (product === '') {
        $('#hidden').val('')
        $('#Qty').val(0)
        $('#name-total').val(dataPrice - dataPrice)
        $('#total').val(dataTotal)
    }
}

function logoutDashboard() {
    const dataTarget = $('.navbar .navbar-nav').attr('data-target').toLowerCase()

    if (dataTarget === "transaction") {
        $('.navbar .navbar-nav').addClass(dataTarget)
    } else {
        $('.navbar .navbar-nav').removeClass(dataTarget)
    }
}

var dataPrice = 0
var dataTotal = parseInt($('#total').val())

function checkPaymentOrder() {
    const payment = $('#payment').val()

    if (dataTotal != 0 && payment != 0) {
        if (payment >= dataTotal) {
            $($("button[type='submit']")[1]).removeClass('disabled')
            $($("button[type='submit']")[1]).removeClass('bg-secondary')
        } else {
            $($("button[type='submit']")[1]).addClass('disabled')
            $($("button[type='submit']")[1]).addClass('bg-secondary')
        }
    }
}

function checkValueOrderItem() {
    const check = $('#select_order_item').val()
    // const

    if (check > 1) {
        $('#total').removeAttr('name')
        $('#payment').removeAttr('name')
        $('.for-pay').addClass('hidden')

        if ($($('button[type=submit]')[1]).hasClass('disabled')) {
            $($('button[type=submit]')[1]).removeClass('disabled')
            $($('button[type=submit]')[1]).removeClass('bg-secondary')
        }

    } else {
        $('#total').attr('name', 'total_trx')
        $('#payment').attr('name', 'payment_trx')
        $('.for-pay').removeClass('hidden')
        $($('button[type=submit]')[1]).addClass('disabled')
        $($('button[type=submit]')[1]).addClass('bg-secondary')
    }
}

$('#product').on('keyup', function () {
    // const list = $('#product-list p')
    checking()

    for (let index = 0; index < arr.length; index++) {
        const element = arr[index];
        const list = $(element).html().toLowerCase().indexOf($(this).val().toLowerCase())

        if (list > -1 && $(this).val() != "") {
            $(element).show()
        } else {
            $(element).hide()
        }
    }
})

for (let index = 0; index < arr.length; index++) {
    const element = arr[index];

    $(element).click(function () {
        dataPrice = parseInt($(this).attr('data-price'))
        $('#name-total').val(dataPrice)
        $('#total').val(dataTotal + dataPrice)
        $('#product').val($(this).html())
        $('#Qty').val(1)
        $('#hidden').val($(this).attr('data-index'))
        $(arr).hide()
    })
}

$('#Qty').change(function () {
    $('#name-total').val(dataPrice * parseInt($(this).val()))
    $('#total').val(dataTotal + (dataPrice * parseInt($(this).val())))
})

$('#select_order_item').change(function () {
    checkValueOrderItem()
})

$('#cancel').click(function () {

    $('#hidden').val('')
    $('#product').val('')
    $('#Qty').val('')

    $('#total').val(dataTotal)

    if ($('#payment').val() == 0 || parseInt($('#payment').val()) < parseInt($('#total').val())) {

        Swal.fire({
            title: 'Payment Please!',
            text: "Before canceling pay first!",
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#payment').val('')
                $('#payment').focus()
                $('button[type=submit]').prop('disabled', true)
            }
        })
    } else {
        $(location).prop('href', '/dashboard/transaction')
    }

})

$('#pay').click(function () {
    const change = parseInt($('#payment').val()) - parseInt($('#total').val())

    if (isNaN(change) || $('#payment').val() == 0 || parseInt($('#payment').val()) < parseInt($('#total').val())) {
        Swal.fire({
            title: 'Payment Please!',
            icon: 'error'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#payment').val('')
                $('#payment').focus()
            }
        })
    } else {
        Swal.fire({
            title: 'Change: '+change,
            text: "Pay: "+$('#payment').val(),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4b457f',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Payment Success!',
                    'Please Click Order Now!',
                    'success'
                )
                $('#payment').prop('readonly', true)
                $('#pay').addClass('disabled')
                $('#pay').addClass('bg-secondary')
                $($('button[type=submit]')[1]).removeClass('disabled')
                $($('button[type=submit]')[1]).removeClass('bg-secondary')
                $('button[type=submit]').prop('disabled', false)
                $('#change').val(change)
            }
        })
    }
})


$(function () {
    logoutDashboard()
    checkValueOrderItem()
    checkPaymentOrder()
})