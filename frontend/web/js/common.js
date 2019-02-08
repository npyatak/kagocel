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

// Выполняем при загрузке и при ресайзе
$(document).ready(function(){
	function onResize(){
		setTimeout(function(){
			footer_bottom(); // функция кот. выполняется
			header_top();
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



// Крутилки на микшире
$.each($(".knob"), function(i,e){
	// console.log($(this).attr("class"));

	Draggable.create(e, {
		type: "rotation", 
		throwProps: true,
		// trigger: $(this),
		// dragClickables: true,
		// minimumMovement: 10,
		bounds:{minRotation:-140, maxRotation:140},
		// allowNativeTouchScrolling: false,
		onDrag: function(){
			
					var parent = $(this.target).parent();
					// console.log(parent);

					//  вращаем элемент вместе с крутилкой 
					parent.children(".color_circle").css("transform","rotate("+ this.rotation +"deg)");

					if(this.rotation <= 0){
						parent.children(".color_circle").addClass("left");
						parent.children(".grey_circle").addClass("right");
						// parent.css("background-color","#fff")
					}else{
						parent.children(".color_circle").removeClass("left");
						parent.children(".grey_circle").removeClass("right");
					}


				},

	});


});




// кнопка запись 
$(".recording_button").on("click", function(){
	$(this).toggleClass("active");
});

$(".plus_minus .center").on("click", function(){
	$(this).parent().toggleClass("active");
});

$(".play_stop").on("click", function(){
	$(this).toggleClass("active");
	$(this).parent().prev().children(".plate_wrap .handle").toggleClass("active");
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
$.each($(".plate_wrap .plate"), function(i,e){
	// console.log($(this).attr("class"));

	Draggable.create(e, {
		type: "rotation", 
		throwProps: true,
	});
});




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




$(".rsh_1").slider({
    value: 50,
    orientation: "horizontal",
    range: "min",
    animate: true
});

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



// Стилизуем селекты
$(".select_type_1").styler({
	// selectPlaceholder: "Выберите услугу",
	selectVisibleOptions:10, // Кол-во отображаемых пунктов в селекте без прокрутки.
	onSelectOpened: function() {
		$(this).css('width', '100%');
	}
});


// маска в инпут для телефона
$(".phone_mask").inputmask({
	"mask": "8(999) 999-9999",
	"clearIncomplete": true,	//проверяет заполнено ли поле
});





$(function(){

	setTimeout(function(){

// alert("sdfsdf");

	var player = document.getElementById('video_player');
	player.contentWindow.postMessage(JSON.stringify({
	    type: 'player:setSkinColor',
	    // type: 'player:remove',
	    data: {
	    	color: 'f7323f'
	        // params: {
	        //     color: '000000' // цвет в RGB, HEX (без решетки)
	        // }
	        
	    }
	}), '*');



},300);

})