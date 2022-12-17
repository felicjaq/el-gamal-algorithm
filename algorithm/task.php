<?php

function get_task() : bool {
    $number_1 = rand(5, 10); $number_2 = rand(1, 5);
    $operations = array("+", "-");
    $rand_operation = array_rand($operations);
    if($rand_operation == 0) {
        $answer = $number_1 + $number_2;
    } else {
        $answer = $number_1 - $number_2;
    }
    echo "Are you sure you're not a robot?\n";
    echo  $number_1 . " " . $operations[$rand_operation] . " " . $number_2 . " = ";
    $stream = trim((int)fgets(STDIN));
    if ($stream == $answer) {
        return true;
    }

    return false;
}