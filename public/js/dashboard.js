// property define
var priceProduct = $('#product').attr('data-price')
var productList = document.getElementsByClassName('product-list')
var priceTotal = $('#total').val()
var priceProductTotal

// property define edit
var oldPayment = $('#name-total').val()
var oldOrder = $('#product').val()
var oldQty = $('#Qty').val()

// function
function checkSelectOrderItem() {
    const orderItem = $('#select_order_item').val()

    if (orderItem > 1) {
        classAdd({ '#pay': 'disabled bg-secondary' })
        classRemove({ '#order-btn': 'disabled bg-secondary' })
        $('#order-btn').attr('disabled', false)
    } else {
        classRemove({ '#pay': 'disabled bg-secondary' })
        classAdd({ '#order-btn': 'disabled bg-secondary' })
        $('#order-btn').attr('disabled', true)
    }
}

function parameterIfInputProductNotEmpty(data = {}) {
    Object.entries(data).forEach(
        ([key, value]) => $(key).val(value)
    );
}

function formatIdr(params) {
    params = params.toString().split('').reverse().join('')
    params = params.match(/(\d{1,3})/g)
    params = params.join('.').split('').reverse().join('')

    return 'Rp ' + params
}

function classAdd(data = {}) {
    Object.entries(data).forEach(
        ([key, value]) => $(key).addClass(value)
    )
}

function classRemove(data = {}) {
    Object.entries(data).forEach(
        ([key, value]) => $(key).removeClass(value)
    )
}

function readOnly(data = {}) {
    Object.entries(data).forEach(
        ([key, value]) => $(key).attr('readonly', value)
    )
}

function sweetAlert(data = []) {
    // if warning
    if (Boolean(data['warning'])) {
        Swal.fire({
            icon: data['warning'],
            title: data['title'],
            text: data['text']
        }).then((result) => {
            if (result.isConfirmed) {
                $('#payment').focus()
            }
        })
    }

    // if success
    if (Boolean(data['success'])) {
        Swal.fire({
            icon: data['success'],
            title: data['title'],
        }).then((result) => {
            const orderId = $('#hidden').val()
            if (orderId != '') {
                if (!$('#pay').hasClass('pay-edit')) {
                    data['text'] = 'Please, Click Order Now!'
                } else {
                    data['text'] = 'Please, Update Order!'
                }
            }

            if (result.isConfirmed) {
                parameterIfInputProductNotEmpty({
                    '#change': data['change']
                })

                Swal.fire({
                    icon: data['success'],
                    title: 'Payment Success!',
                    text: data['text']
                }).then((result) => {
                    if (result.isConfirmed) {
                        classAdd({
                            '#pay': 'disabled bg-secondary'
                        })
                        readOnly({
                            '#order_by': true,
                            '#product': true,
                            '#Qty': true,
                            '#payment': true
                        })

                        if (orderId != '') {
                            classRemove({
                                '#order-btn': 'disabled bg-secondary'
                            })
                            $('#order-btn').attr('disabled', false)
                        } else {
                            $(location).attr('href', '/dashboard/transaction')
                        }
                    }
                })
            }
        })
    }

    // if error
    if (Boolean(data['error'])) {
        Swal.fire({
            icon: data['error'],
            title: data['title'],
            text: data['text']
        })
    }
}

function totalForEdit() {
    const total = $('#total').val()
    if (total < 0) {
        readOnly({ '#payment': true })
        parameterIfInputProductNotEmpty({ '#change': -(parseInt(total)) })
    }
}

