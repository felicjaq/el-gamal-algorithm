<?php

include __DIR__ . "/actions.php";
include __DIR__ . "/task.php";

function el_gamal_menu() : void {
    echo "Which operation you want to perform: \n1 - encrypt, 2 - decrypt \nOperation: ";
    $stream = fgets(STDIN);
    if($stream == '1') {
        echo "Specify the path to the directory with the preprocessed text: ";
        $input_dir = trim(fgets(STDIN));
        echo "Where do you want to save the encrypted message? Specify the path: ";
        $output_file = trim(fgets(STDIN));
        $files = array_diff(scandir($input_dir), array("..", "."));
        $parts = [];
        foreach ($files as $file) {
            $parts[] = file_get_contents($input_dir . "/" . $file);
        }
        encrypt_message($parts, $output_file);
    } else if($stream == 2) {
        if(!get_task()) {
            exit("");
        }
        echo "Specify the path to the file with the message you want to decrypt: ";
        $input_file = trim(fgets(STDIN));
        if(!file_exists($input_file)) {
            exit("Wrong path, try again...\n");
        }
        echo "Where do you want to save the decoded message? Specify the path: ";
        $output_file = trim(fgets(STDIN));
        echo "Specify the parameters { p, a, x } needed for the decoding, separated by a space: ";
        $keys_stream = explode(" ", trim(fgets(STDIN)));
        if(!count($keys_stream) < 3) {
            exit("You did not enter all the parameters, try again...");
        }
        $p = (int)$keys_stream[0]; $a = (int)$keys_stream[1]; $x = (int)$keys_stream[2];
        $message = file_get_contents($input_file);
        decrypt_message($message, $p, $a, $x, $output_file);
    } else {
        exit("Wrong answer, try again...");
    }
}

el_gamal_menu();

