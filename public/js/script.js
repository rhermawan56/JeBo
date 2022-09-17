$('.navbar-toggler').click(function () {
    $('.navbar-toggler').toggleClass('shadow')
})

const btnIcon = $('.icon')

for (let index = 0; index < btnIcon.length; index++) {
    const element = btnIcon[index];

    $(element).click(() => {
        $(btnIcon).toggleClass('hidden')
        if ($(element).hasClass('icon-eye')) {
            $('#password').attr('type', 'text')
        } else {
            $('#password').attr('type', 'password')
        }
    })
}