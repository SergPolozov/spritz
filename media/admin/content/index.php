<h1><img src="img/icons/dashboard.png" alt="" /> Dashboard
</h1>
                
<div class="bloc left">
    <div class="title">
        Dashboard
    </div>
    <div class="content dashboard">
        <div class="center">
            <a href="#" class="shortcut">
                <img src="img/page.png" alt="" width="48" height="48"/>
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="img/picture.png" alt="" width="48" height="48" />
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="img/contact.png" alt="" width="48" height="48" />
                Manage contacts
            </a>
            <a href="#" class="shortcut last">
                <img src="img/event.png" alt="" width="48" height="48" />
                Manage events
            </a>
            <div class="cb"></div>
        </div>
        <p>Icons by <a href="http://icondrawer.com">icondrawer.com</a></p>
    </div>
</div>


                
<div class="bloc right">
    <div class="title">
        Today
    </div>
    <div class="content">
        <div class="left">
            <table class="noalt">
                <thead>
                    <tr>
                        <th colspan="2"><em>Content</em></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h4>460</h4></td>
                        <td>Posts</td>
                    </tr>
                    <tr>
                        <td><h4>12</h4></td>
                        <td>Pages</td>
                    </tr>
                    <tr>
                        <td><h4>5</h4></td>
                        <td>Categories</td>
                    </tr>
                    <tr>
                        <td><h4>20 000</h4></td>
                        <td>Contacts</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="right">
            <table class="noalt">
                <thead>
                    <tr>
                        <th colspan="2"><em>Comments</em></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h4>46 000</h4></td>
                        <td class="good">Comments</td>
                    </tr>
                    <tr>
                        <td><h4>5</h4></td>
                        <td class="neutral">Waiting for validation</td>
                    </tr>
                    <tr>
                        <td><h4>0</h4></td>
                        <td class="bad">Spams</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="cb"></div>
    </div>
</div>

<div class="cb"></div>

<div class="bloc">
    <div class="title">What's new</div>
    <div class="content">   
        <?php 
        $scripts = array(
            'cookie/jquery.cookie.js',
            'jwysiwyg/jquery.wysiwyg.js',
            'tooltipsy.min.js',
            'iphone-style-checkboxes.js',
            'excanvas.js',
            'zoombox/zoombox.js',
            'visualize.jQuery.js',
            'jquery.uniform.js',
            'main.js'
        ); 
        ?>
        <h5>10/10/2011</h5>
        <ul>
            <li>
                New minify system, you can now do change to Javascript sourcecode and generates a minfiy version after all using <a href="lib/minify/b=<?php echo WEBROOT."/js&f=".implode(',',$scripts); ?>">this link</a>
            </li>
            <li>New alert messages</li>
            <li>CSS Merged into one CSS</li>
            <li>New input "loading" added to display a loading state on a specific field</li>
            <li>Fixed a bug caused by "Console.log" that broke charts on Internet Explorer</li>
            <li>Fixed a bug with uniform plugin that doesn't work with jQuery 1.6 (attr('checked') replaced by is(':checked')</li>
            <li>A new element (class "logo") allow you to add your own branding in the head (your logo has to be 42 pixel high</li>
            <li>The left sidebar can be collapsed !</li>

        </ul>
        <h5>09/08/2011</h5>
        <ul>
            <li>Minor CSS bug fixes</li>
            <li>New gallery template</li>
            <li>New tabs code, the new code uses jQuery.cookie to remember what tab was opened</li>
            <li>Minified CSS and Minified Javascript is now include, no need to include 200 scripts anymore</li> 
            <li>Infinite sublevel for left sidebar (thanks @sscowden for suggestion)</li>
        </ul>
        <h5>01/07/2011</h5>
        <ul>
            <li>Fixed path for CSS and Javascript files on HTML demos</li>
            <li>Charts script updated, you can now add tooltips using ‘tips’ class on table</li>
        </ul>
        <h5>16/06/2011</h5>
        <ul>
            <li>Completely reworked substyles system, you have now 3 sidebars styles, 2 body styles and 3 bloc styles. Wood styles completely reworked.</li>
            <li>Added icons so you don’t have to look for icons</li>
            <li>Added galllery system</li>
            <li>Settings pannel added on the demo so you can test substyles easily</li>
            <li>Modal style added, so you can open subpages within modal boxes</li>
            <li>Fixed a bug on page that didn’t have title</li>
        </ul>
        <h5>06/06/2011</h5>
        <ul>
            <li>Fixed a bug on menu links with submenu</li>
            <li>Added some styles on datepicker (now “today” and “current day” have different style)</li>
        </ul>

    </div>
</div>
           

<div class="bloc">
    <div class="title">
        Shortcuts
    </div>
    <div class="content">
        <a href="index.php?p=typo" class="shortcut">
            <img src="img/icons/font.png" alt="" />
            Typography
        </a>
        <a href="index.php?p=table" class="shortcut">
            <img src="img/icons/window.png" alt=""  width="32" height="32"/>
            Table
        </a>
        <a href="index.php?p=notif" class="shortcut">
            <img src="img/icons/warning.png" alt=""  width="32" height="32"/>
            Notifications
        </a>
        <a href="index.php?p=forms" class="shortcut">
            <img src="img/icons/posts.png" alt=""  width="32" height="32"/>
            Forms
        </a>
        <a href="index.php?p=charts" class="shortcut">
            <img src="img/icons/chart.png" alt=""  width="32" height="32"/>
            Charts
        </a>
        <a href="index.php?p=calendar" class="shortcut">
            <img src="img/icons/calendar.png" alt=""  width="32" height="32"/>
            Calendar
        </a>
        <div class="cb"></div>
    </div>
</div>