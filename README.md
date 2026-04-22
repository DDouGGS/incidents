# 📦 EventManager

Uma implementação simples de gerenciamento de eventos baseada no padrão **Observer**, permitindo registrar eventos, adicionar/remover observadores e notificar listeners de forma desacoplada.

## 🚀 Visão Geral

A classe `EventManager` fornece uma estrutura estática para:

* Registrar eventos
* Associar observadores a eventos
* Notificar observadores quando um evento ocorre
* Gerenciar o ciclo de vida dos observers

Ela depende da classe `Observers`, responsável por armazenar e executar os observadores.

---

## 🧠 Conceitos

* **Evento**: Identificado por um nome (string)
* **Observer (Observador)**: Um objeto que contém um método com o mesmo nome do evento
* **Notificação**: Execução dos métodos dos observadores registrados

---

## 📚 Métodos

### `add($name, $observer = null)`

Registra um novo evento ou adiciona um observador a um evento existente.

```php
EventManager::add('onUserCreate', $observer);
```

* `$name`: Nome do evento
* `$observer`: Objeto com método correspondente ao evento

---

### `retrieve($event)`

Retorna o objeto do evento registrado.

```php
$event = EventManager::retrieve('onUserCreate');
```

---

### `exists($event)`

Verifica se o evento existe.

```php
EventManager::exists('onUserCreate'); // true ou false
```

---

### `attach($event, $observer)`

Adiciona um observador a um evento existente.

```php
EventManager::attach('onUserCreate', $observer);
```

---

### `deattach($event, $index)`

Remove um observador de um evento.

```php
EventManager::deattach('onUserCreate', 'ObserverClassName');
```

---

### `notify($event, &$paramn)`

Notifica todos os observadores do evento.

```php
EventManager::notify('onUserCreate', $data);
```

* `$paramn` deve ser um objeto (passado por referência)

---

### `clear($event)`

Remove todos os observadores de um evento.

```php
EventManager::clear('onUserCreate');
```

---

### `keys($event)`

Lista os observadores registrados no evento.

```php
$list = EventManager::keysObservers('onUserCreate');
```

---

## 🧩 Exemplo de Uso

```php
class UserObserver {
    public function onUserCreate($data) {
        echo "Usuário criado: " . $data->name;
    }
}

// Criar observer
$observer = new UserObserver();

// Registrar evento + observer
EventManager::add('onUserCreate', $observer);

// Disparar evento
$data = (object)['name' => 'João'];
EventManager::notify('onUserCreate', $data);
```

---

## ⚠️ Regras Importantes

* O observer **deve ser um objeto**
* O observer **deve possuir um método com o mesmo nome do evento**
* O parâmetro passado em `notify` **deve ser um objeto**
* Eventos são armazenados estaticamente (escopo global da aplicação)

---

## 🏗️ Estrutura Interna

* `EventManager::$events`: Array estático que armazena os eventos
* Cada evento é uma instância da classe `Observers`

---

## 📌 Possíveis Melhorias

* Suporte a closures/callbacks
* Namespaces mais desacoplados
* Tratamento de exceções mais granular
* Logs de execução

---

## 📄 Licença

A Licença Apache 2.0 é uma licença de software de código aberto permissiva e popular. Ela permite o uso, modificação, distribuição e comercialização do software, inclusive em projetos fechados, desde que mantenha os créditos de autoria, inclua uma cópia da licença e relate as alterações feitas…

---
