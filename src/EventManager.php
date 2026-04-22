<?php

namespace event_manager;

use event_manager\Observers;

abstract class EventManager
{
    public static $events = array();

    // Registra um novo evento ou acrescenta observador a um já existente
    public static function add($name, $index = null, Object $observer = null)
    {
        // register listener
        if (isset($name) && !empty($name)) {
            if($this->exists($name)){
                // with observer
                if(isset($index) && !empty($index) && isset($observer) && !empty($observer)){
                    if(method_exists($observer, $name)){
                        self::$events[$name]->attach( $index, $observer);
                        return true;
                    }
                    return false;
                }
                return $this->newObserver($name);
            }
            // with observer
            if(isset($index) && !empty($index) && isset($observer) && !empty($observer)){
                self::$events[$name] = new Observers($name, $index, $observer);
                return true;
            }
            return $this->newObserver($name);
        }
        return false;
    }

    // Adiciona novo observer para o evento
    private function newObserver($name)
    {
        try{
            self::$events[$name] = new Observers($name);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return true;
    }

    // Recupera evento registrado
    public static function retrieve($event)
    {
        return (isset(self::$events[$event]))? self::$events[$event]: null;
    }

    // Existencia do evento
    public static function exists($event)
    {
        return (isset(self::$events[$event]) && !empty(self::$events[$event]))? true: false;
    }

    // Adiciona observador para o evento
    public static function attach($event, $index, Object $observer)
    {
        if (!isset($event) || empty($event) || !isset($index) || empty($index)) { return false; }
        $o = self::retrieve($event);
        return (isset($o))? $o->attach($index, $observer): false;
    }

    // Exclui um observador de determinado evento
    public static function deattach($event, $index)
    {
        if (!isset($event) || empty($event) || !isset($index) || empty($index)) { return false; }
        $o = self::retrieve($event);
        return (isset($o))? $o->deattach($index): false;
    }

    // Notifica os observadores do evento
    public static function notify($event)
    {
        $o = self::retrieve($event);
        return (isset($o))? $o->notify($this): false;
    }

    // Limpa todos os observadores para um determinado evento
    public static function clear($event)
    {
        $o = self::retrieve($event);
        return (isset($o))? $o->clear(): false;
    }

    // Lista os observers de determinado evento
    public static function keysObservers($event)
    {
        $o = self::retrieve($event);
        return (isset($o))? $o->listing(): array();
    }
}
