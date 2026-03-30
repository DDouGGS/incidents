<?php

namespace ddouggs\incidents;

class Observers implements ObserversInterface
{
    protected $name      = null;
    protected $observers = array();
    protected $erros     = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name)
    {
        return new Observers($name);
    }

    public function add(ObserversInterface $observer)
    {
        $this->observers[] = $observer;
        return $this;
    }

    public function remove(string $nameClass)
    {
        $observers = array();
        foreach ($this->observers as $observer) {
            if (get_class($observer) === $nameClass) {
                continue;
            }
            $observers[] = $observer;
        }
        $this->observers = $observers;
        return $this;
    }

    public function notify(object $object)
    {
        foreach ($this->observers as $item) {
            if (method_exists($item, $this->name)) {
                try {
                    if (!$item->{$this->name}($object)) {
                        continue;
                    }
                } catch (\Exception $e) {
                    $this->erros[] = sprintf("Erro: " . $e->getMessage() . '. Evento %s.', $this->name);
                    continue;
                }
            }
        }
        return $this;
    }
}
