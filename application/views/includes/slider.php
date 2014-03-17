<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 23.10.12
 * Time: 12:42
 * To change this template use File | Settings | File Templates.
 */
?>
<!-- header image/slider -->
<div class="header_bot header_slider">
    <div class="container">

        <!-- showcase slider -->
        <div id="showcase" class="showcase">

            <?
            if (isset($sliders)){
                foreach ($sliders as $slider){
                    ?>
                    <div class="showcase-slide">
                        <div class="showcase-content">
                            <img src="/media/userfiles/images/<?=$slider->photo?>" alt="02" />
                        </div>
                        <div class="showcase-thumbnail">
                            <div class="showcase-thumbnail-content">
                                <h3><?=$slider->name?></h3>
                                <p><?=$slider->descr?></p>
                            </div>
                        </div>
                    </div>
                    <?
                }
            }
            ?>
        </div>
        <!--/ showcase slider -->

    </div>
</div>
<!--/ header image/slider -->
