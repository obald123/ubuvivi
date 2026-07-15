<?php
echo '__DIR__: ' . __DIR__ . '<br>';
echo 'DOCUMENT_ROOT: ' . $_SERVER['DOCUMENT_ROOT'] . '<br>';
$base = __DIR__ . '/..';
echo 'Base path candidate: ' . realpath($base) . '<br>';
echo 'public_path candidate: ' . realpath($base) . '/public<br>';
echo 'Has vendor?: ' . (file_exists($base . '/vendor/autoload.php') ? 'YES' : 'NO') . '<br>';
echo 'Has bootstrap?: ' . (file_exists($base . '/bootstrap/app.php') ? 'YES' : 'NO') . '<br>';
echo 'mix-manifest in __DIR__: ' . (file_exists(__DIR__ . '/mix-manifest.json') ? 'YES' : 'NO') . '<br>';
// Check for public dir alongside __DIR__
$parent = dirname(__DIR__);
echo 'Parent dir contents: ';
$d = scandir($parent);
foreach ($d as $entry) {
    if ($entry !== '.' && $entry !== '..') {
        echo $entry . ' ';
    }
}
echo '<br>';
