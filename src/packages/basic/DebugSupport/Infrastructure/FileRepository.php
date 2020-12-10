<?php


namespace Basic\DebugSupport\Infrastructure;


trait FileRepository
{
    /** @var FileStore */
    private $store;

    /** @var null|string */
    protected $identifier = null;

    public function __construct()
    {
        $this->store = new FileStore();
    }

    public function loadAll()
    {
        return $this->store->getAll($this->id());
    }

    protected function store($key, $data)
    {
        $this->store->put($this->id(), $key, $data);
    }

    protected function load($key)
    {
        return $this->store->get($this->id(), $key);
    }

    private function id()
    {
        if (is_null($this->identifier)) {
            return __CLASS__;
        } else {
            return $this->identifier;
        }
    }
}
