var arr = $('.product-list')

function checking() {
    const product = $('#product').val()
    if (product === '') {
        $('#hidden').val('')
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
        $('#product').val($(this).html())
        $('#hidden').val($(this).attr('data-index'))
        $(arr).hide()
    })
}

$(function () {
    // checking()
    logoutDashboard()
})