var heroText = [
    "roosters maken",
    "medewerkers toevoegen",
    "je rooster bekijken"
];

var currentHeroTextIndex = 0;
window.setInterval(function(){
    cyclingText = $('#cyclingText');
    cyclingText.fadeOut(function() {
        cyclingText.text(heroText[currentHeroTextIndex]);
        cyclingText.fadeIn();
    });
    if (currentHeroTextIndex === 2) {
        currentHeroTextIndex = 0;
    } else {
        currentHeroTextIndex++;
    }
}, 4000);

setNavBarPosition();

$(window).scroll(function() {
    var wScroll = $(window).scrollTop();
    setNavBarPosition(wScroll);
    setPromos(wScroll);
});

/**
 * Set Navbar position
 * @param wScroll
 */
function setNavBarPosition(wScroll) {
    // console.log(wScroll);
    if (wScroll >= 100) { // this refers to window
        $('.navbar').addClass('sticked');
        $('.nav-mobile').css('top', '70px');
    } else {
        $('.navbar').removeClass('sticked');
        $('.nav-mobile').css('top', '80px');
    }
}

/**
 * set Parallax effect
 * @param wScroll
 */
function setPromos(wScroll) {
    if ($(window).width() > 991) {
        $('.macbook').css('top', -wScroll / 20 + 100 + 'px');
        $('.iphone').css('top', wScroll / 10 + 'px');
    } else {
        $('.iphone').css('top', '40px');
        $('.macbook').css('top',' 160px');
    }
}

/**
 * Handle mobile nav
 * @type {navExpanded}
 */
var navExpanded = false;
$('#mobile-nav-toggle').click(function() {
    if (!navExpanded) {
        $('.nav-mobile').css('display', 'block');
        navExpanded = true;
    } else {
        $('.nav-mobile').css('display', 'none');
        navExpanded = false;
    }
});
$('.dismiss-menu').click(function() {
    $('.nav-mobile').css('display', 'none');
    navExpanded = false;
});

/**
 * handle scroll link clicks
 */
$('.scroll-link').click(function() {
    _this = $(this);
    link = _this.attr('data-href');
    if (link === 'home') {
        $('html, body').animate({
            scrollTop: $('#' + link).offset().top -100
        }, 800);
    } else {
        $('html, body').animate({
            scrollTop: $('#' + link).offset().top - 30
        }, 800);
    }
    $('.nav-mobile').css('display', 'none');
    navExpanded = false;
});

/**
 * Submit demo form
 */
$('#demo_form').on('submit', function(e) {
    e.preventDefault();

    var l = Ladda.create(document.getElementById('submitDemoButton'));
    l.start();

    data = $('#demo_form').serializeArray();

    $.post('/api/v1/new-sign-up', data, function(res) {
        if (res.hasErrors) {
            errors = res.errors;
            if (errors.name) {
                $('#demo_name').addClass('has-danger');
                $('#name_error').text(errors.name);
            } else {
                $('#demo_name').removeClass('has-danger');
                $('#name_error').text('');
            }
            if (errors.email) {
                $('#demo_email').addClass('has-danger');
                $('#email_error').text(errors.email);
            } else {
                $('#demo_email').removeClass('has-danger');
                $('#email_error').text('');
            }
            if (errors.bedrijfsnaam) {
                $('#demo_company_name').addClass('has-danger');
                $('#company_error').text(errors.bedrijfsnaam);
            } else {
                $('#demo_company_name').removeClass('has-danger');
                $('#company_error').text('');
            }
        } else {
            $('#demo_form').fadeOut(function() {
                $('#successMessage').fadeIn();
                $('#demo_form input').val('').removeClass('has-danger');
                $('#demo_form textarea').val('').removeClass('has-danger');
            });
        }
        l.stop();
    });
});

/***
 * close the modal
 */
$('.closeDemoButton').click(function() {
    $('#demo_form input').val('').removeClass('has-danger');
    $('#demo_form textarea').val('').removeClass('has-danger');
});


/**
 * Close on demo form success
 */
$('#anotherDemoButton').click(function() {
    $('#signupModalContent').modal('hide');
    $('#successMessage').fadeOut(function() {
        $('#demo_form').fadeIn();
    });
});

/**
 * submit contact form
 */
$('#contact_form').on('submit', function(e) {
   e.preventDefault();

    var l = Ladda.create(document.getElementById('submitContact'));
    l.start();

    data = $('#contact_form').serializeArray();
    $.post('/api/v1/contact', data, function(res) {
        if (res.hasErrors) {
            errors = res.errors;
            if (errors.name) {
                $('#contact_name').addClass('has-danger');
            } else {
                $('#contact_name').removeClass('has-danger');
            }
            if (errors.email) {
                $('#contact_email').addClass('has-danger');
            } else {
                $('#contact_email').removeClass('has-danger');
            }
            if (errors.message) {
                $('#contact_message').addClass('has-danger');
            } else {
                $('#contact_message').removeClass('has-danger');
            }
        } else {
            $('#contact_form input').val('').removeClass('has-danger');
            $('#contact_form textarea').val('').removeClass('has-danger');
            $.snackbar({content: "Bedankt voor het versturen van uw bericht"});
        }
        l.stop();
    });
});