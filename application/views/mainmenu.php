<ul id="menu">
<?php
 
 $explode = explode('/',$page);
 
?>

<?foreach($menu as $value){

    $element = $value['obj'];
    $draw_recursive = Functions::draw_menu($value);
?>
    <li>
	<a class="<?if($page == $element->url || $explode[0] == $element->url){?>active<?}?> <? if($draw_recursive != '') echo 'with_ul'; ?>" href="#!/<?=$element->url?>"><?=$element->name?></a>
	<? if($draw_recursive != '') echo $draw_recursive; ?>
    </li>
<?}?>

</ul>