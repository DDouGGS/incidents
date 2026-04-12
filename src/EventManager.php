<?php

namespace event_manager;

abstract class EventManager
{
    public static $events = array();

    // Registra evento
    public static function register($event, $index, \Closure $observer)
    {
        if (isset($event) && !empty($event)) {
            self::$events[$event] = new \event_manager\Observers($index, $observer);
            return true;
        }
        return false;
    }

    // resgata evento registrado
    public static function recover($event)
    {
        return (isset(self::$events[$event]))? self::$events[$event]: null;
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
        return (isset($o))? $o->attach($index, $observer): false;
    }

    // Exclui observador para o evento
    public static function deattach($event, $index)
    {
        if (!isset($event) || empty($event) || !isset($index) || empty($index)) { return false; }
        $o = self::recover($event);
        return (isset($o))? $o->deattach($index): false;
    }

    // Dispara o evento para os observadores
    public static function notify($event)
    {
        $o = self::recover($event);
        return (isset($o))? $o->notify(): false;
    }

    // Limpa os observadores
    public static function clear($event)
    {
        $o = self::recover($event);
        return (isset($o))? $o->clear(): false;
    }

    // Lista de observers para o evento
    public static function listing($event)
    {
        $o = self::recover($event);
        return (isset($o))? $o->listing(): array();
    }
}
