<?php

namespace event_manager;

use event_manager\ObserversInterface;

class Observers implements ObserversInterface
{
    protected $observers = array();

    // Evento construtor da classe
    public function __construct($index = null, $observer = null)
    {
        if(isset($index) && !empty($index) && !empty($observer)){
            $this->attach($index, $observer);
        }
    }

    // Criar instancia da classe
    public static function make($index = null, $observer = null)
    {
        return new Observers($index, $observer);
    }

    // Adiciona observador para o evento
    public function attach($index, $observer)
    {
        if(isset($index) && !empty($index) && !empty($observer)) {
            $this->observers[$index] = $observer;
            return true;
        }
        return false;
    }

    // Exclui observador para o evento
    public function deattach($index)
    {
        if (isset($index) && !empty($index)) {
            unset($this->observers[$index]);
            return true;
        }
        return false;
    }

    // Dispara o evento para os observadores
    public function notify()
    {
        foreach ($this->observers as $key => $item) {
            try {
                if (!$item()) {
                    throw new \Exception(sprintf("Erro durante a execução do observador %s.", $key));
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        return true;
    }

    // Limpa os observadores
    public function clear()
    {
        self::$observers = array();
        return empty(self::$observers) ? true : false;
    }

    // Lista de observers para o evento
    public function list()
    {
        return array_keys(self::$observers);
    }
}
