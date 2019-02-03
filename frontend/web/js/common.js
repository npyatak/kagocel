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
  	$(".burger_menu").slideDown(500);
  	$("body").addClass("no_scroll");
});

$(".close_burger").on("click", function(){
	$(".burger_menu").slideUp(500);
	$("body").removeClass("no_scroll");
})


// бегунок громкости
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