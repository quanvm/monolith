<?php

namespace at\labs;

return function ($pwd, $projects) {
    $branches = [
        'quiz'    => '1.x',
        'default' => 'master',
    ];

    foreach ($projects as $lang => $services) {
        foreach ($services as $name => $path) {
            $branch = isset($branches[$name]) ? $branches[$name] : $branches['default'];
            $target = ('golang' === $lang) ? "$pwd/$lang/src/vendor/go1/$name" : "$pwd/$lang/$name";

            if (!is_dir($target)) {
                echo "git clone -q --branch=$branch $path $target\n";
                passthru("git clone -q --branch=$branch $path $target");
            }
        }
    }
};
