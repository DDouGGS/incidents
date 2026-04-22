<?php

namespace event_manager;

use event_manager\ObserversInterface;

class Observers implements ObserversInterface
{
    protected $event = null;
    protected $brand = null;
    public static $observers = array();

    // Evento construtor da classe
    public function __construct($event, $index = null, Object $observer = null)
    {
        if(isset($event) && !empty($event) && isset($index) && !empty($index) && !empty($observer)){
            $this->attach($index, $observer);
        }
    }

    // Criar instancia da classe
    public static function make($event, $index = null, Object $observer = null)
    {
        return new Decree($event, $index, $observer);
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
    public function notify(&$paramn)
    {
        foreach (self::$observers as $key => $item) {
            try {
                $item->{$this->event}($paramn);
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
    public static function keysObservers()
    {
        return array_keys(self::$observers);
    }
}
