<h1><img src="img/icons/pictures.png" alt="" /> Gallery</h1>
<div class="bloc">
    <div class="title">Picture Gallery</div>
    <div class="content">
        <p>You can have gallery inside a block our outside</p>
        <ul class="gallery">
            <?php for($i=0; $i<10; $i++): ?>
            <li>
                <a href="#"><img src="http://lorempixum.com/120/80/food/<?php echo $i%10; ?>" alt=""/></a>
                <span class="info">Image name</span>
                <a href="#" title="delete Image" class="del">Delete</a>
                <a href="#" class="over"><span>Edit this image</span></a>
                <a href="http://lorempixum.com/800/600/food/<?php echo $i%10; ?>?.jpg" class="large zoombox" title="full-size">Enlarge</a>
            </li>
            <?php endfor; ?>
        </ul>
        <div class="cb"></div>
    </div>
</div>


<ul class="gallery">
    <?php for($i=0; $i<10; $i++): ?>
    <li>
        <a href="#"><img src="http://lorempixum.com/120/80/food/<?php echo $i%10; ?>" alt=""/></a>
        <span class="info">Image name</span>
        <a href="#" title="delete Image" class="del">Delete</a>
        <a href="#" class="over"><span>Edit this image</span></a>
        <a href="http://lorempixum.com/800/600/food/<?php echo $i%10; ?>?.jpg" class="large zoombox" title="full-size">Enlarge</a>
    </li>
    <?php endfor; ?>
</ul>

<div class="cb"></div>