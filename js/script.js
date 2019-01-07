$(document).ready(function () {
    $('ul.dropdown-menu.dropdown-big > li:first-child').addClass('hover');
    $('ul.dropdown-menu.dropdown-big > li').each(function () {
        if ($(this).find('> ul').length === 0)
            $(this).closest('.dropdown-big').removeClass('dropdown-big');
    });
    $('ul.dropdown-big').closest('li').css({'position': 'initial'});
    $('ul.dropdown-menu.dropdown-big > li').hover(function () {
        $(this).siblings().removeClass('hover');
        $(this).addClass('hover');
    });

    $('.carousel').carousel({
        interval: 5000,
        wrap: true,
    });

    /* Validation Events for changing response CSS classes */
    document.addEventListener('wpcf7invalid', function (event) {
        $('.wpcf7-response-output').addClass('alert alert-danger');
    }, false);
    document.addEventListener('wpcf7spam', function (event) {
        $('.wpcf7-response-output').addClass('alert alert-warning');
    }, false);
    document.addEventListener('wpcf7mailfailed', function (event) {
        $('.wpcf7-response-output').addClass('alert alert-warning');
    }, false);
    document.addEventListener('wpcf7mailsent', function (event) {
        $('.wpcf7-response-output').addClass('alert alert-success');
    }, false);

    //made by vipul mirajkar thevipulm.appspot.com
    var TxtType = function (el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function () {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) {
            delta /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function () {
            that.tick();
        }, delta);
    };

    var elements = document.getElementsByClassName('typewrite');
    for (var i = 0; i < elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
            new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);

    $('li[role="tab"][aria-controls]').click(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        var $target = $('#' + $(this).attr('aria-controls'));
        $target.siblings().removeClass('selected');
        $target.addClass('selected');
    });
});