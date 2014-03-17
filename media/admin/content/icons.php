<h1>Main icons, <span><a href="http://www.woothemes.com/2010/08/woocons1/">Woocons #1</a></h1>
<div class="bloc">
    <div class="title">Main icons</div>
    <div class="content">
        <?php foreach(glob('images/icons/*.png') as $file):  ?>
			<a href="#" title="<?php echo end(explode('/',$file)); ?>"><img src="<?php echo $file; ?>" style="padding:5px;"/></a>
		<?php endforeach; ?>
        <div class="cb"></div>
    </div>
</div>


<h1>Menu icons, <span><a href="http://www.iconsweets2.com/">iconSweets 2</a></h1>

<div class="bloc left">
    <div class="title">Icons White</div>
    <div class="content" style="background:#1C1C1C">
        <?php foreach(glob('images/icons/menu/*.png') as $file): ?>
			<a href="#" title="<?php echo end(explode('/',$file)); ?>"><img src="<?php echo $file; ?>" style="padding:5px;"/></a>
		<?php endforeach; ?>
        <div class="cb"></div>
    </div>
</div>

<div class="bloc right">
    <div class="title">Icons Black</div>
    <div class="content">
        <?php foreach(glob('images/icons/menu/dark/*.png') as $file): ?>
			<a href="#" title="<?php echo end(explode('/',$file)); ?>"><img src="<?php echo $file; ?>" style="padding:5px;"/></a>
		<?php endforeach; ?>
        <div class="cb"></div>
        <p>
            You can also use this icons on buttons ! <br/>
            <a class="button" href="#"><img src="img/icons/menu/pdf.png"/> Button with icon</a>
            <a class="button white" href="#"><img src="img/icons/menu/dark/chart.png"/> Button with icon</a>
            <a class="button black" href="#"><img src="img/icons/menu/money.png"/> Button with icon</a>
        </p>
    </div>
</div>

<div class="cb"></div>