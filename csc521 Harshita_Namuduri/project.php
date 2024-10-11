<?php

echo "Enter the path to your C program file: ";
$handle = fopen("php://stdin", "r");
$filePath = trim(fgets($handle));

if (file_exists($filePath)) {
    $input = file_get_contents($filePath);

    // Regex to match valid comments
    $validCommentRegex = '/\/\/.*|\/\*[\s\S]*?\*\//m';
    // Regex to find potential invalid comments
    $invalidCommentRegex = '/(\/\*.*\*\/)|(\/\/.*)/';

    $containsInvalidComments = preg_match($invalidCommentRegex, $input) && !preg_match($validCommentRegex, $input);

    if ($containsInvalidComments) {
        echo "Error: Invalid comment detected.\n";
    } else {
        // Remove valid comments
        $cleanedInput = preg_replace($validCommentRegex, '', $input);
        echo "Program without comments:\n" . $cleanedInput;
    }
} else {
    echo "File not found. Please ensure the file path is correct.\n";
}

fclose($handle);
?>
