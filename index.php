<?php
    try{
        define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
        define( 'PUBLIC_HTML_PATH', __DIR__ . '/' );
        chdir(__DIR__);
        require realpath(FCPATH . 'app/Config/Paths.php') ?: FCPATH . 'app/Config/Paths.php';
        $paths = new Config\Paths();
        $bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
        $app       = require realpath($bootstrap) ?: $bootstrap;
        $app->run();
    }catch (\Exception $ex){
        echo "Lỗi xảy ra: " . $ex->getTraceAsString();
    }

