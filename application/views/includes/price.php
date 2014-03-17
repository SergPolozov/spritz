<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 24.10.12
 * Time: 22:09
 * To change this template use File | Settings | File Templates.
 */
$cat = "";
?>
<script>
    $(document).ready(function(){
        /*
        $('#priceslider .price-el .name').each(function(){
            var price = $(this).parent().find('.price');
            price.css('height', $(this).css('height'));
        });
        */
    });
</script>
<div id="priceslider">
    <?
    $catid = -1;
    foreach ($price as $pr){
        if ($cat != $pr["cat"]){
            $catid++;
            ?>
            <div class="price-cat" data-catid="<?=$catid?>">
                <a href="javascript: void(0);" class="name"><?=$pr["cat"]?></a>
                <a href="javascript: void(0);" class="button"><img src="/media/images/icons/pricegray.png" border="0" /></a>
            </div>
            <?
            $cat = $pr["cat"];
        }
        ?>
        <div class="price-el" data-catid="<?=$catid?>">
            <div class="name" title="<?=$pr["name"]?>"><?=$pr["name"]?></div>
            <div class="price"><?=$pr["value"]?></div>
            <br clear="all" />
        </div>
        <?
    }
    ?>
</div>
<?
//echo "<pre>";
//var_dump ($price);
//echo "</pre>";
