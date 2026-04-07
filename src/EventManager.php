<?php

namespace event_manager;

use event_manager\ObserversInterface;

abstract class EventManager
{
    public static $observers = array();

    // Registra evento
    public static function store($event, $observers)
    {
        if (isset($event) && !empty($event) && $observers instanceof ObserversInterface) {
            static::$observers[$event] = $observers;
            return true;
        }
        return false;
    }

    // resgata evento registrado
    public static function recover($event)
    {
        if (isset(self::$observers[$event])) {
            return self::$observers[$event];
        }
        return null;
    }

    // Acessa evento
    public static function exists($event)
    {
        return (isset(self::$observers[$event]) && !empty(self::$observers[$event]))? true: false;
    }
}
