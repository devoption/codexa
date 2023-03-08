<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/docs-update', function() {
    Artisan::call('docs:update');
    return redirect('/');
});

Route::get('/{file?}', function ($file = 'home') {
    $index = file_get_contents(resource_path('docs/index.md'));
    $index = explode("\n", $index);

    $links = [];
    $parent_active = [];

    $i = 0;

    foreach ($index as $line) {
        if (trim($line) == '') {
            continue;
        }

        $name = str_replace(['[', ']', '-'], '', trim($line));
        $name = preg_replace('/\((.*?)\)/', '', $name);

        preg_match('/\((.*?)\)/', $line, $matches, PREG_OFFSET_CAPTURE);

        $active = false;

        if ($matches[1][0] == '/' . $file) {
            $active = true;
        }

        if ($matches[1][0] == '/' && $file == 'home') {
            $active = true;
        }

        $parent = false;

        if (strpos($line, '  ') !== false || strpos($line, "\t") !== false) {
            for ($j = $i - 1; $j >= 0; $j--) {
                if ($links[$j]['sub'] == false) {
                    $parent = $links[$j]['name'];
                    break;
                }
            }

            $links[] = [
                'name' => trim($name),
                'url' => $matches[1][0],
                'parent' => $parent,
                'sub' => true,
                'active' => $active,
            ];

            if ($active == true) {
                $parent_active[] = $parent;
            }
        } else {
            if (isset($index[$i + 1])) {
                if (strpos($index[$i + 1], '  ') !== false || strpos($index[$i + 1], "\t") !== false) {
                    $parent = 'self';
                }
            }

            $links[] = [
                'name' => trim($name),
                'url' => $matches[1][0],
                'parent' => $parent,
                'sub' => false,
                'active' => $active,
            ];
        }

        $i++;
    }

    return view('welcome')
        ->with([
            'links' => $links,
            'content' => file_get_contents(resource_path('docs/' . $file . '.md')),
            'parent_active' => $parent_active,
        ]);
});
