$(document).ready(function(){
	$(".menu").on("click","a", function (event) {
		//отменяем стандартную обработку нажатия по ссылке
		event.preventDefault();

		//забираем идентификатор бока с атрибута href
		var id  = $(this).attr('href'),

		//узнаем высоту от начала страницы до блока на который ссылается якорь
			top = $(id).offset().top - 40;
		
		//анимируем переход на расстояние - top за 1500 мс
		$('body,html').animate({scrollTop: top}, 500);
	});

	//ajax запросы для формы
	$('.flat-app-btn').on('click', function(event) {
		var data = {
			action: 'flatapp',
			flat_id: $(this).closest('form').find('.inp-hid').val(),
			phone: $('input[name=phone]').val()
		};
		$.post(window.wp.ajax_url, data, function(res) {

			if(res.success) {
				alert("YES");
			} else {
				alert("NO");
			}
		}, 'json');
	});
});