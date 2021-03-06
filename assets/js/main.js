var base = $('base').attr('href');

function getUrlParameter(sParam) {

  "use strict";

    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
  }
};

function captchaCallback() {
  //  Initialize Recaptcha
  var captchas = document.querySelectorAll('.recaptcha_el');

  if (captchas.length) {
    captchas.forEach(function(element, index) {
      grecaptcha.render(element, {
        "sitekey": '6LcbFjEUAAAAAJ141oYZru2ccF20qQ6nCdXaF25U',
      });
    });
  }
}


/**
 * Carrega os componentes principais: header, nav, footer
 */
function loadComponents() {
  if ($('.load-me').length) {
    $('.load-me').each(function() {
      var src = $(this).data('src');
      var rand = Math.floor((Math.random() * 100) + 1);
      $(this).load(src + "?" + rand);
    })
  }
}

$(function() {

    $.ajax({
      url : base + "server/verifica-login.php",
      type : 'post',
      dataType : 'json',
      success : function(res) {
        var n = $('#login-form').length;
        if (res.status == false && !n) {
          document.location.href = base + "index.html";
        }
      }
    });

    $(document).on("click", ".logout", function(e) {
      e.preventDefault();
      $.ajax({
        url : base + "server/req-loggout.php",
        type : 'post',
        dataType : 'json',
        success : function(res) {
          if (res == 1) {
            document.location.href = base + "index.html";
          }
        }
      });
    });

    /**
     * jQuery Masks
     */
    /* */
    var SPMaskBehavior = function(val) {
      return val.replace(/\D/g, "").length === 11 ?
        "(00) 00000-0000" :
        "(00) 0000-00009";
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    };
    $(".cel-field").mask(SPMaskBehavior, spOptions);
    $('.tel-field').mask('(00) 0000-0000');
    $(".cpf-field").mask('000.000.000-00');
    $(".cnpj-field").mask('00.000.000/0000-00');    
    $(".date-field").mask('00/00/0000');    
    $('.money').mask('#.##0,00', {reverse: true});    
    
    $.fn.etapas = function(direcao) {
      var _t = this;
      var active_index;
      var etapas_length = _t.find('> div').length;
      if (direcao == 'next') {
          active_index = _t.find('> div.active').index();          
          if (active_index < (etapas_length - 1)) {
              _t.find('> div.active').removeClass('active');
              _t.find('> div').eq(active_index + 1).addClass('active');
          }
      }
      if (direcao == 'prev') {
          active_index = _t.find('> .active').index();
          if (active_index > 0) {
              _t.find('> div.active').removeClass('active');
              _t.find('> div').eq(active_index - 1).addClass('active');
          }
      }
      return true;
    }




    /**
     * Set Sticky Header
     */
    if ($('.header-sticky').length) {
      var sc;
      $(window).on('scroll', function() {
        sc = $(window).scrollTop();
        if (sc > 300) {
          $('header').addClass('page-scrolled');
        } else {
          $('header').removeClass('page-scrolled');
        }
      });
    }

    /**
     * Set Home Page Banner
     */
    if ($('.main-banner').length) {
      var mainBanner = $('.main-banner .owl-carousel');
      mainBanner.on('resize.owl.carousel', function() {
        var _ww = $(window).width();
        var _hh = $('header').height();
        if (_ww > 1200) {
          var _wh = $(window).height();
          mainBanner.trigger('refresh.owl.carousel');
          mainBanner.find('.item').css({'padding-bottom':'0', 'height' : (_wh - _hh) + 'px'});
        } else {
          var _wh = $(window).height();
          mainBanner.trigger('refresh.owl.carousel');
          mainBanner.find('.item').css({'padding-bottom' : '50%', 'height' : '0px'});
        }
      });
      mainBanner.on('initialized.owl.carousel', function() {
        var _hh = $('header').height();
        var _wh = $(window).height();
        var _ww = $(window).width();
        if (_ww > 1200) {
          mainBanner.find('.item').height(_wh - _hh).css('padding-bottom', '0');
        } else {
          mainBanner.find('.item').height(0).css('padding-bottom', '50%');
        }
      });
      mainBanner.owlCarousel({
        items: 1,
        loop: true,
        smartSpeed: 1200,
        autoplay: true,
        autoplayTimeout: 7000,
        stopOnHover: false,
        lazyLoad: true,
        dots: true,
        nav: true,
        navText: [
          '<img src=\"' + base + 'images/icons/prev.png\">',
          '<img src=\"' + base + 'images/icons/next.png\">'
        ]
      });
    }

    /**
     * Custom generic carousel
     */
    if ($('.basic-carousel').length) {
      $('.basic-carousel').each(function() {
        var _items = $(this).data('items') ? $(this).data('items') : 1;
        var _itemsTablet = $(this).data('items-tablet') ? $(this).data('items-tablet') : 1;
        var _itemsPhone = $(this).data('items-phone') ? $(this).data('items-phone') : 1;
        var _lazy = $(this).data('lazy') ? $(this).data('lazy') : false;
        var _nav = $(this).data('nav') ? $(this).data('nav') : false;
        var _margin = $(this).data('margin') ? $(this).data('margin') : 0;
        var _dots = $(this).data('dots') ? $(this).data('dots') : false;
        var _loop = $(this).data('loop') ? $(this).data('loop') : false;
        var _speed = $(this).data('speed') ? $(this).data('speed') : 1000;
        var _autoplay = $(this).data('autoplay') ? $(this).data('autoplay') : false;
        var _autoplayTime = $(this).data('autoplay-time') ? $(this).data('autoplay-time') : '5000';
        var _autowidth = $(this).data('autowidth') ? $(this).data('autowidth') : false;
        var _autoheight = $(this).data('autoheight') ? $(this).data('autoheight') : false;
        var _anim_in = $(this).data('anim-in') ? $(this).data('anim-in') : '';
        var _anim_out = $(this).data('anim-out') ? $(this).data('anim-out') : '';
        var _drag = $(this).data('drag') ? $(this).data('drag') : 'true';
        var _stop = $(this).data('stop') ? $(this).data('stop') : 'true';
        $(this).owlCarousel({
          items: _items,
          margin: 15,
          lazyLoad : _lazy,
          dots : _dots,
          margin: _margin,
          smartSpeed : _speed,
          stopOnHover : true,
          autoplay : _autoplay,
          autoplayTimeout : _autoplayTime,
          autoHeight : _autoheight,
          autoWidth : _autowidth,
          nav : _nav,
          navText: [
            '<img src=\"' + base + 'images/icons/grad-left.png\">',
            '<img src=\"' + base + 'images/icons/grad-right.png\">'
            // '<i class="fa fa-angle-left"></i>',
            // '<i class="fa fa-angle-right"></i>'
          ],
          animateIn : _anim_in,
          animateOut : _anim_out,
          loop : _loop,
          mouseDrag : _drag,
          touchDrag : _drag,
          pullDrag : _drag,
          freeDrag : _drag,
          responsive: {
            0: {
              items: _itemsPhone
            },
            769: {
              items: _itemsTablet
            },
            1200: {
              items: _items
            }
          }
        });
      });
    }

    /**
     * Responsivo Header Menu Toggler
     */
    if ($('.navbar-toggler').length) {
      $(document).on('click', '.navbar-toggler', function() {
        var altimg = 'images/icons/menu-alt.png';
        var img = 'images/icons/menu.png';
        if ($(this).hasClass('expanded')) {
          $(this).removeClass('expanded');
          $(this).find('img').attr('src', img);
        } else {
          $(this).addClass('expanded');
          $(this).find('img').attr('src', altimg);
        }
      });
    }

    /**
     * Nav component
     */
    if ($('#nav-component').length) {
      $(document).on('click', '#nav-component .nav-link', function() {        
        var tab = $(this).data('tab');
        if ($(this).hasClass('active')) {
          return false;
        } else {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');
          $('#nav-area .nav-area-item').removeClass('active');          
          $(tab).addClass('active');  
          $(this).removeAttr('onclick');        
        }
      });
    }

    /**
     * Limit length of a text
     */
    if ($('.limit-text').length) {
      $('.limit-text').each(function() {
        var text = $(this).text();
        var len = $(this).data('length');
        if (text.length > len) {
          text = text.substring(0, len);
          $(this).text(text + '...');
        }
      });
    }

    /**
     * Set zoom on hover
     */
    if ($('.zoom-wrapper').length) {
      var _zoom = $('.zoom-wrapper').data('zoom');
      $('.zoom-wrapper').zoom({
        url: _zoom,
        touch: true,
        duration: 1000,
        on : 'click'
      });
    }

    /**
     * Set a select input to redirect on change
     */
    if ($('.select-href').length) {
      var _href;
      $('.select-href').change(function() {
        _href = $(this).val();
        if (_href) {
          document.location.href = _href;
        }
      });
    }

    /**
     * Set play button on a video cover
     * */
    if ($('.yt-player').length && $('.video-frame').length) {
      $('.video-frame').on('click', '.video-frame-play', function() {
        $(this).closest('.video-frame').addClass('playing-video');
        var _vid = $(this).closest('.video-frame').find('iframe').attr('id');
        var _p = YT.get(_vid);
        _p.playVideo();
      });
    }

    /**
     * Set form functionalities
     */
    if ($('form').length) {

      // Validator for CPF field
      jQuery.validator.addMethod("testCPF", function(value, element) {
        var Soma;
        var Resto;
        Soma = 0;
        value = value.replace('.', '');
        value = value.replace('.', '');
        value = value.replace('-', '');
        if (value == "00000000000" ||
          value == "11111111111" ||
          value == "22222222222" ||
          value == "33333333333" ||
          value == "44444444444" ||
          value == "55555555555" ||
          value == "66666666666" ||
          value == "77777777777" ||
          value == "88888888888" ||
          value == "99999999999") return false;
        for (i = 1; i <= 9; i++) Soma = Soma + parseInt(value.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;
        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(value.substring(9, 10))) return false;
        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(value.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;
        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(value.substring(10, 11))) return false;
        return true;
        return this.optional(element) || (parseFloat(value) > 0);
      }, "CPF inválido.");

      // CNPJ validation rule method
      jQuery.validator.addMethod("testCNPJ", function(c, element) {
        var b = [6,5,4,3,2,9,8,7,6,5,4,3,2];

        if((c = c.replace(/[^\d]/g,"")).length != 14) return false;

        if(/0{14}/.test(c)) return false;

        for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
        if(c[12] != (((n %= 11) < 2) ? 0 : 11 - n)) return false;

        for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
        if(c[13] != (((n %= 11) < 2) ? 0 : 11 - n)) return false;

        return true;
      }, "CNPJ Inválido");


      // Validator to check if a date is valid and not a future date
      jQuery.validator.addMethod("testDate", function(value, element) {
        var state = false;
        if ($(element).prop('required') === false && value.length === 0) {
          state = true;
        } else {
          if (value.length != 10) {
            return false;
          } else {
            var DateArr = value.split("/");
            var day = DateArr[0];
            var month = DateArr[1];
            var year = DateArr[2];
            if (month == '01' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '02') {
              if (leapYear(year)) {
                if ((parseInt(day) > 0 && parseInt(day) <= 29)) {
                  state = true;
                }
              } else {
                if ((parseInt(day) > 0 && parseInt(day) <= 28)) {
                  state = true;
                }
              }
            } else if (month == '03' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '04' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '05' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '06' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '07' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '08' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '09' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '10' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '11' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '12' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; }
            var field_year = new Date(parseInt(year), (parseInt(month) - 1), parseInt(day));
            var todayDate = new Date();
            if (todayDate < field_year) {
              state = false;
            }
          }
        }
        return state;
      }, "Data inválida");

      
      // Validator to check if a date is valid and not a future date
      jQuery.validator.addMethod("testDate2", function(value, element) {
        var state = false;
        if ($(element).prop('required') === false && value.length === 0) {
          state = true;
        } else {
          if (value.length != 10) {
            return false;
          } else {
            var DateArr = value.split("/");
            var day = DateArr[0];
            var month = DateArr[1];
            var year = DateArr[2];
            if (month == '01' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '02') {
              if (leapYear(year)) {
                if ((parseInt(day) > 0 && parseInt(day) <= 29)) {
                  state = true;
                }
              } else {
                if ((parseInt(day) > 0 && parseInt(day) <= 28)) {
                  state = true;
                }
              }
            } else if (month == '03' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '04' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '05' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '06' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '07' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '08' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '09' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '10' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; } else if (month == '11' && (parseInt(day) > 0 && parseInt(day) <= 30)) { state = true; } else if (month == '12' && (parseInt(day) > 0 && parseInt(day) <= 31)) { state = true; }
          }
        }
        return state;
      }, "Data inválida");

      // Validator - changing default config for better highlights
      jQuery.validator.setDefaults({
        highlight: function(element, errorClass) {
          $(element).closest('.form-group').addClass('has-error').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass) {
          $(element).closest('.form-group').removeClass('has-error').addClass('is-valid');
        }
      });

      // Call form validation
      $('.form-submit, .form-validate').each(function() {
        $(this).validate({
          focusInvalid: false,
          rules : {
            "cpf" : { testCPF: true, required: true },
            "cnpj" : { testCNPJ: true, required: true },
            password : 'required',
            confirm: {
                equalTo: '#input-password'
            }
          }
        });
      });

      if ($('.see-password').length) {
        $(document).on('click', '.see-password', function() {
          var parent = $(this).closest('.form-group');
          if ($(this).find('.fa').hasClass('fa-square-o')) {
            $(this).find('.fa').removeClass('fa-square-o').addClass('fa-check-square');
            parent.find('input').attr('type', 'text');
          } else {
            $(this).find('.fa').removeClass('fa-check-square').addClass('fa-square-o');
            parent.find('input').attr('type', 'password');
          }
        });
      }

    }


    /**
     * Custom link
     */
    if ($('.btn-a')) {
      $('.btn-a').on('click', function() {
        var href = $(this).data('href');
        setTimeout(function() {
          document.location.href = href;
        }, 800);
      });
    }

    /**
     * Set background on an element
     */
    if ($('.bk').length) {
      $('.bk').each(function() {
        var bk = $(this).data('bk');
        $(this).css('background-image', 'url(' + bk + ')');
      });
    }

    /**
     * Set scroll-to-top button
     */
    if ($('.scroller').length) {
      $(".scroller").click(function() {
        var windowPosition = $(window).scrollTop();
        var windowHeight = $(window).height();
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
          $('html, body').animate({
            scrollTop : 0
          });
        } else {
          $('html, body').animate({
            scrollTop : $(window).scrollTop() + windowHeight
          });
        }
      });
      $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
          $('.scroller img').addClass('rotate-180');
        } else {
          $('.scroller img').removeClass('rotate-180');
        }
      });
    }

    /**
     * Set custom file input
     */
    if ($('.file-input').length) {
      $('.file-input').on('change', '.input-file', function() {
        var fileName = $(this).val().replace("C:\\fakepath\\","");
        if (fileName) {
          $(this).siblings('span').text(fileName);
          $(this).parent().addClass('has-file');
        } else {
          var message = $(this).siblings('span').data('message');
          $(this).siblings('span').text(message);
          $(this).parent().removeClass('has-file');
        }
      });
    }

    /**
     * Set smooth anchor scrolling
     */
    if ($('.scroll-to').length) {
      $('.scroll-to').click(function(e) {
        e.preventDefault();
        var anchor = $(this).attr('href');
        var pos = $(anchor).offset().top + $(window).height();
        $('html, body').animate({
          scrollTop: pos
        }, 1200, function() {
          $(anchor).find('input[type=\"text\"]').eq(0).focus();
        });
      });
    }

    /**
     * Set Venobox Plugin
     */
    if ($('.venobox').length) {
      $('.venobox').venobox({
          titleattr: 'data-title'
      });
    }

    /**
     * Custom File Input Config
     */
    if ($('.file-label').length) {
      $(document).on('change', '.file-label input', function() {
        var path = $(this).val();
        if (path) {
          var filename = path.replace(/^.*\\/, "");
          $(this).closest('.file-label').addClass('has-file').find('span').html('<i class="fa fa-times"></i> ' + filename);
        } else {
          $(this).closest('.file-label').removeClass('has-file').find('span').html('<i class="fa fa-upload"></i> Escolha um arquivo para enviar');
        }
      });
      $(document).on('click', '.file-input .fa-times', function(e){
        e.preventDefault();
        $(this).closest('.file-input').find('input[type="file"]').val('');
        $(this).closest('.file-label').removeClass('has-file').find('span').html('<i class="fa fa-upload"></i> Escolha um arquivo para enviar');
      });
    }

    /**
     * Field selector for Custom Checkbox
     */
    if ($('.field-selector').length) {
      $(document).on('change','.field-selector .custom-control-input', function() {
        var _target = $(this).val();
        $(this).closest('.field-selector').find('.form-group').removeClass('active');
        $(this).closest('.field-selector').find('[name=\"' + _target + '\"]').closest('.form-group').addClass('active');
      });
    }

    $(document).on('click', '.btn-drop', function() {
      if ($(this).find('.drop-area').hasClass('active')) {
        $(this).find('.drop-area').removeClass('active');
      } else {
        $(this).find('.drop-area').addClass('active');
      }
    });

  /**
   * Eventos que permitem ao usuário editar um formulário que está como readonly.
   */
  $(document).on('click', '.edit-form', function() { // Começar a editar
    $('.editable-form').removeClass('editing').addClass('disabled');
    $(this).closest('.form-group').find("button").toggle();
    $(this).closest('form').find('input, select').prop('readonly', false);
    $(this).closest('form').find('.custom-control-holder').removeClass('disabled');
    $(this).closest('form').removeClass('disabled').addClass('editing');
    $(this).closest('form').find('input').eq(0).focus();
  });

  $(document).on('click', '.cancel-form', function() { // Cancelar edição
    $(this).closest('.form-group').find("button").toggle();
    $(this).closest('form').find('input, select').prop('readonly', true);
    $(this).closest('form').find('.custom-control-holder').addClass('disabled');
    $(this).closest('form').addClass('disabled').removeClass('editing');
  });

  $(document).on('submit', '.editable-form.editing', function(e) { // Salvar edição
    e.preventDefault();
    var _this = $(this);
    var _url = _this.attr('action');
    var _btn = _this.find('button:submit').html();
    _this.find('button:submit').html('<i class="fa fa-refresh fa-spin"></i>');
    var _dados = _this.serialize();
    $.ajax({
      url: $('base').attr('href') + _url,
      data: _dados,
      method: "post",
      success: function(res) {
        if (res == 1) {
          swal({
          "title" : "Sucesso!",
          "text" : "Suas informações foram salvas com sucesso!",
          "icon" : "success"
          }).then(function() {
            setTimeout(function() {
              _this.find("button:submit").html(_btn);
              _this.find('button:submit').closest('.form-group').find("button").toggle();
              _this.find('input, select').prop('readonly', true);
              _this.find('.custom-control-holder').addClass('disabled');
              _this.addClass('disabled').removeClass('editing');
            }, 50);
          });
        } else {
          swal({
            "title" : "Erro!",
            "text" : "Não foi possível salvar seus dados!",
            "icon" : "error"
          }).then(function() {
            setTimeout(function() {
              _this.find("button:submit").html(_btn);
              _this.find('input').eq(0).focus();
            }, 50);
          });
        }
      },
      error: function(x, y, z) {
        _this.find('button:submit').html(_btn);
        console.error(x);
        console.error(y);
        console.error(z);
        _this.find('button:submit').closest('.form-group').find("button").toggle();
        _this.find('input, select').prop('readonly', true);
        _this.find('.custom-control-holder').addClass('disabled');
        _this.addClass('disabled').removeClass('editing');
      }
    });
  });

  $(document).on('click', '.link-to', function() {
    var _t = $(this);
    _t.addClass('pulse-single');
    var to = $(this).data('to');
    setTimeout(function() {
      _t.removeClass('pulse-single');
      document.location.href = to;
    },600);
  });

  /**
   * Adicionar uma vaga aos favoritos
   */
  $(document).on('click', '.favoritar', function() {
    var _t = $(this);
    var id = $(this).data('id');
    if (!id) return false;
    var url = base + 'server/favoritar.php';
    $.ajax({
      url: url,
      data: "&id=" + id,
      method: "post",
      dataType: "json",
      beforeSend: function() {
        _t.find('i.fa')
          .removeClass('fa-star-o')
          .addClass('fa-refresh fa-spin');
      },
      success: function(res) {
        if (res.status == "success") {
          _t.removeClass("favoritar")
            .addClass("active")
            .html("<i class='fa fa-star'></i> Favorito");
        } else {
          _t.find('i.fa')
          .removeClass('fa-refresh fa-spin')
          .addClass('fa-star-o');
        }
        swal({
          icon : res.status,
          title : res.title,
          text : res.mensagem
        })
      },
      error: function() {
        _t.find('i.fa')
        .removeClass('fa-refresh fa-spin')
        .addClass('fa-star-o');
        swal({
          icon : "error",
          title : "Erro",
          text : "Não foi possível adicionar esse item aos favoritos"
        })
      }
    });
  });

  /**
   * Adicionar um aviso aos favoritos
   */
  $(document).on('click', '.favoritar-aviso', function() {
    var _t = $(this);
    var id = $(this).data('id');
    if (!id) return false;
    var url = base + 'server/favoritar-aviso.php';
    $.ajax({
      url: url,
      data: "&id=" + id,
      method: "post",
      dataType: "json",
      beforeSend: function() {
        _t.find('i.fa')
          .removeClass('fa-star-o')
          .addClass('fa-refresh fa-spin');
      },
      success: function(res) {
        if (res.status == "success") {
          _t.removeClass("favoritar")
            .addClass("active")
            .html("<i class='fa fa-star'></i> Favorito");
        } else {
          _t.find('i.fa')
          .removeClass('fa-refresh fa-spin')
          .addClass('fa-star-o');
        }
        swal({
          icon : res.status,
          title : res.title,
          text : res.mensagem
        })
      },
      error: function() {
        _t.find('i.fa')
        .removeClass('fa-refresh fa-spin')
        .addClass('fa-star-o');
        swal({
          icon : "error",
          title : "Erro",
          text : ":Não foi possível adicionar esse item aos favoritos"
        })
      }
    });
  });

  /**
   * Candidatar a uma vaga
   */
  $(document).on('click', '.candidatar', function() {
    var _t = $(this);
    var id = $(this).data('id');
    if (!id) return false;
    var url = base + 'server/candidatar.php';
    $.ajax({
      url: url,
      data: "&id=" + id,
      method: "post",
      dataType: "json",
      beforeSend: function() {        
        _t.find('i.fa')
          .removeClass('fa-circle-o')
          .addClass('fa-refresh fa-spin');
      },
      success: function(res) {
        if (res.status == "success") {
          _t.removeClass("candidatar")
            .addClass("active")
            .html("<i class='fa fa-check-circle'></i> Concorrendo");
        } else {
          _t.find('i.fa')
          .removeClass('fa-refresh fa-spin')
          .addClass('fa-circle-o');
        }
        swal({
          icon : res.status,
          title : res.title,
          text : res.mensagem
        });
      },
      error: function() {
        _t.find('i.fa')
          .removeClass('fa-refresh fa-spin')
          .addClass('fa-circle-o');
        swal({
          icon : "error",
          title : "Erro",
          text : "Sua candidatura não pôde ser confirmada para esta vaga"
        })
      }
    });
  });

  
  
  /** jQuery : funções personalizadas */
  jQuery.fn.extend({

    // Configurações para exibir Spinner em botões
    btnLoader: function ($state) {  
      var _t = $(this).find('button:submit');    
      var btn_html = _t.html(); 
      var btn_width = _t.width(); 
      if ($state == "init") {
        _t.attr("data-html", btn_html);        
        _t.width(btn_width); 
        _t.html("<i class='fa fa-refresh fa-spin'></i>");
      } else if ($state == "stop") {
        _t.html(_t.data('html'));
      }
    },

    // Mostra o alert de um formulário
    zalert: function ($text, $type) {
      
      var al = $(this).find('.alert');

      if (!($text && $type)) {
        console.log($text + " - " + $type);
        al.html('')
          .hide()
          .removeClass()
          .addClass('alert');
        return 
      } 

      al.html('')    
      .removeClass()
      .addClass('alert');
      al.html($text);
      if ($type == 'success') {
        al.addClass("alert-success");
      } else if ($type == 'error') {
        al.addClass("alert-error");
      }
      al.show();
      
    }
    

  });


  loadComponents();

});

window.onload = function() {
  $('.loader').fadeOut();
}
