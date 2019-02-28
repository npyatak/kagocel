// Прижимаем футер к низу страницы
function footer_bottom() {
	var footer_h = $("footer").outerHeight();
	$(".wrapper").css("padding-bottom", footer_h);
	// alert(footer_h);
}

function header_top() {
	var header_h = $(".header_main").outerHeight();
	$(".after_header").css("padding-top", header_h);
	// alert(footer_h);
}


// функция задает минимальную высоту блоку если он один на станице
function one_block(){
	var header_h = $(".header_main").outerHeight();
	var footer_h = $(".main_footer").outerHeight();
	var all_height = $(window).height();

	var min_height = all_height - footer_h;
	// console.log(qqq);
	// console.log(header_h);
	// console.log(footer_h);
	// console.log(all_height);
	$(".min_h").css("min-height", min_height);
}

// Выполняем при загрузке и при ресайзе
$(document).ready(function(){
	function onResize(){
		setTimeout(function(){
			footer_bottom(); // функция кот. выполняется
			header_top();
			one_block();
		}, 200);
	}onResize();
	$(window).resize(onResize);
});





$(".burger_button").click(function() {
  // $(this).toggleClass("on");
  $(".burger_menu").slideDown(500);
  // $(".burger_menu").slideToggle(function(){
  	$("body").addClass("no_scroll");
  // });
});

$(".close_burger").on("click", function(){
	$(".burger_menu").slideUp(500);
	$("body").removeClass("no_scroll");
})


// бегунок громкости
// var $range = $(".volume_range");
// $range.ionRangeSlider({
//     type: "single",
//     step: 1,
//     min: 0,
//     max: 100,
//     from: 50, //начальное значение
//     hide_min_max: true,
// });


$(".volume_range").slider({
    value: 50,
    orientation: "horizontal",
    range: "min",
    animate: true
});





// слайдеры с треками 
$(function(){
	var el = $(".tracks_slider");
	if($("div").is(".tracks_slider")){ 
		// инициализируем слайдер в цикле
		el.each(function (e) {

			$(this).owlCarousel({ 
				loop: false, //Зацикливаем слайдер
				// margin:30, //Отступ от элемента справа в 50px
				nav:true, //Отключение навигации
				// autoplay:true, //Автозапуск слайдера
				smartSpeed:1000, //Время движения слайда
				autoplayTimeout:2000, //Время смены слайда
				navContainer: '.sl_nav_'+(e+1),
				dotsContainer: '.sl_dots_'+(e+1),
				// dotsEach: true,
				// autoHeight: true,
				items: 3,
				dots: true,
				navText:["<img src='img/arrow.svg'>","<img src='img/arrow.svg'>"],
				responsive:{ //Адаптивность. Кол-во выводимых элементов при определенной ширине.
				    320:{
				        items:1
				    },
				    479:{
				        items:2
				    },
				    769:{
				        items:2
				    },
				    992:{
				        items:3
				    },
				    1200:{
				        items:3
				    }
				}
			});
			// console.log(e);

		});
		
	}
});

// отключаем скролл слайдера при взаимодействии с бегунком звука
$(".volume_range_wrap").on("touchstart mousedown", function(e) {
    // Prevent carousel swipe
    e.stopPropagation();
})


// открываем-скрываем блок 
$(".show_archive span").on("click", function(){
	var el = $(this);
	el.parent().next().slideToggle(function(){
		el.children("i").toggleClass("active");
	});
});


// функция выравнивает блоки по высоте на ipad 
function match_height(){
	$(".tracks_slider").each(function(){
		var el = $(this);
		el.children().children().children().children().css("height", "auto");
		var height = el.outerHeight();
		// console.log(height);
		el.children().children().children().children(".track_item").css("height", height);
	})
}

if($("div").is(".tracks_slider")){
	setTimeout(function(){
		match_height();
	},200);

	$(window).resize(function(){
		setTimeout(function(){
			match_height();
		},300);
	});
} 












// $.each($(".track-item"), function(i,e)
// {
//   //store this li element's play-button in a variable
//   var triggerEl = $(e).find(".play-button");

//   Draggable.create(e,
//   {
//     //apply that as this particular li element's Draggable instance trigger
//     trigger: triggerEl,
//     type:"y",
//     edgeResistance:0.75,
//     bounds:".playlist",
//   });
// });




// кнопка запись 

$(".plus_minus .center").on("click", function(){
	$(this).parent().toggleClass("active");
});

$(".play_li").on("click", function(){
	$(this).toggleClass("active");
});

$(".record_img .play").on("click", function(){
	$(this).toggleClass("active");
});



// отключаем возможность перетаскивания изображений (некоторые браузеры дают такую возможность)
$('img').attr({
   "ondrag":"return false",
   "ondragdrop":"return false",
   "ondragstart":"return false"
})




// тут добавляем возможность интерактивно крутить пластинки 
// $.each($(".plate_wrap .plate"), function(i,e){
// 	// console.log($(this).attr("class"));

// 	Draggable.create(e, {
// 		type: "rotation", 
// 		throwProps: true,
// 	});
// });




// $(".red_letter").each(function(){
// 	var ths = $(this);
// 	var num = ths.data("number");
// 	var text = ths.html();
// 	var text = text.split(""); //делим текст по пробелу
// 	console.log(text);
// 	var text_count = parseInt(text.length); //количество букв в предложении

