var arr = $('.product-list')

function checking() {
    const product = $('#product').val()
    if (product === '') {
        $('#hidden').val('')
        $('#Qty').val(0)
        $('#name-total').val(PriceTotal - PriceTotal)
        $('#total').val(dataTotal)
    }
}

function checkOrderItem() {
    if ($('#select_order_item').val() > 1) {
        $('button[type=submit]').addClass(['disabled', 'bg-secondary'])
    } else {
        if ($('button[type=submit]').hasClass('disabled', 'bg-secondary')) {
            $('button[type=submit]').removeClass(['disabled', 'bg-secondary'])
        }
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

function checkTotal() {
    if ($('#total').val() < 0) {
        $('#payment').prop('readonly', true)
        $('#payment').val(0)
        $('#change').val(parseInt(-($('#total').val())))
    } else {
        $('#payment').prop('readonly', false)
        $('#change').val(0)
    }
}

function alert(data = {}) {
    if (Boolean(data['warning'])) {
        Swal.fire({
            title: data['title'],
            text: data['warning'],
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: data['cancel'],
            showConfirmButton: data['confirm']
        }).then((result) => {
            if (result.isConfirmed) {
                $('#payment').val('')
                $('#payment').focus()
            }
        })
    } else if (Boolean(data['pay'])) {
        if ($('#product').val() == '') {
            data['description'] = ''
        }
        Swal.fire({
            title: "Change Money: " + data['change'],
            text: "Payment: " + data['pay'],
            icon: 'success',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Payment Success!',
                    data['description'],
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        if ($('#product').val() == '') {
                            $(location).prop('href', '/dashboard/transaction')
                        } else {
                            $('#product').prop('readonly', true)
                            $('#Qty').prop('readonly', true)
                            $('#payment').prop('readonly', true)
                            $('button[type=submit]').removeClass(['disabled', 'bg-secondary'])
                            $('#pay').addClass(['disabled', 'bg-secondary'])
                            $('#change').val(parseInt($('#payment').val() - $('#total').val()))
                            $('#cancel').removeClass('hidden')
                        }
                    }
                })
            }
        })
    }
}

var PriceTotal = parseInt($('#name-total').val())
var dataPrice = parseInt($('#product').attr('data-price'))
var dataTotal = parseInt($('#total').val())
var oldTotal = parseInt($('#name-total').val())

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

$('#product').on('keyup', function () {
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

        $('#product').val($(this).html())
        $('#Qty').val(1)
        $('#hidden').val($(this).attr('data-index'))
        $(arr).hide()

        if ($('#total').hasClass('total-edit') && $('#name-total').hasClass('name-total-edit')) {
            $('#total').val(parseInt(dataPrice - oldTotal))
            $('#name-total').val(dataPrice)
            checkTotal()
        } else {
            $('#total').val(dataTotal + dataPrice)
            $('#name-total').val(dataPrice)
        }
    })
}

$('#Qty').change(function () {
    PriceTotal = dataPrice * $(this).val()
    $('#name-total').val(PriceTotal)

    if ($('#name-total').hasClass('name-total-edit') && $('#total').hasClass('total-edit')) {
        $('#total').val(parseInt((PriceTotal - oldTotal)))
        checkTotal()
    } else {
        $('#total').val(dataTotal + PriceTotal)
    }

})

$('#cancel').click(function () {
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true
      }).then((result) => {
        if (result.isConfirmed) {
            $('#product').prop('readonly', false)
            $('#Qty').prop('readonly', false)
            $('#payment').prop('readonly', false)
            $('#payment').val(0)
            $('#change').val(0)
            $('#pay').removeClass(['disabled', 'bg-secondary'])
        }
      })
})

$('#pay').click(function () {
    const change = parseInt($('#payment').val()) - parseInt($('#total').val())

    if ($('#total').val() > 0) {
        if (isNaN(change) || $('#payment').val() < 1) {
            alert({ 'title': 'Payment Please!', 'warning': 'Fill in the payment column first!', 'confirm': 'OK', 'cancel': 'CANCEL' })
        } else if (parseInt($('#payment').val()) < parseInt($('#total').val())) {
            alert({ 'title': 'Payment Please!', 'warning': 'Payment is not appropriate!', 'confirm': 'OK', 'cancel': 'CANCEL' })
        } else {
            if ($(this).hasClass('pay-edit')) {
                console.log(true)
            } else {
                alert({ 'pay': $('#payment').val(), 'change': change, 'description': 'Please Order Now!' })
            }
        }
    } else if ($('#total').val() < 0) {
        alert({ 'change': parseInt(-($('#total').val())), 'pay': $('#payment').val(), 'description': 'Update Order!' })
    } else {
        if ($(this).hasClass('pay-edit')) {
            alert({ 'pay': $('#payment').val(), 'change': change, 'description': 'Please Update Order!' })
        } else {
            alert({ 'title': 'Transaction Not Found!!', 'warning': 'Make a transaction first!', 'confirm': false, 'cancel': 'OK' })
        }
    }
})


$(function () {
    logoutDashboard()
    checkPaymentOrder()
    checkOrderItem()
})