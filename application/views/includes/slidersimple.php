<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 23.10.12
 * Time: 12:46
 * To change this template use File | Settings | File Templates.
 */
?>
<!-- header image/slider -->
<?
//if (isset($banner) && $banner){
    ?>
<div class="header_bot header_image">
    <div class="container">
        <?/*
        <a href="<?=$banner->url?>"><img src="/media/userfiles/images/<?=$banner->photo?>" width="960" alt="" /></a>
*/

        if (isset($page->url) && $page->url == "about"){
            ?>
            <img src="/media/userfiles/images/about.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "facilities"){
            ?>
            <img src="/media/userfiles/images/ban2.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "doctors"){
            ?>
            <img src="/media/userfiles/images/ban3.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "contacts"){
            ?>
            <img src="/media/userfiles/images/ban2.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "recording"){
            ?>
            <img src="/media/userfiles/images/ban4.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "price"){
            ?>
            <img src="/media/userfiles/images/ban5.jpg" width="960" alt="" />
            <?
        } elseif (isset($page->url) && $page->url == "faq"){
            ?>
            <img src="/media/userfiles/images/ban6.jpg" width="960" alt="" />
            <?
        }
        ?>
    </div>
</div>
<!--/ header image/slider -->

<?
//}
?>
