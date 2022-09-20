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

const ulLogin = document.querySelectorAll('#login_as a')
var coba;
for (let index = 0; index < ulLogin.length; index++) {
    const element = ulLogin[index];
    $(element).click(function () {
        fetch('/login/loginas?role=Admin')
            .then(response => response.json())
            .then(data => $('#email').val(data.email) )
            $('#password').val('password')
    })
}

$(function () {
    // console.log($('#login_as a'))
})