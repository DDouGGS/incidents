<?php

namespace event_manager;

// use ddouggs\event_manager\Event;

abstract class EventManager
{
    public static $events = array();

    // Registra evento
    // public static function register(string $name, $event)
    // {
    //     \test_command\TC::halt(array($name, $event));
    //     if (isset($name) && !empty($name)) {
    //         self::$events[$name] = $event;
    //         return true;
    //     }
    //     return false;
    // }

    // Acessa evento
    // public static function access(string $name)
    // {
    //     if (isset(self::$events[$name])) {
    //         return self::$events[$name];
    //     }
    //     return null;
    // }

    // Acessa evento
    // public static function exists(string $name)
    // {
    //     return (isset(self::$events[$name]) && !empty(self::$events[$name]))? true: false;
    // }
}
