<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
echo 'base_path: ' . base_path() . '<br>';
echo 'public_path: ' . public_path() . '<br>';
echo 'mix-manifest at public_path(): ' . (file_exists(public_path('mix-manifest.json')) ? 'YES' : 'NO') . '<br>';
echo 'mix-manifest at __DIR__: ' . (file_exists(__DIR__ . '/mix-manifest.json') ? 'YES' : 'NO') . '<br>';
