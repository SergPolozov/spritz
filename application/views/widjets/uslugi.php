<?

$content = array();
$content2 = array();


foreach($list as $element){

    if($element['element']->uparent == 0)
    {
        $content[$element['element']->id] = $element['element']->name;
        $content2[$element['element']->id . "_url"] = $element['element']->url;
    }
    else
    {
        $price = '';
        if($element['element']->price != 0)
        {
            $price = '- '.$element['element']->price;
        }

        $content2[$element['element']->uparent][] = '<li>'.$element['element']->name.' <span class="uslugi_one_price">'.$price.'</span> руб.</li>';
    }

}


foreach($content as $key=>$element){


    echo '<div class="uslugi_one_block"><h3>'.$element.'</h3><ul>';
    $i = 1;
    foreach($content2[$key] as $value)
    {
        if ($i>5){
            ?>
            <li class="last"><a href="/<?=str_replace("uslugi/", "", $content2[$key . "_url"])?>/">посмотреть все цены</a></li>
            <?
            break;
        }
        echo $value.'<br>';
        $i++ ;
    }

    echo '</ul></div>';

}


?>

<div class="clear"></div>
