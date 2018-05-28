$('.homeLink').click(function() {
   window.location.href = '/';
});

$('.roosterLink').click(function() {
    window.location.href = '/new/rooster';
});

$('.newCompany').click(function() {
    window.location.href = '/new/company';
});

function updateColor(jscolor) {
    $('.info').css('background-color', '#' + jscolor);
}

function updateTextColor(jscolor) {
    $('.info').css('color', '#' + jscolor)
}

// activate tooltips
$("body").tooltip({ selector: '[data-toggle=tooltip]' });
$('#aside').addClass('folded');
