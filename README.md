# 📦 EventManager

Uma classe abstrata em PHP para gerenciamento de eventos utilizando o padrão **Observer**.  
Permite registrar eventos, anexar observadores (callbacks) e notificá-los quando um evento é disparado.

* * *

## 🚀 Funcionalidades

- Registro de eventos
    
- Adição e remoção de observadores
    
- Disparo de eventos
    
- Listagem de observadores
    
- Limpeza de eventos
    

* * *

## 📂 Estrutura

A classe `EventManager` depende de uma implementação de `Observers`, responsável por armazenar e executar os observers.

* * *

## 🛠️ Métodos Disponíveis

### 🔹 register(event, index = null, Closure observer = null)

Registra um novo evento.

```php
EventManager::register('onCreated');

EventManager::register('onCreated', 'created', $observe);
```

* * *

### 🔹 recover(event)

Recupera um evento registrado.

```php
$event = EventManager::recover('onCreated');
```

* * *

### 🔹 exists(event)

Verifica se um evento existe.

```php
if (EventManager::exists('onCreated')) {
    // evento existe
}
```

* * *

### 🔹 attach(event, index, Closure observer)

Adiciona um observer a um evento.

```php
$manager->attach('onCreated', 'created', function () {
    echo "Enviar email";
});
```

* * *

### 🔹 deattach(event, index)

Remove um observer de um evento.

```php
$manager->deattach('onCreated', 'created');
```

* * *

### 🔹 notify(event)

Dispara o evento, executando todos os observers associados.

```php
EventManager::notify('onCreated');
```

* * *

### 🔹 clear(event)

Remove todos os observers de um evento.

```php
EventManager::clear('onCreated');
```

* * *

### 🔹 list(event)

Lista todos os observers registrados para um evento.

```php
$observers = EventManager::list('onCreated');
```

* * *

## 💡 Exemplo Completo

```php
use event_manager\EventManager;

// Registrar evento
EventManager::register('onCreated');

// Criar instância
$manager = new class extends EventManager {};

// Adicionar observers
$manager->attach('onCreated', 'log', function () {
    echo "Log do usuário criado\n";
});

$manager->attach('onCreated', 'email', function () {
    echo "Email enviado\n";
});

// Disparar evento
EventManager::notify('onCreated');
```

* * *

## 📌 Observações

- Cada evento pode ter múltiplos *observers* identificados por um índice único.
    
- Os observers são implementados como `Closure`.
    
- A classe `Observers` deve implementar os métodos:
    
    - `attach`
        
    - `deattach`
        
    - `notify`
        
    - `clear`
        
    - `list`
        

* * *

## 🧩 Possíveis Melhorias

- Suporte a parâmetros nos eventos
    
- Tipagem mais forte (PHP 7+ / 8+)
    
- Tratamento de exceções
    
- Suporte a prioridades de execução
    

* * *

## 📄 Licença

A Licença Apache 2.0 é uma licença de software de código aberto permissiva e popular. Ela permite o uso, modificação, distribuição e comercialização do software, inclusive em projetos fechados, desde que mantenha os créditos de autoria, inclua uma cópia da licença e relate as alterações feitas..

* * *