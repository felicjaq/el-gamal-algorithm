<?php

function text_preprocessing(): void {
    echo "Specify the path to the preprocessing file and the delimiter: ";
    $stream = explode(" ", trim(fgets(STDIN)));
    echo "Specify the path to the directory where you want to save the processed text: ";
    $dir = trim(fgets(STDIN));
    if(!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    $input_file = $stream[0]; $delimiter = $stream[1];
    if (file_exists($input_file)) {
        $message = explode($delimiter, file_get_contents($input_file));
        for ($i = 0; $i < count($message); $i++) {
            file_put_contents($dir. "/part_" . $i . ".txt", $message[$i]);
        }
        echo "Text preprocessing was successful...\n";
    } else {
        exit("You entered the wrong path, try again...\n");
    }
}


text_preprocessing();