// 	var new_text = "";
// 	for(i=0; i < text_count; i++){
// 		if(i==num-1){
// 			new_text = new_text + "<span class='sn_bg'>"+text[i]+"</span> "; //если порядковый номер слова равен num тогда заворачиваем его в <span>
// 		}else{
// 			new_text = new_text + text[i]; //собираем строку
// 		}	
// 	}
// 	ths.html(new_text);
// });


// $(".rs_1").ionRangeSlider({
//     type: "single",
//     step: 1,
//     min: 0,
//     max: 100,
//     // hide_from_to: true,
//     hide_min_max: true,
//     from: 50, //начальное значение
//     // to: 25, //конечное значение
//     // hide_min_max: true,		//Прячет лейблы "min" и "max"
//     // hide_from_to: true, //Прячет лейблы "from" и "to"
//     // grid: false //нумерация сетки
// });




// $(".rsh_1").slider({
//     value: 50,
//     orientation: "horizontal",
//     range: "min",
//     animate: true
// });

$(".rsv").slider({
    value: 50,
    orientation: "vertical",
    range: "min",
    animate: true
});

$(".rsh_2").slider({
    value: 50,
    orientation: "horizontal",
    range: "min",
    animate: true
});



// стилизуем полосы прокрутки
$(window).on("load",function(){
	$(".playlist").mCustomScrollbar({
		axis:"y",
		mouseWheel: true, //отключаем скроллинг при листании колесом мыши
		scrollInertia: 500,
		// autoHideScrollba: true,
		// snapAmount: 20,
		mouseWheel:{ scrollAmount: 100, }
	});
});


// маска в инпут для телефона
$(".phone_mask").inputmask({
	"mask": "8(999) 999-9999",
	"clearIncomplete": true,	//проверяет заполнено ли поле
});
$(".input_1.date").inputmask({
	"mask": "99.99.9999",
	"clearIncomplete": true,	//проверяет заполнено ли поле
});



// видео rutube
$(function(){
	if($("iframe").is("#video_player")){
 
		var player = document.getElementById('video_player');

		setTimeout(function(){
			player.contentWindow.postMessage(JSON.stringify({
			    type: 'player:setSkinColor',
			    data: {
			    	color: 'f7323f'
			    }
			}), '*');
		},300);

		setTimeout(function(){
			player.contentWindow.postMessage(JSON.stringify({
				type: 'player:pause',
				data: {}
			}), '*');
		},500);



		var count = 0;
		var topPos = $('.video_section').offset().top;
		
		$(window).scroll(function() {
			var win_w = $(window).width();
			if(win_w > 992){
				var top = $(document).scrollTop(),
				    pip = $('.video_section').offset().top + $('.video_section').outerHeight();

				if (top > topPos && top < pip){
					if (count == 0) {
						player.contentWindow.postMessage(JSON.stringify({
							type: 'player:play',
							data: {}
						}), '*');
						// console.log("1")
						count++;
					}
				} 
				else if (top > pip) {
					if (count == 1) {
						player.contentWindow.postMessage(JSON.stringify({
							type: 'player:pause',
							data: {}
						}), '*');
						// console.log("2")
						count--;
					}
				}
				else {
					if (count == 1) {
						player.contentWindow.postMessage(JSON.stringify({
							type: 'player:pause',
							data: {}
						}), '*');
						// console.log("3")
						count--;
					}
				}
			}//if(win_w > 992)
		});




		// player.contentWindow.postMessage(JSON.stringify({
		// 	type: 'player:mute',
		// }), '*');

	}//if

})








// открываем - закрываем блоки на странице gallery
$(".all_show_button").on("click", function(){
	var el = $(this);
	el.toggleClass("active");
	el.next().slideToggle(700);
});


$(".section_name.show span").on("click", function(){
	var el = $(this);
	el.parent().toggleClass("active");
	el.parent().next().slideToggle(700);
});



// Открываем нужный попап
function show_popup(form_number){
	$("[data-flag="+form_number+"]").css("display","inline-block");
	$(".popup_bg").css('display','block').delay(100).queue(function () {  // delay() позволяет сделать паузу 
		$(".popup_bg").css('opacity', '1');
		$("body").css('overflow-y','hidden'); 
		$(".popup_bg").dequeue(); //должно применяться к тому же элементу что и .queue
	});
	// alert(form_number);
}

// show_popup(1);

function close_popup(){
	$(".popup_bg").css('opacity','0').delay(200).queue(function () {  // delay() позволяет сделать паузу между изменениями свойств
		$(".popup_bg").css('display', 'none');
		$("body").css('overflow-y','auto'); 
		$(".popup_bg .popup_block").css("display","none");
		$(".popup_bg").dequeue(); //должно применяться к тому же элементу что и .queue
		// $(".popup_form").css("display","none");
		//$("[data-form-ident="+form_number+"]").css("display","none"); заменил на верхнее если что пробуем этот вариант
	}); 
};

// Пот клике открываем попап
$(".open_form").on("click",function() {
	var form_number = $(this).data("form");
	show_popup(form_number);
});

// Закрываем попап
$(".popup_bg").on("click", function(){
	close_popup();
}).children().click(function(e){        // вешаем на потомков
	e.stopPropagation();   // предотвращаем распространение на потомков
});
$(".exit_popup, .close_popup").on("click", function(){
	close_popup();
});


$(document).on('click', 'a, button', function(e) {
    if(typeof $(this).attr('data-ga-click') !== 'undefined') {
        ga('send', 'event', 'click', $(this).attr('data-ga-click'));
    }
});