// event
$('#product').on('keyup', function () {
    if ($(this).val() == '') {
        parameterIfInputProductNotEmpty({
            '#hidden': null,
            '#Qty': null
        })
        if ($(this).hasClass('product-edit')) {
            parameterIfInputProductNotEmpty({
                '#name-total': oldPayment,
                '#total': 0
            })
        } else {
            parameterIfInputProductNotEmpty({
                '#name-total': 0,
                '#total': priceTotal
            })

        }
    }

    for (let index = 0; index < productList.length; index++) {
        const elementProduct = productList[index];
        var list = $(elementProduct).html().toLowerCase().indexOf($(this).val().toLowerCase())

        if ($(this).val() == '') {
            $(productList).hide()
        } else if (list > -1) {
            $(elementProduct).show()
        } else {
            $(elementProduct).hide()
        }

        $(elementProduct).click(function () {
            priceProduct = $(elementProduct).attr('data-price')
            const total = $('#total').val()

            $(productList).hide()

            parameterIfInputProductNotEmpty({
                '#hidden': $(elementProduct).attr('data-index'),
                '#product': $(elementProduct).html(),
                '#Qty': 1,
            })

            if (!$('#product').hasClass('product-edit')) {
                parameterIfInputProductNotEmpty({
                    '#name-total': priceProduct,
                    '#total': parseInt(priceTotal) + parseInt(priceProduct)
                })
            } else {
                if (oldOrder == $(this).val()) {
                    parameterIfInputProductNotEmpty({
                        '#name-total': oldPayment,
                        '#total': priceTotal
                    })
                } else {
                    parameterIfInputProductNotEmpty({
                        '#name-total': priceProduct,
                        '#total': parseInt(priceProduct) - parseInt(oldPayment)
                    })
                }
            }

            totalForEdit()
        })
    }
})

$('#Qty').change(function () {
    const qty = $(this).val()
    priceProductTotal = parseInt(priceProduct * qty)

    parameterIfInputProductNotEmpty({
        '#name-total': priceProductTotal
    })

    if (!$(this).hasClass('qty-edit')) {
        parameterIfInputProductNotEmpty({ '#total': parseInt(priceTotal) + parseInt(priceProductTotal) })
    } else {
        parameterIfInputProductNotEmpty({ '#total': parseInt(priceProductTotal) - parseInt(oldPayment) })
    }

    totalForEdit()
})

$('#pay').click(function () {
    const total = parseInt($('#total').val())
    const payment = parseInt($('#payment').val())

    if (total == 0) {
        if ($(this).hasClass('pay-edit')) {
            if (oldOrder != $('#product').val() && $('#product').val() != '') {
                sweetAlert({
                    'success': 'success',
                    'title': 'Pay : ' + formatIdr(payment) + '</br> Change : ' + formatIdr(payment - total),
                    'change': (payment - total)
                })
            }
        } else {
            sweetAlert({
                'error': 'error',
                'title': 'No Transaction Found!',
                'text': 'Please, make a transaction first!'
            })
        }
        if (oldOrder != $('#product').val() && oldQty != $('#Qty').val()) {
            if (!$(this).hasClass('pay-edit')) {
                sweetAlert({
                    'error': 'error',
                    'title': 'No Transaction Found!',
                    'text': 'Please, make a transaction first!'
                })
            }
        }
    } else if (payment < total || isNaN(payment - total)) {
        sweetAlert({
            'warning': 'warning',
            'title': 'Invalid payment!',
            'text': 'Please, check your payment!'
        })
    } else {
        sweetAlert({
            'success': 'success',
            'title': 'Pay : ' + formatIdr(payment) + '</br> Change : ' + formatIdr(payment - total),
            'change': (payment - total)
        })
    }
})

$('#cancel').click(function () {
    readOnly({
        '#product': false,
        '#Qty': false,
        '#payment': false
    })
    classRemove({ '#pay': 'disabled bg-secondary' })
    classAdd({ '#order-btn': 'disabled bg-secondary' })
    parameterIfInputProductNotEmpty({
        '#payment': 0,
        '#change': 0,
        '#product': null,
        '#hidden': null,
        '#Qty': null,
        '#name-total': oldPayment,
        '#total': priceTotal
    })

    if ($(this).hasClass('cancel-edit')) {
        if (oldOrder == $('#product').val()) {
            if (oldQty == $('#Qty').val()) {
                $(location).attr('href', '/dashboard/transaction')
            } else {
                readOnly({'#order_by':false})
            }
        }
    } else {
        readOnly({'#order_by':false})
    }
})

$('#payment').change(function () {
    const payment = $(this).val()

    if (!$('#order-btn').hasClass('disabled', 'bg-secondary') && payment > 0) {
        $('#order-btn').attr('disabled', false)
    } else {
        $('#order-btn').attr('disabled', true)
    }
})

$('#select_order_item').change(function () {
    checkSelectOrderItem()
})

$(function () {
    checkSelectOrderItem()
    // console.log(oldOrder, oldQty)
})