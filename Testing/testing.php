<?php
// *** Get just the hour from time string ***
    $time = "19:33";
    $dtime = DateTime::createFromFormat("G:i", $time);
    echo $dtime->format('G');

    echo date("l"); // WEEK DAY