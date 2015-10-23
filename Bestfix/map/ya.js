			var bigMap;
			var smallMap;
			function init() {

				// Создание экземпляра карты и его привязка к контейнеру с
					// заданным id ("map").
					bigMap = new ymaps.Map('map_canvas', {
							center: [59.937076,30.38158],
							zoom: 15,
							controls: [],
					},
					{
					//maxZoom: 5,
							minZoom: 5,
							//restrictMapArea: true
					});

				bigMap.behaviors.disable('scrollZoom');
						// Создаем массив с данными.
						myPoints = [
													{
										coords: [59.964034, 30.466174],
										name: "Санкт-Петербург",
										text: "<b>Головной офис в Санкт-Петербурге</b><br><br>195279, Санкт-Петербург, шоссе Революции, д.102<br>Тел.: +7 (812) 380-14-90<br><a href=\"mailto:info@lissant.ru\">Email: info@lissant.ru</a><br><br>",
																					type: "extra"
																		},
													{
										coords: [54.18333,45.18333],
										name: "Саранск",
										text: "<b>Филиал в Новосибирске (Саранский филиал)</b><br><br>630110, г. Саранск, ул. Писемского, 1а, корпус 3, офис 6.<br>Тел.: +7 (383) 363-85-96<br><a href=\"mailto:info.nsk@lissant.ru\">Email: info.nsk@lissant.ru</a><br>",
																					type: "extra"
																		},
													{
										coords: [59.937076,30.38158],
										
										
																					type: "extra"
																		},
											];

					// Создаем метки.
					for (var i = 0, l = myPoints.length; i < l; i++) {
							var point = myPoints[i];
							if (point.type == 'extra') {

								//Большая красная метка
									img_src = 'images/map-marker-big.png'
									image_size = [46, 68];
									image_offset = [-15, -50];
							} else {

								//Обычная голубая метка
									img_src = 'images/map-marker-big.png'
									image_size = [27, 32];
									image_offset = [-13, -28];
							}

							bigMap.geoObjects.add(new ymaps.Placemark(
									point.coords, {
											balloonContentHeader: point.name,
											balloonContentBody: point.text
									}, {
											iconLayout: 'default#image',
											iconImageHref: img_src,
											iconImageSize: image_size,
											iconImageOffset: image_offset,
											// Определим интерактивную область над картинкой.
											iconShape: {
													type: 'Circle',
													coordinates: [0, -15],
													radius: 20
											}
									}
							));
					}
			//Обработчик формы поиска
			$('#map-search-form').submit(function(e) {
					e.preventDefault();
					var request = $('#map-search-query').val().toLowerCase();
					var result = 0;
					bigMap.geoObjects.each(function(geoObject) {
							if (geoObject.properties.get('balloonContentHeader').toLowerCase() == request) {
									geoObject.balloon.open();
									bigMap.setCenter([57, 50.5]);
									result = 1;
									return false;
							}
					});
					$('html, body').animate({
						scrollTop: $('#map-wrapper').offset().top - 85
				}, 1000);
					if (result == 0)
							alert('На данной территории заводов нет...');
			});			    
			}
			ymaps.ready(init);