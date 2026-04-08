<?php

namespace event_manager;

interface ObserversInterface {
    // Adiciona observador para o evento
    public function attach($index, $observer);

    // Exclui observador para o evento
    public function deattach($index);
    
    // Dispara o evento para os observadores
    public function notify();

    // Limpa os observadores
    public function clear();

    // Lista de observers para o evento
    public function list();
}
