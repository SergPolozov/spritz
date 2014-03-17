<?php
$settings = ORM::factory("settings")->where('id','=',"1")->find();
$map = ORM::factory("settings")->where('id','=',"4")->find();
$vk = ORM::factory("settings")->where('id','=',"5")->find();
$fb = ORM::factory("settings")->where('id','=',"6")->find();
?>
      <div class="logo">

	    <div class="logo_logo left">
		  <a href="/"><img src="/media/images/new/logo.png"></a>
		  <div class="logo_little_text">профессиональные услуги в сфере недвижимости</div>

		  <div class="logo_little_text" style="position:relative;top:17px;text-align:left;">
		      <a href="<?=$fb->text?>"><img style="width:32px;" src="/media/images/soc/fb-icon.jpg"></a>
		      <a href="<?=$vk->text?>"><img style="width:32px;" src="/media/images/soc/vk-icon.jpg"></a>
		  </div>
	    </div>
	    <div class="logo_answer left">
		  <div class="logo_answer_send">Задать<br>вопрос</div>
	    </div>
	    <div class="logo_phones left">

		  <?=$settings->text?><br>
		  <a href="/contacts" style="color:#0E7EB3;">Контакты</a><br>
<span class="search_menu">
   	  <input class="search_inp" type="text" value="поиск">
	  <span class="search_but"></span>
</span>
		  <!--<div class="search_wrap">
			<input value="">
			<div class="search_but"><img class="search_but" src="./media/images/search.png"></div>
		  </div>-->
	    </div>
	    <div class="clear"></div>
      </div>


      <div class="menu">
	  <div class="red_top_line"></div>

	   <?=$mainmenu?>

	  <div class="red_top_line"></div>
      </div>



      <div class="main_center">
	    <?php if(isset($page)){ echo '<h1>'.$page->name.'</h1>'; } ?>
	    <?php if(isset($page) && $page->url == 'contacts'){ echo $map->text; } ?>
	    <?php if(isset($page) && $page->url == 'page_23'){ 

		  $orm = ORM::factory("structure")->where('parent','=','369')->find_all();
	
		  foreach($orm as $value)
		  {
		      echo '<a style="color:#A13137;" href="/'.$value->url.'">'.$value->name.'</a><br>';
		  }
	    } ?>
	    <?=$content?>
	    <div class="clear"></div><br>
	    <b>Оставить заявку</b><br><br>
	    <div class="wrap_send_message_one">
		  Ваше имя<br>
		  <input id="send_message_one_name" value=""><br><br>
		  Ваш e-mail<br>
		  <input id="send_message_one_email" value=""><br><br>
		  Ваш телефон<br>
		  <input id="send_message_one_phone" value=""><br><br>
		  Сообщение<br>
		  <textarea id="send_message_one_text"></textarea><br><br>

		  <input id="send_message_one" type="submit" value="Отправить">
	    </div>
	    <div class="loader_send_message_one" style="display:none;"><img src="/media/images/loader.gif"></div>
	    <div class="success_send_message_one"  style="display:none;">Сообщение отправлено!</div><br><br>
      </div>

      <div class="clear"></div>


      <div class="wrap_send_message_two_popup" style="display:none;">
	    <a id="wrap_send_message_two_close" href="#" style="color:red;">закрыть</a><br><br>
	    <div class="wrap_send_message_two">
		  Ваше имя<br>
		  <input id="send_message_two_name" value=""><br><br>
		  Ваш e-mail<br>
		  <input id="send_message_two_email" value=""><br><br>
		  Сообщение<br>
		  <textarea id="send_message_two_text"></textarea><br><br>

		  <input id="send_message_two" type="submit" value="Отправить">
	    </div>
	    <div class="loader_send_message_two" style="display:none;"><img src="/media/images/loader.gif"></div>
	    <div class="success_send_message_two"  style="display:none;">Сообщение отправлено!</div><br><br>
      </div>
