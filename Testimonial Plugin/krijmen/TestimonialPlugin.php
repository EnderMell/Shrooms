<?php
/**
 * Plugin Name: TestimonialPlugin
 * Plugin URI: gluwebURL
 * Description: Write stuff about people
Version: 1.0.0
Author: Krijn and Garon
Author URI: gluwebURL
License: GPL-2.0+
 */

// Voeg html toe onderin de pagina.
add_action('get_footer','mybox');
function mybox(){
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Delicious+Handrawn&display=swap" rel="stylesheet">';
    echo '<div class="TestimonialHeader">Testimonials from clients</div>';
    echo '<div class="TestimonialBox">
<div style="font-family: Delicious Handrawn, cursive;" id="first" class="infobox"><p>'.get_option('first_text').'</p> <p style="font-size: larger"><b>'.get_option('first_writer').'</b></p><p style="font-size: larger"><b>'.get_option('image_1').'</b></p></div>
<div style="font-family: Delicious Handrawn, cursive;" id="second" class="infobox"><p>'.get_option('second_text').'</p> <p style="font-size: larger"><b>'.get_option('second_writer').'</b></p><p style="font-size: larger"><b>'.get_option('image_2').'</b></p></div>
<div style="font-family: Delicious Handrawn, cursive;" id="third" class="infobox"><p>'.get_option('third_text').'</p> <p style="font-size: larger"><b>'.get_option('third_writer').'</b></p><p style="font-size: larger"><b>'.get_option('image_3').'</b></p></div>
</div>
<script>
let cycle = 2;
document.getElementById("first").style.display = "flex";
setInterval(()=>{
    let first = document.getElementById("first");
    let second = document.getElementById("second");
    let third = document.getElementById("third");
    if (cycle === 1){
    first.style.display = "flex";
    second.style.display = "none";
    third.style.display = "none";
    } else if (cycle === 2){
        first.style.display = "none";
    second.style.display = "flex";
    third.style.display = "none";
    } else if (cycle === 3){
        first.style.display = "none";
    second.style.display = "none";
    third.style.display = "flex";
    cycle = 1;
    }
    cycle += 1;
}, 5000)
</script>';
}
// Voeg styling toe in de <head>.
add_action('get_header','mystyles');
function mystyles(){
    echo '<style>
.TestimonialHeader{
width: 100%;
text-align: center;
}
.TestimonialBox{
width: 100%;
height: 30%;
display: flex;
flex-direction: row;
align-content: center;
justify-content: space-evenly;
}

  .infobox{
     background-color:white;
     font-size: 1.2em;
   min-width:10%;
   max-width:30%;
   border-radius: 10px;
   color:black;
   display: none;
   flex-direction: column;
   justify-content:center;
   align-items:center;}
   .infobox > *{
   margin: 5%;
   }
 </style>';
}

add_action('admin_menu', 'mijnplugin_menu');
function mijnplugin_menu(){
    add_menu_page('Wijzig tekst','Eigen plugin','manage_options','eigenplugin_settings_page','mijnplugin_page');
}
function mijnplugin_page(){
    echo '<h2>'.__('Testimonial Text','menu-test').'</h2>';
    include_once('TestimonialPlugin_settings.php');
}