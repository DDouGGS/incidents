<?php

use event_manager\EventInterface;
use event_manager\Observers;

namespace event_manager;

class Event implements EventInterface
{
    protected $observers;

    public function __construct()
    {
        $this->observers = new Observers();
    }

    public static function make()
    {
        return new Event();
    }

    // Adicionar observador para o evento
    public function attach(string $name, $observer)
    {
        try {
            if (isset($name) && !empty($name)) {
                $this->observers->attach($name, $observer);
                return $this;
            }
        } catch (\Exception $e) {
            throw new \Exception('N�o foi poss�vel registrar observador.');
        }
        return $this;
    }

    // Exclui observador para o evento
    public function deattach(string $name)
    {
        try {
            if (isset($name) && !empty($name)) {
                $this->observers->deattach($name);
                return $this;
            }
        } catch (\Exception $e) {
            throw new \Exception('N�o foi poss�vel excluir observador.');
        }
        return $this;
    }

    // Dispara o evento
    public function notify()
    {
        return $this->observers->notify();
    }

    // Limpa os observadores
    public function clear()
    {
        return $this->observers->clear();
    }
}
