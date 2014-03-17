<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Иван
 * Date: 17.12.12
 * Time: 14:58
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="content">

<div id="secondary-content-bg">

  <div class="row-1">
      <div class="inner">
        <div class="wrapper">


          
            <div class="indent">
                <div class="box2">
                    <div class="inner">
                        <h2 class="colHeader"><span><?=$page->name?></span></h2>
 
		<?php
		    $img = '/media/images/default_goods_image.gif';

		    if($page->img != '')
		    {
			  $img = $page->img;
		    }

		    
		?>

		<img style="margin-right:10px;border-radius:9px;float:left;max-width:200px;max-height:200px;" src="<?=$img?>">
                <?=date("d.m.Y", $page->timestamp)?><br>   
		<?=$page->content?>

		<div class="clear"></div>
                    </div>
                </div>
            </div>


        </div>
      </div>
    </div>
    
</div>
</div>