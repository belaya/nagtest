$('document').ready(function() { //объектная модель готова к использованию

    var pFloat = function(s){ // функция конвертирования к денежному формату
        return (s !== null ? parseFloat(s).toFixed(2) : ' — ');
    };

    var $but; 

    $('#period').on('submit',function(e) {
        e.preventDefault();
        $but = $(this).find('button'); //кнопка submit
        $but.prop('disabled',true); //деактивируем кнопку submit
        $.ajax({
              url: 'main/ajax',
              type: $(this).attr('method'),
              data: new FormData( this ),
              processData: false,
              contentType: false,
              success: function(res){ //Запрос выполнился успешно

                if (res){ // Получаем данные из ajax запроса
    			      
                  var arr = $.parseJSON(res); 
    			      
                  $('#report').removeClass('d-none'); //Покажем таблицу отчета
    			        $('#list').html(''); //Очистим строки таблицы отчета
        				
                	$.each(arr,function(index,value){ //разбираем JSON
        						$('#list').append(
        							$('<tr>') //Добавляем строки и ячейки
        							.append($('<td>', { 'text': value.typename}))
        							.append($('<td>', { 'text': pFloat(value.balans) }))
        							.append($('<td>', { 'text': pFloat(value.incom) }))
        							.append($('<td>', { 'text': pFloat(value.cost) }))
        							.append($('<td>', { 'text': pFloat(value.recalc) }))
        							.append($('<td>', { 'text': pFloat(value.itog) }))
        						);
        					});
                }
              	
                $but.prop('disabled',false); //активируем кнопку submit
              },
              //Ошибка выполнения запроса
      			  error: function(){
      			     $but.prop('disabled',false); //активируем кнопку submit
      			     return false;
      			  }
        });

    });
});
