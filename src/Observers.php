<?php

namespace event_manager;

class Observers implements \event_manager\ObserversInterface
{
    protected $id = null;
    public static $observers = array();

    // Evento construtor da classe
    public function __construct($index = null, $observer = null)
    {
        $this->id = microtime(true);
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
            self::$observers[$index] = $observer;
            return true;
        }
        return false;
    }

    // Exclui observador para o evento
    public function deattach($index)
    {
        if (isset($index) && !empty($index)) {
            unset(self::$observers[$index]);
            return true;
        }
        return false;
    }

    // Dispara o evento para os observadores
    public function notify()
    {
        foreach (self::$observers as $key => $item) {
            try {
                $item();
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
    public function listing()
    {
        return array_keys(self::$observers);
    }
}
