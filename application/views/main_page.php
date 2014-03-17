    <div id="bgStretch">
        <img src="/media/images/bg_pic1.jpg" alt>
    </div>
    <div id="glob">
        <div class="spinner"></div>
        <!-- CONTENT -->
        <section id="content">
            <div id="menuBlock">
                <div>
                    <h1><a href="#!/page_splash" class="logo"><span>Houser</span><span>real estate agency</span></a></h1>
                    <!-- MENU -->
                    <nav class="menu">
                        <!--<ul id="menu">
                            <li><a href="#!/page_home">Home</a></li>
                            <li class="with_ul"><a href="#!/page_about">About</a>
                                <ul class="submenu_1">
                                    <li><a href="#!/page_more">about us</a></li>                                
                                    <li><a href="#!/page_more">company</a></li>               				    
                                    <li><a href="#!/page_more">our team</a></li>               				    
                                    <li><a href="#!/page_more">awards</a></li>
                   				</ul>
                            </li>
                            <li><a href="#!/page_buy">buy</a></li>
                            <li><a href="#!/page_sell">sell</a></li>
                            <li class="no_bg"><a href="#!/page_mail">contact</a></li>
                    	</ul>-->
			<?=$mainmenu?>
               	    </nav>
                    <!-- END MENU -->
                    <div id="menuName"><span>меню</span></div>
                </div>
            </div>
            <ul>          
                <li id="page_splash" class="no_bg"></li>

<?php

$settings = ORM::factory("settings")->find_all();
$settings_array = array();

foreach($settings as $val)
{
    $settings_array[$val->id] = $val;
}

draw_content($get_main_menu,$settings_array);

