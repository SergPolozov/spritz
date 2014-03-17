<h1><img src="img/icons/posts.png" alt=""> Forms</h1>

<div class="bloc">
    <div class="title">Simple inputs</div>
    <div class="content">
        <div class="input">
            <label for="input1">Text input</label>
            <input type="text" id="input1">
            Some informations on how to use this field
        </div>
        <div class="input medium error">
            <label for="input2">Medium input with error</label>
            <input type="text" id="input2">
            <span class="error-message">This field can't be empty !</span>
        </div>
        <div class="input long">
            <label for="input3">Loooooooooong input</label>
            <input type="text" id="input3">
        </div>
        <div class="input loading">
            <label for="input4">Loading</label>
            <input type="text" id="input4">
        </div>
    </div>
</div>
<div class="bloc left">
    <div class="title">Radios and checkbox</div>
    <div class="content">
        <div class="input">
            <label for="file">Upload a file</label>
            <input type="file" id="file">
        </div>

        <div class="input">
            <label class="label">Checkboxes</label>
            <input type="checkbox" id="check1" checked><label for="check1" class="inline">This is a checkbox</label> <br>
            <input type="checkbox" id="check2"><label for="check2" class="inline">Another one !</label> <br>
        </div>
        <div class="input">
            <label class="label">Radio</label>
            <input type="radio" id="radio1" name="radiobutton"  checked="checked"><label for="radio1" class="inline">This is a radio input</label> <br>
            <input type="radio" id="radio2"  name="radiobutton"><label for="radio2" class="inline">And this is another radio input</label>
        </div>
    </div>
</div>
<div class="bloc right">
    <div class="title">Select and Textarea</div>
    <div class="content">
        <div class="input">
            <label for="select">This is a "select" input</label>
            <select name="select" id="select">
                <option value="1">First value</option>
                <option value="2">Second value</option>
                <option value="3">Third value</option>
            </select>
            Some informations on how to use this field
        </div>
        <div class="input textarea">
            <label for="textarea1">Textarea</label>
            <textarea name="text" id="textarea1" rows="7" cols="4"></textarea>
        </div>
        <div class="submit">
            <input type="submit" value="Enregistrer">
            <input type="reset" value="Black button" class="black">
            <input type="reset" value="White button" class="white">
        </div>
    </div>
</div>

<div class="cb"></div>

<div class="bloc">
    <div class="title">Advanced inputs</div>
    <div class="content">
        <div class="input">
            <label for="input4">Datepicker using jQuery UI</label>
            <input type="text" class="datepicker" id="input4">
        </div>
        <div class="input textarea">
            <label for="textarea2">Autogrow WYSIWYG Textarea (<a href="https://github.com/akzhan/jwysiwyg">jwysiwyg</a>)</label>
            <textarea name="text" id="textarea2" rows="7" class="wysiwyg" cols="4">
                Here you <em>can have</em> some <strong>HTML Content</strong>
            </textarea>
        </div>
        <div class="input">
            <label>Range : $<span></span></label>
            <input type="text" class="range min-10 max-60" value="35">
        </div>
        
        <div class="input">
            <label for="iphonecheck" class="label">Iphone checkbox</label>
            <input type="checkbox" id="iphonecheck" class="iphone">
        </div>
        
        
    </div>
</div>


<div class="bloc">
    <div class="title">Loading bloc</div>
    <div class="content">
        Adding a loading on a block is quite simple, you just have to add a div with "loader" class and this is what happen.
        <div class="loader"></div>
    </div>
</div>

