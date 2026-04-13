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

### Regra para a formação do Closure

- Não utilizar parâmetros de entrada;

- Passar todos os objetos ou dados pelo 'use';

- A função deve retornar um true ou false em caso de erro tratado.

* * *

## 🛠️ Métodos Disponíveis

### 🔹 register(event, index = null, Closure observer = null)

Registra um novo evento.

```php
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

### 🔹 listing(event)

Lista todos os observers registrados para um evento.

```php
$observers = EventManager::listing('onCreated');
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

// attach event
$robot = $this;
$constSqlOnly = self::OPTION_SQL_ONLY;
\event_manager\EventManager::register('onSqlOnly', 'sqlOnly', ($sqlonly = function () use($robot, $constSqlOnly){
    $so = $robot->get_option($constSqlOnly) ;
    $robot->message(sprintf("Opção pelo SQL ONLY %s", empty($so)? 'não existe':'existe'));
}));

// notify event
\event_manager\EventManager::notify('onSqlOnly');
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
        
    - `listing`
        

* * *

## 🧩 Próximas Melhorias

- Tratamento de exceções

- Observers padronizados com funções assincronas, priorizadas, etc;

- Registro do estado da execução e a possibilidade de retomada a partir de onde parrou;

- Registro de log;
    

* * *

## 📄 Licença

A Licença Apache 2.0 é uma licença de software de código aberto permissiva e popular. Ela permite o uso, modificação, distribuição e comercialização do software, inclusive em projetos fechados, desde que mantenha os créditos de autoria, inclua uma cópia da licença e relate as alterações feitas..

* * *