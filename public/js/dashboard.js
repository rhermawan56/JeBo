var arr = $('.product-list')

$('#product').on('keyup', function (params) {
    // const list = $('#product-list p')

    for (let index = 0; index < arr.length; index++) {
        const element = arr[index];
        const list = $(element).html().indexOf($(this).val())
        
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
        $(element).hide()
    })
}