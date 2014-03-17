

<?php
$content_fav = '';
if(isset($sfavorite))
{
    foreach($sfavorite as $element)
    {
        if($element->type_content == 0)
        {

            $c_img = '';
            $c_roz = '';
            $c_opt = '';

            if($element->img != '')
            {
          $c_img = '<div class="catalog_item_img"><img alt="'.$element->alt_img.'" src="'.$element->img.'"></div>';
            }
            if($element->price_one != 0)
            {
          $c_roz = '<div class="catalog_item_roznica"><span>'.$element->price_one.'р.</span></div>';
            }
            
            /*if($element->price_opt != 0)
            {
          $c_opt = '<div class="catalog_item_opt">Опт. <span>'.$element->price_opt.'р.</span></div>';
            }*/

            $content_fav .= '<div class="catalog_item_wrap">
                          '.$c_img.'
                          <div class="catalog_item_href"><a href="/'.$element->url.'">'.$element->name.'</a></div>
                          <div class="catalog_item_smalltext">'.$element->smalltext.'</div>
                          '.$c_roz.'
                        </div>';
        }

    }

}

?>

<div class="row-1">
<div class="indent">
    <div class="box2">
        <div class="inner">
            <h2 class="colHeader catalog_h2"><span>Каталог</span></h2>
            

<?
/*
echo "<pre>";
var_dump($list);
echo "</pre>";
exit;
*/

$content1 = '';

foreach($list as $element)
{
    if($element['element']->type_content == 1)
    {
	$content1 .= '<h3><a href="/'.$element['element']->url.'">'.$element['element']->name.'</a></h3>';
    }


}

?>


<div class="list1 catalog_menu_list">
	<?=$content1?>
</div>


        </div>
    </div>
</div>
</div>

<div class="row-2 catalog_margin_row2">
	<div class="inner">
		<div class="wrapper">
	<?=$content_fav?>

	      <div class="clear"></div>
	    </div>
        </div>
    </div>
<div class="clear"></div>

