$(document).ready(function () {
  const $header = $('#site-header');
  const $navLinks = $('#nav-links');
  const $logo = $('#header-logo');
  function updateHeader() {
    const scrollY = $(window).scrollTop();
    const $logoCon = $('#logo-container')
    $logoCon.css({ 'position': 'absolute', 'z-index': '999', 'transform': 'translate(-50%, -50%)', 'display': 'flex', 'justify-content': 'center', 'align-items': 'center' });

    if (scrollY > 0) {
      $header.addClass('bg-primary shadow-lg').removeClass('bg-transparent');
      if ($(window).width() > 2000) {
        $header.css('height', '120px'); // Slightly thinner than 160px but still thicker than default
        $logo.addClass('h-12 md:h-14').removeClass('h-16 md:h-20');
        $navLinks.css({
          'margin-left': '80px',
          'font-size': '32px',
        });
        $logo.css({
          'width': '70px',
          'height': '70px',
        });
        $logoCon.css({ 'width': '70px', 'height': '70px', 'top': '50%', 'left': '70px' });
      } else if ($(window).width() > 767) {
        $header.css('height', ''); // Reset to default
        $logo.addClass('h-12 md:h-14').removeClass('h-16 md:h-20');
        $navLinks.css({
          'margin-left': '80px',
          'font-size': '',
          'gap': ''
        });
        $logo.css({
          'width': '50px',
          'height': '50px',
        });
        $logoCon.css({ 'width': '50px', 'height': '50px', 'top': '50%', 'left': '68px' });
      } else if ($(window).width() <= 767) {
        $logo.addClass('h-12 md:h-14').removeClass('h-16 md:h-20');
        $logo.css({
          'width': '50px',
          'height': '50px',
        });
        $logoCon.css({ 'width': '50px', 'height': '50px', 'top': '50%', 'left': '50px' });
      }

    } else {
      $header.removeClass('bg-primary shadow-lg').addClass('bg-transparent');
      if ($(window).width() > 2000) {
        $header.css('height', '160px');
        $logo.addClass('h-16 md:h-20').removeClass('h-12 md:h-14');
        $navLinks.css({
          'margin-left': '0',
          'font-size': '32px',
        });
        $logo.css({
          'width': '300px',
          'height': '300px',
        });
        $logoCon.css({ 'width': '350px', 'height': '350px', 'top': '250%', 'left': '50%' });
      } else if ($(window).width() > 767) {
        $header.css('height', ''); // Reset to default
        $logo.addClass('h-16 md:h-20').removeClass('h-12 md:h-14');
        $logo.css({
          'width': '150px',
          'height': '150px',
        });
        $logoCon.css({ 'width': '150px', 'height': '150px', 'top': '230%', 'left': '50%' });

        $navLinks.css({
          'margin-left': '0',
          'font-size': '',
          'gap': ''
        });
      } else if ($(window).width() > 424) {
        $logo.addClass('h-16 md:h-20').removeClass('h-12 md:h-14');
        $logo.css({
          'width': '150px',
          'height': '150px',
        });
        $logoCon.css({ 'width': '110px', 'height': '110px', 'top': '130%', 'left': '49%' });

        $navLinks.css('margin-left', '0');
      } else if ($(window).width() < 425) {
        $logo.addClass('h-16 md:h-20').removeClass('h-12 md:h-14');
        $logo.css({
          'width': '150px',
          'height': '150px',
        });
        $logoCon.css({ 'width': '100px', 'height': '100px', 'top': '90%', 'left': '49%' });

        $navLinks.css('margin-left', '0');
      }

    }
  }

  $(window).on('scroll resize', updateHeader);
  updateHeader(); // Initial call

  // Mobile Menu Logic
  const $mobileMenu = $('#mobile-menu');

  $(document).on('click', '#mobile-menu-trigger', function () {
    $mobileMenu.removeClass('translate-x-full');
    $('body').addClass('overflow-hidden');
  });

  $(document).on('click', '#close-mobile-menu', function () {
    $mobileMenu.addClass('translate-x-full');
    $('body').removeClass('overflow-hidden');
  });

  // Close menu on link click
  $(document).on('click', '#mobile-menu a', function () {
    $mobileMenu.addClass('translate-x-full');
    $('body').removeClass('overflow-hidden');
  });
});