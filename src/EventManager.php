<?php

namespace event_manager;

use event_manager\EventInterface;

abstract class EventManager
{
    public static $events = array();

    // Registra evento
    public static function store($name, $event)
    {
        if (isset($name) && !empty($name) && $event instanceof EventInterface) {
            static::$events[$name] = $event;
            return true;
        }
        return false;
    }

    // resgata evento registrado
    public static function recover($name)
    {
        if (isset(self::$events[$name])) {
            return self::$events[$name];
        }
        return null;
    }

    // Acessa evento
    public static function exists($name)
    {
        return (isset(self::$events[$name]) && !empty(self::$events[$name]))? true: false;
    }
}