function draw_content($obj,$settings)
{
      foreach($obj as $el)
      {
		$element = $el['obj'];
?>
                <li id="<?=$element->url?>">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2 class="mar2"><?=$element->name?></h2>
                                <?=$element->content?>
<?php
if($element->url == "page_51") echo $settings[4]->text;

if($element->url == "page_50")
{
      echo '<div class="wrap_send_message_one">
		  Ваше имя<br>
		  <input value="" id="send_message_one_name"><br><br>
		  Ваш e-mail<br>
		  <input value="" id="send_message_one_email"><br><br>
		  Ваш телефон<br>
		  <input value="" id="send_message_one_phone"><br><br>
		  Сообщение<br>
		  <textarea id="send_message_one_text"></textarea><br><br>

		  <input type="submit" value="Отправить" id="send_message_one">
	    </div>';
}
?>
                            </article>
                        </div>
                    </div>
                </li>
<?
		draw_content($el['child'],$settings);

      }
}
?>


                <li id="page_about">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>About us</h2>
                                <img src="/media/images/page2_pic1.jpg" class="fleft mar1" alt>
                                <div class="box">
                                    <p>Lorem ipsum dolor sit amet, consec tetuer adipicing it. Praesent vestibulum molestie lacusnea non mmyhe. Odrerit mauris. Phasellus portacecipit varius miumocii. S natoque penatibus et gnis dis parturient montes setu. Ridiculu. Nulla. dui. Fusce feugiat malesuada odio.</p>
                                    <p>At, cursus nec, luctus a, lorem. Lorem ipsum dolor sit amet, consec tetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean non ummy hendrerit mauris. Phasellus porta. Fusce suscipitrius. mium sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. </p>
                                    <p class="pad3">Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                                    <p><a href="#!/page_more" class="readMore">more info</a></p>
                                </div>
                            </article>
                        </div>
                    </div>
                </li>
                <li id="page_buy">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>homes for buying</h2>
                                <ul class="list2">
                                    <li>
                                        <a href="/media/images/image-blank.png"><img src="/media/images/page3_pic1.jpg" alt></a>
                                        <p><strong>In pede mi aliquet.</strong></p>
                                        <p class="fontStyle1">$1.000.600</p>
                                        <p class="pad4">Lorem ipsum dolor sit amet, consec tetuer adipicing it. </p>
                                        <p><a href="#!/page_more" class="readMore">more info</a></p>
                                    </li>
                                    <li>
                                        <a href="/media/images/image-blank.png"><img src="/media/images/page3_pic2.jpg" alt></a>
                                        <p><strong>Aenean auctor wisi</strong></p>
                                        <p class="fontStyle1">$2.000.600</p>
                                        <p class="pad4">Lorem ipsum dolor sit amet, consec tetuer adipicing it. </p>
                                        <p><a href="#!/page_more" class="readMore">more info</a></p>
                                    </li>
                                    <li>
                                        <a href="/media/images/image-blank.png"><img src="/media/images/page3_pic3.jpg" alt></a>
                                        <p><strong>Cum sociis natoque</strong></p>
                                        <p class="fontStyle1">$1.500.600</p>
                                        <p class="pad4">Lorem ipsum dolor sit amet, consec tetuer adipicing it. </p>
                                        <p><a href="#!/page_more" class="readMore">more info</a></p>
                                    </li>
                                    <li class="last">
                                        <a href="/media/images/image-blank.png"><img src="/media/images/page3_pic4.jpg" alt></a>
                                        <p><strong>Aenean nonummy</strong></p>
                                        <p class="fontStyle1">$1.450.000</p>
                                        <p class="pad4">Lorem ipsum dolor sit amet, consec tetuer adipicing it. </p>
                                        <p><a href="#!/page_more" class="readMore">more info</a></p>
                                    </li>
                                </ul>
                            </article>
                        </div>
                    </div>
                </li>
                <li id="page_sell">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>selling tips</h2>
                                <p class="pad5"><strong>Donec in velit vel ipsum auctor pulvinar. Proin ullamcorper urna et felis.</strong></p>
                                <p>Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                                <ul class="list3">
                                    <li><a href="#">Aenean nonummy hendrerit</a></li>
                                    <li><a href="#">Phasellus port fusce suscipit</a></li>
                                    <li><a href="#">Cum sociis natoque penatibus </a></li>
                                    <li><a href="#">Magnis dis parturient </a></li>
                                </ul>
                                <ul class="list3">
                                    <li><a href="#">Phasellus port fusce suscipit </a></li>
                                    <li><a href="#">Cum sociis natoque penatibus </a></li>
                                    <li><a href="#">Magnis dis parturient</a></li>
                                    <li><a href="#">Montes nascetur ridiculus mus</a></li>
                                </ul>
                                <p>Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. </p>
                                <p><a href="#!/page_more" class="readMore">more info</a></p>
                            </article>
                        </div>
                    </div>
                </li>
                <li id="page_mail">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>find us</h2>
                                <figure class="google_map"></figure>
                                <div>
                                    <p class="pad5"><strong>8901 Marmora Road,<br>Glasgow, D04 89GR.</strong></p>
                                    <p class="pad6"><span class="w1">Freephone:</span>+1 800 559 6580<br><span class="w1">Telephone:</span>+1 959 603 6035<br><span class="w1">FAX:</span>+1 504 889 9898<br>E-mail: <a href="#" class="color1">mail@demolink.org</a></p>
                                    <p class="pad5"><strong>9863 - 9867 Mill Road,<br>Cambridge, MG09 99HT.</strong></p>
                                    <p class=""><span class="w1">Freephone:</span>+1 800 559 6580<br><span class="w1">Telephone:</span>+1 959 603 6035<br><span class="w1">FAX:</span>+1 504 889 9898<br>E-mail: <a href="#" class="color1">mail@demolink.org</a></p>
                                </div>
                            </article>
                        </div>
                    </div>
                </li>
                <li id="page_privacy">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>privacy policy</h2>
                                <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                                <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede.</p>
                                <p>Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. </p>
                                <p>E-mail: <a href="#" class="color1">info@demolink.org</a></p>
                            </article>
                        </div>
                    </div>
                </li>
                <li id="page_more">
                    <div class="container">
                        <div class="wrapper pad1">
                            <article class="col1">
                                <h2>lorem ipsum</h2>
                                <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                                <p>Quisque nulla. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit magna, hendrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede.</p>
                                <p>Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. </p>
                            </article>
                        </div>
                    </div>
                </li>
            </ul>   
        </section>
        <!-- END CONTENT -->
        <!-- FOOTER -->
        <footer>
            <div id="topBlock">
                <div class="pagin">
                    <ul>
                        <li class="active"><a href="/media/images/bg_pic1.jpg"></a></li>
                        <li><a href="/media/images/bg_pic2.jpg"></a></li>
                        <li><a href="/media/images/bg_pic3.jpg"></a></li>
                        <li><a href="/media/images/bg_pic4.jpg"></a></li>
                        <li><a href="/media/images/bg_pic5.jpg"></a></li>                
                    </ul>
                </div>
            </div>
            <div id="botBlock">
                <p>2012 &copy; <a href="#!/page_privacy">Privacy Policy</a></p>
                <!-- {%FOOTER_LINK} -->           
            </div>
        </footer>
        <!-- END FOOTER -->
    </div>

