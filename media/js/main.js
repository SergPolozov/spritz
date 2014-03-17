$(document).ready(function() {

      $('.logo_answer_send').on('click', function(){
	  $('.wrap_send_message_two_popup').show();
      });
      
      $('#wrap_send_message_two_close').on('click', function(){
	  $('.wrap_send_message_two_popup').hide();
      });
      
      $('#send_message_two').on('click', function(){
      
          var text = $('#send_message_two_text').val();
          var name = $('#send_message_two_name').val();
	  var email = $('#send_message_two_email').val();
	  
	  var error = '';
	  
	  if(name == ''){
	      error = error+'Поле имя не заполнено\n';
	  }
	  if(email == ''){
	      error = error+'Поле e-mail не заполнено\n';
	  }
	  if(text == ''){
	      error = error+'Сообщение не заполнено\n';
	  }
	  
	  if(error == '')
	  {
	      $('.wrap_send_message_two').hide();
	      $('.loader_send_message_two').show();
	      $.ajax({
		      type: "POST",
		      url: "/ajax/send_message",
		      data: {
			  text: text,
			  name:name,
			  email:email
		      },
		      beforeSend: function(){

		      },
		      success: function(data){
			  $('.loader_send_message_two').hide();
			  $('.success_send_message_two').show();
			  if(data == '1'){
			      $('.success_send_message_two').html('Сообщение отправлено!');
			  }
			  else{
			      $('.success_send_message_two').html('Ошибка отправки');
			      $('.wrap_send_message_two').show();
			  }
		      }
	      });
	  }
	  else
	  {
	      alert(error);
	  }
          return false;
      });
  
  
      $('#send_message_one').on('click', function(){
      
          var text = $('#send_message_one_text').val();
          var name = $('#send_message_one_name').val();
	  var email = $('#send_message_one_email').val();
	  var phone = $('#send_message_one_phone').val();
	  
	  var error = '';
	  
	  if(name == ''){
	      error = error+'Поле имя не заполнено\n';
	  }
	  if(email == ''){
	      error = error+'Поле e-mail не заполнено\n';
	  }
	  if(phone == ''){
	      error = error+'Поле телефон не заполнено\n';
	  }
	  if(text == ''){
	      error = error+'Сообщение не заполнено\n';
	  }

	  
	  if(error == '')
	  {
	      $('.wrap_send_message_one').hide();
	      $('.loader_send_message_one').show();
	      $.ajax({
		      type: "POST",
		      url: "/ajax/send_message",
		      data: {
			  text: text,
			  name:name,
			  phone:phone,
			  email:email
		      },
		      beforeSend: function(){

		      },
		      success: function(data){
			  $('.loader_send_message_one').hide();
			  $('.success_send_message_one').show();
			  if(data == '1'){
			      $('.success_send_message_one').html('Сообщение отправлено!');
			  }
			  else{
			      $('.success_send_message_one').html('Ошибка отправки');
			      $('.wrap_send_message_one').show();
			  }
		      }
	      });
	  }
	  else
	  {
	      alert(error);
	  }
          return false;
      });
  
  
  
    $('.main_slider_but').on('click', function(){
        $('#main_slider_buts .active').removeClass('active');
        $(this).addClass('active');
        $('.main_slider_one_item').hide();
        var id = $(this).data('id');
        $('#'+id).fadeIn('slow');
    });

    setInterval( function() {
        var id = $('#main_slider_buts .active').next('.main_slider_but');

        if(id.length == 0)
        {
            $('#main_slider_buts').children('.main_slider_but:first').trigger('click');
        }
        else
        {
            $('#main_slider_buts .active').next('.main_slider_but').trigger('click');
        }

    } , 5000);
  
  
    $('.menu span').mouseover(function() {
  
	$(this).find('.sub-menu:first').show();
	var width = $(this).width();
	if(width<110)
	{
	    var left = '100px';
	}
	else
	{
	    var left = '43%';
	}
	$(this).find('.sub-menu:first').css('left','-'+left);
      
    }).mouseout(function() { 
    
	$(this).find('.sub-menu:first').hide();
    });
    
    $('.sub-menu .menu-item').mouseover(function() {
  
	$(this).find('.sub-menu:first').show();
      
    }).mouseout(function() { 
    
	$(this).find('.sub-menu:first').hide();
    });
});