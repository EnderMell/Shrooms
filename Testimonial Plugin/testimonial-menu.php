<?php
// testimonial 1 saved data
if(isset($_POST["save1"])){
    $testimonial1text = trim($_POST["testimonial1text"]);
    update_option("testimonial1text", $testimonial1text);
    $testimonial1author = trim($_POST["testimonial1author"]);
    update_option("testimonial1author", $testimonial1author);
    // $testimonial1img = trim($_POST["testimonial1img"]);
    // update_option("testimonial1img", $testimonial1img);
};
?>

<style>
    .row {
        padding: 10px;
    }

    .inputlabel {
        display: inline-block;
        width: 120px;
        text-align: end;
    }
</style>

<div class="wrap">
    <h2>Testimonial 1</h2>

    <?php if(isset($_POST["save1"])): ?>
        <div id="message" class="updated below-h2">
            <p>Saved !!</p>
        </div>
    <?php endif; ?>

    <div class="metabox-holder">
        <div class="postbox">
            <form action="" method="post">
                <div class="row">
                    <label for="testimonial1text" class="inputlabel">Testimonial Text</label>
                    <input type="text" name="testimonial1text" id="testimonial1text" maxlength="255" value="<?php echo get_option("testimonial1text");?>">
                </div><br>
                <div class="row">
                    <label for="testimonial1author" class="inputlabel">Testimonial Author</label>
                    <input type="text" name="testimonial1author" id="testimonial1author" maxlength="255" value="<?php echo get_option("testimonial1author");?>">
                </div><br>
                <!-- <div class="row">
                    <label for="testimonial1picture" class="inputlabel">Author Picture</label>
                    <input type="file" accept="image/*" name="testimonial1picture" id="testimonial1picture" value="<?php echo get_option("testimonial1picture");?>">
                </div><br> -->
                <div class="row">
                    <label for="save1" class="inputlabel">&nbsp;</label>
                    <input type="submit" name="save1" id="save1" value="Save" class="button-primary">
                </div><br>
            </form>
        </div>
    </div>
</div>

<?php
// testimonial 2 saved data
if(isset($_POST["save2"])){
    $testimonial2text = trim($_POST["testimonial2text"]);
    update_option("testimonial2text", $testimonial2text);
    $testimonial2author = trim($_POST["testimonial2author"]);
    update_option("testimonial2author", $testimonial2author);
    // $testimonial2img = trim($_POST["testimonial2img"]);
    // update_option("testimonial2img", $testimonial2img);
};
?>
<div class="wrap">
    <h2>Testimonial 2</h2>

    <?php if(isset($_POST["save2"])): ?>
        <div id="message" class="updated below-h2">
            <p>Saved !!</p>
        </div>
    <?php endif; ?>
    
    <div class="metabox-holder">
        <div class="postbox">
            <form action="" method="post">
                <div class="row">
                    <label for="testimonial2text" class="inputlabel">Testimonial Text</label>
                    <input type="text" name="testimonial2text" id="testimonial2text" maxlength="255" value="<?php echo get_option("testimonial2text");?>">
                </div><br>
                <div class="row">
                    <label for="testimonial2author" class="inputlabel">Testimonial Author</label>
                    <input type="text" name="testimonial2author" id="testimonial2author" maxlength="255" value="<?php echo get_option("testimonial2author");?>">
                </div><br>
                <!-- <div class="row">
                    <label for="testimonial2picture" class="inputlabel">Author Picture</label>
                    <input type="file" accept="image/*" name="testimonial2picture" id="testimonial2picture" value="<?php echo get_option("testimonial2picture");?>">
                </div><br> -->
                <div class="row">
                    <label for="save2" class="inputlabel">&nbsp;</label>
                    <input type="submit" name="save2" id="save2" value="Save" class="button-primary">
                </div><br>
            </form>
        </div>
    </div>
</div>

<?php
// testimonial 3 saved data
if(isset($_POST["save3"])){
    $testimonial3text = trim($_POST["testimonial3text"]);
    update_option("testimonial3text", $testimonial3text);
    $testimonial3author = trim($_POST["testimonial3author"]);
    update_option("testimonial3author", $testimonial3author);
    // $testimonial3img = trim($_POST["testimonial3img"]);
    // update_option("testimonial3img", $testimonial3img);
};
?>

<div class="wrap">
    <h2>Testimonial 3</h2>

    <?php if(isset($_POST["save3"])): ?>
        <div id="message" class="updated below-h2">
            <p>Saved !!</p>
        </div>
    <?php endif; ?>

    <div class="metabox-holder">
        <div class="postbox">
            <form action="" method="post">
                <div class="row">
                    <label for="testimonial3text" class="inputlabel">Testimonial Text</label>
                    <input type="text" name="testimonial3text" id="testimonial3text" maxlength="255" value="<?php echo get_option("testimonial3text");?>">
                </div><br>
                <div class="row">
                    <label for="testimonial3author" class="inputlabel">Testimonial Author</label>
                    <input type="text" name="testimonial3author" id="testimonial3author" maxlength="255" value="<?php echo get_option("testimonial3author");?>">
                </div><br>
                <!-- <div class="row">
                    <label for="testimonial3picture" class="inputlabel">Author Picture</label>
                    <input type="file" accept="image/*" name="testimonial3picture" id="testimonial3picture" value="<?php echo get_option("testimonial3picture");?>">
                </div><br> -->
                <div class="row">
                    <label for="save3" class="inputlabel">&nbsp;</label>
                    <input type="submit" name="save3" id="save3" value="Save" class="button-primary">
                </div><br>
            </form>
        </div>
    </div>
</div>