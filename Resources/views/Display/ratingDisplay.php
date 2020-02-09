<?php

echo('<div class="rating">');
    for ($i = 1; $i <= $max; $i++){
        $i <= $stars ? $class = 'star-full' : $class = 'star-empty';
        echo("<div class='${class} ${starSize}'></div>");
    };
echo('</div>');
