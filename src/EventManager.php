<?php

namespace event_manager;

use event_manager\ObserversInterface;

abstract class EventManager
{
    public static $events = array();

    // Registra evento
    public static function register($event, $index= null, \Closure $observer = null)
    {
        if (isset($event) && !empty($event)) {
            static::$events[$event] = new Observers($index, $observer);
            return true;
        }
        return false;
    }

    // resgata evento registrado
    public static function recover($event)
    {
        if (isset(self::$events[$event])) {
            return self::$events[$event];
        }
        return null;
    }

    // Acessa evento
    public static function exists($event)
    {
        return (isset(self::$events[$event]) && !empty(self::$events[$event]))? true: false;
    }

    // Adiciona observador para o evento
    public static function attach($event, $index, \Closure $observer)
    {
        if (!isset($event) || empty($event) || !isset($index) || empty($index)) { return false; }
        $o = self::recover($event);
        if(isset($o)) {
            return $o->attach($index, $observer);
        }
        return false;
    }

    // Exclui observador para o evento
    public static function deattach($event, $index)
    {
        if (!isset($event) || empty($event) || !isset($index) || empty($index)) { return false; }
        $o = self::recover($event);
        if(isset($o)) { 
            return $o->deattach($index);
        }
        return false;
    }

    // Dispara o evento para os observadores
    public static function notify($event)
    {
        $o = self::recover($event);
        if(isset($o)) { $o->notify();}
    }

    // Limpa os observadores
    public static function clear($event)
    {
        $o = self::recover($event);
        if(isset($o)) { $o->clear();}
    }

    // Lista de observers para o evento
    public static function list($event)
    {
        $o = self::recover($event);
        return (isset($o))? $o->list(): array();
    }
}
