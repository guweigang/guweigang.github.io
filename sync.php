<?php
function rsearch($folder, $pattern) {
    $dir = new RecursiveDirectoryIterator($folder);
    $ite = new RecursiveIteratorIterator($dir);
    $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
    $fileList = array();
    foreach($files as $file) {
        $fileList = array_merge($fileList, $file);
    }
    return $fileList;
}

$files = rsearch("../guweigang.github.io/", "/[\.\/0-9A-Za-z-]+\.html/");

echo "Starting Sync from branch source... "  . PHP_EOL;
foreach($files as $file) {
    echo " - Copying \"" . $file . "\"" . PHP_EOL;
    $dest = __DIR__. strstr(substr($file, 3), "/");
    echo "    ----> to \"" . $dest ."\"" . PHP_EOL;
    copy($file, $dest);
}
