<?php
/**
* Plugin Name: Testimonial Plugin
* Description: Easy Testimonials !!
* Version: 0.1
* Author: Shrooms
* Author URI: https://u220722.gluwebsite.nl/
*/

add_action('get_footer','mybox');
function mybox(){
    echo '
        <div id=testimonial-box>
            <h2 class="testimonial-header"><pre></pre>Testimonials from clients</h2>
            <div class="testimonials">
                <div id="first" class="infobox"><p>'.get_option("testimonial1text").'</p> <p style="font-size: larger"><b>'.get_option("testimonial1author").'</b></p><p style="font-size: larger"><b>'.get_option("testimonial1img").'</b></p></div>
                <div id="second" class="infobox"><p>'.get_option("testimonial2text").'</p> <p style="font-size: larger"><b>'.get_option("testimonial2author").'</b></p><p style="font-size: larger"><b>'.get_option("testimonial2img").'</b></p></div>
                <div id="third" class="infobox"><p>'.get_option("testimonial3text").'</p> <p style="font-size: larger"><b>'.get_option("testimonial3author").'</b></p><p style="font-size: larger"><b>'.get_option("testimonial3img").'</b></p></div>
            </div>
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

// styling
add_action("get_header", "testimonial_style");
function testimonial_style(){
    echo "
        <style>                
            .testimonial-header {
                width: 100%;
                text-align: center;
            }

            .testimonials {
                width: 100%;
                height: 30%;
                display: flex;
                flex-direction: row;
                align-content: center;
                justify-content: space-evenly;
            }

            .infobox { 
                background-color:white;
                font-size: 1.2em;
                min-width:10%;
                max-width:30%;
                border-radius: 10px;
                color:black;
                display: none;
                flex-direction: column;
                justify-content:center;
                align-items:center;
            }
            
            .infobox > * {
                margin: 5%;
            }
        </style>";
}

add_action("admin_menu", "testimonial_menu");
function testimonial_menu() {
    add_menu_page("Testimonial", "Testimonial Menu", "manage_options", "testimonial_settings_page", "testimonial_page");
}

function testimonial_page(){
    echo "<h1>" .__("Testimonials") . "</h1>";
    include_once("testimonial-menu.php");
}