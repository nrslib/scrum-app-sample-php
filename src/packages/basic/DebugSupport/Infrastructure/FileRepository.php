<?php


namespace Basic\DebugSupport\Infrastructure;


use Illuminate\Support\Facades\Cache;

trait FileRepository
{
    /** @var FileStore */
    private $store;
    private $keyToData;

    /** @var null|string */
    protected $identifier = null;

    public function __construct()
    {
        $this->store = new FileStore();
    }

    protected function store($key, $data) {
        $this->store->put($this->id(), $key, $data);
    }

    protected function load($key) {
         return $this->store->get($this->id(), $key);
    }

    protected function loadAll() {
        return $this->store->getAll($this->id());
    }

    private function id() {
        if (is_null($this->identifier)){
            return __CLASS__;
        }else{
            return $this->identifier;
        }
    }
}
