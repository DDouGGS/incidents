<?php

namespace ddouggs\incidents;

abstract class Incidents
{
    protected $observers = array();

    // Adicionar observador para o evento
    public function observe(string $name, $observer)
    {
        $this->observers[$name] = Observers::make($name)->add($observer);
        return $this;
    }

    // Exclui observador para o evento
    public function despise(string $name, $observer)
    {
        $this->observers[$name]->remove($observer);
        return $this;
    }

    // Dispara o evento
    public function notify(string $name, $object)
    {
        $this->observers[$name]->notity($object);
        return $this;
    }
}
