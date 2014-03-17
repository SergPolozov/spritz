<h1><img src="img/icons/posts.png" alt="" /> Table</h1>
<div class="bloc">
    <div class="title">
        Table Content
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"/></th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Catégories</th>
                    <th>Tags</th>
                    <th><img src="img/th-comment.png" alt="" /></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<10; $i++): ?>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <div class="left input">
            <select name="action" id="tableaction">
                <option value="">Action</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="pagination">
            <a href="#" class="prev">«</a>
            <a href="#">1</a>
            <a href="#" class="current">2</a>
            ...
            <a href="#">21</a>
            <a href="#">22</a>
            <a href="#" class="next">»</a>
        </div>
    </div>
</div>



<div class="bloc">
    <div class="title">
        Table Content with pictures
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<5; $i++): ?>
                <tr>
                    <td class="picture" style="width:140px;"><a href="http://lorempixum.com/800/600/food/<?php echo $i; ?>?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/<?php echo $i; ?>" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td>http://lorempixum.com/800/600/food/<?php echo $i; ?></td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>



<div class="bloc">
    <div class="title">
        Last comments
    </div>
    <div class="content">
        <table class="noalt">
            <tbody>
                <?php for($i=0; $i<5; $i++): ?>
                <tr>
                    <td class="picture" style="width:80px;"><img src="img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>