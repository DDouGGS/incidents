<?php

use event_manager\EventInterface;
use event_manager\Observers;

namespace event_manager;

class Event implements EventInterface
{
    protected $observers = null;

    // Evento construtor da classe
    public function __construct($index = null, $observer = null)
    {
        $this->observers = new Observers($index, $observer);
    }

    // Cria instancia da classe
    public static function make($index = null, $observer = null)
    {
        return new Event($index, $observer);
    }

    // Adicionar observador para o evento
    public function attach($index, $observer)
    {
        try {
            if(isset($index) && !empty($index) && isset($observer)) {
                $this->observers->attach($index, $observer);
                return $this;
            }
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível registrar observador.');
        }
        return $this;
    }

    // Exclui observador para o evento
    public function deattach($index)
    {
        try {
            if (isset($index) && !empty($index)) {
                $this->observers->deattach($index);
                return $this;
            }
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível excluir observador.');
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
