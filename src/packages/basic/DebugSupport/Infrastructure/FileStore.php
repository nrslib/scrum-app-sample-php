<?php


namespace Basic\DebugSupport\Infrastructure;


class FileStore
{
    /** @var FileSystem */
    private $files;

    public function __construct()
    {
        $this->files = new FileSystem();
    }

    public function get($id, $key)
    {
        $filePath = $this->fileFullPathFromId($id);
        if (!$this->files->exists($filePath)) {
            return null;
        }

        $data = $this->files->get($filePath);
        $array = unserialize($data);

        if (!array_key_exists($key, $array)) {
            return null;
        }

        return $array[$key];
    }

    public function getAll($id)
    {
        $filePath = $this->fileFullPathFromId($id);
        if (!$this->files->exists($filePath)) {
            return array();
        }

        $data = $this->files->get($filePath);
        $array = unserialize($data);

        return $array;
    }

    public function put($id, $key, $data)
    {
        $this->ensureDirectoryExists($this->directoryFullPath());
        $filePath = $this->fileFullPathFromId($id);
        if ($this->files->exists($filePath)) {
            $savedData = $this->files->get($filePath);
            $array = unserialize($savedData);
        } else {
            $array = array();
        }

        $array[$key] = $data;

        $serialized = serialize($array);

        $this->ensureDirectoryExists(dirname($filePath));
        $this->files->put($filePath, $serialized);
    }

    private function ensureDirectoryExists(string $path)
    {
        if (!$this->files->exists($path)) {
            $this->files->makeDirectory($path, @755, true);
        }
    }

    private function fileFullPathFromId(string $filePath)
    {
        return $this->directoryFullPath() . "\\" . $filePath . ".dat";
    }

    private function directoryFullPath()
    {
        $basicDirectoryPath = FileRepositoryConfig::$basicDirectoryFullPath;
        return $basicDirectoryPath;
    }
}
