<?php


namespace Basic\DebugSupport\Infrastructure;


class FileSystem
{
    public function exists($path){
        return file_exists($path);
    }

    public function put($path, $contents, $lock = false) {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    public function get($path) {
        return file_get_contents($path);
    }

    public function makeDirectory($path, $mode = 755, $recursive = false) {
        mkdir($path, $mode, $recursive);
    }
}
