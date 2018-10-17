function is_touch_device() {
 return (('ontouchstart' in window)
      || (navigator.MaxTouchPoints > 0)
      || (navigator.msMaxTouchPoints > 0));
}

// Check if URL is an external host
function isExternal(url) {
  var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
  if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol) return true;
  if (typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(":("+{"http:":80,"https:":443}[location.protocol]+")?$"), "") !== location.host) return true;
  return false;
}



(function() {

  // open/close the mobile menu
  $('.menu-toggle').on('click', function(e){
    e.preventDefault();
    $('#site-nav').toggleClass('active');//.one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(){};
    $('body').toggleClass('menu-open');
  });


  // identify all external links on the page
  $('a').each(function(){
    var $link = $(this);
    if(isExternal($link.attr('href'))) {
      console.log('external link found: ' + $link.attr('href'));
      $link.addClass('external-link').click(function(){
        return confirm("Are you sure you want to leave this site?");
      });
    }
  });


  // if on the member profile page, scroll to the selected member's section and close the menu
  if($('.member-profile').length){
    $('.subnav a').on('click', function(e){
      e.preventDefault();
      var target = $(this.hash);
      $('body').removeClass('menu-open');
      $('#site-nav').removeClass('active'); //.one('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(ev){ $(this).off(ev); });
      $('body').animate({
        scrollTop: target.offset().top - 60
      }, 600);
    });
  }

  $('i[data-target="#teamMembersNav"]').on('click', function(){
    // console.log('click');
  });



  // functionality for the member nav
  if( $('#member-nav').length /*&& !is_touch_device()*/ ){
    var memberNav = $('#member-nav');
    $(window).scrollspy({ target: '#member-nav', offset:memberNav.height() });

    // scroll to member's section
    memberNav.find('a').on('click', function(e){
      e.preventDefault();
      var el = $(this);
      var target = $(this.hash);

      $('html,body').animate({
        scrollTop: target.offset().top - 57
      }, 400, function(){
        memberNav.find('li').removeClass('active');
        el.parent().addClass('active');
      });
    });

    // position sticky nav
    var stickyNavTop = memberNav.offset().top;
    var stickyNav = function(){
      var scrollTop = $(window).scrollTop();
      // console.log('scrollTop:' + scrollTop + ' | stickyNavTop:' + stickyNavTop);
      if (scrollTop > stickyNavTop) {
          if(!memberNav.hasClass('sticky')) memberNav.find('li:first-child').addClass('active');
          memberNav.addClass('sticky');

          if(navigator.userAgent){
            var agent = navigator.userAgent.toLowerCase();
            console.log('userAgent:' + agent);
            if(agent.indexOf('chrome') > 0 || agent.indexOf('firefox') > 0){
              $('body').css('paddingTop', memberNav.height());
            }
          }
      } else {
          memberNav.removeClass('sticky');
          $('body').removeAttr('style');
          memberNav.find('li').removeClass('active');
      }
    };

    stickyNav();

    $(window).on('scroll', function(){
      stickyNav();
    });
  }



  // select the first accordion panel
  $('#accordion .panel').first().find('.panel-heading a').click();
    $('#accordion .panel a').on('click', function(e){
      if( $('.menu-toggle').is(":visible") ){
        e.preventDefault();
        var target = $('#what-we-do');

        $('body').animate({
          scrollTop: target.position().top + ( $(this).parents('.panel').index() * 40 ) - 43
        }, 600);
      }
    });




  // create the google map
  if($('#map-canvas').length) {
    var map;
    var loc = new google.maps.LatLng($('#map-canvas').data('lat'), $('#map-canvas').data('lon'));

    function initialize() {
      var mapOptions = {
        zoom: 14,
        center: loc,
        draggable: (is_touch_device() == true) ? false : true,
        scrollwheel: false,
      };
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      new google.maps.Marker({
        position: loc,
        map: map,
        title: 'Lefkoff, Rubin, Gleason & Russo, P.C. Attorneys at Law'
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  }



  // Init Hero Carousel
  $('.hero-carousel').slick({
    dots:true,
    arrows:true
  });

  $('.hero-carousel').on('init', function(slick){
    $('.hero-carousel > button').wrapAll('<div class="carousel-buttons container"/>');
  });


}());







//var client = contentful.createClient({
//  accessToken: '0cf248aeac4a0a8960afdeb542151098f2d44565f292d41a5ecf86479ff2eec0',
//  space: 'vqey0myrs677'
//});
//
//
//$(function() {
//
//  client.contentType('tHGKzxN1W8WccSCycy4Sq').then(function (result, r2, r3, r4) {
//    console.log(result, r2, r3, r4);
//  }, function (result) {
//    console.log(result);
//  });
//});
