# 📦 EventManager (PHP)

Uma implementação simples de um gerenciador de eventos utilizando o padrão **Observer** em PHP.  
Essa classe permite registrar, recuperar, verificar e disparar eventos para observadores.

## 🚀 Funcionalidades

- Registrar observadores para eventos
- Recuperar eventos registrados
- Verificar se um evento existe
- Disparar notificações para observadores
- Limpar observadores de um evento

* * *

## 📁 Estrutura

Debaixo do namespace event_manager a classe EventManager é **abstrata** e utiliza métodos estáticos para gerenciar eventos globalmente.

* * *

## 🧠 Conceito

O `EventManager` segue o padrão **Observer**, onde:

- **Eventos** são identificados por strings
- **Observadores** devem implementar a interface `ObserversInterface`
- Os **Observadores** são abastecidos de funções do tipo Closure, onde serão manipulados os dados e objetos recebidos via USE conforme sua finalidade.
- Quando um evento é disparado, todos os observadores associados são notificados

* * *

## 🛠️ Métodos

### `register($event, $observers)`

Registra um observador para um evento.

EventManager::register(‘onCreated’, \$observer);

**Parâmetros:**

- `$event` (string): Nome do evento
- `$observers` (ObserversInterface): Instância do observador

**Retorno:**

- `true` se registrado com sucesso
- `false` caso contrário


**Observação:**

- Por convenção o nome do evento em '$event', deve sempre começar com o prefixo 'on', e as demais palavras começando com letra maíuscula, conforme a formação snake.


* * *

### `recover($event)`

Recupera o observador associado ao evento.

$observer = EventManager::recover(‘onCreated’);

**Retorno:**

- Instância do observador ou `null`

* * *

### `exists($event)`

Verifica se um evento está registrado.

if (EventManager::exists(‘user.created’)) {  
// …  
}

**Retorno:**

- `true` ou `false`

* * *

### `notify($event)`

Dispara o evento, notificando o observador.

EventManager::notify(‘user.created’);

* * *

### `clear($event)`

Limpa os observadores do evento.

EventManager::clear(‘user.created’);

* * *

## 📌 Requisitos

- PHP 5.3+
- Os **Observers**  devido à Interface `ObserversInterface` deve conter os seguintes métodos:
     - `attach($index, $observer)`
    - `deattach($index)`
	- `notify()`
    - `clear()`

* * *

## 💡 Exemplo de Uso
```php
class UserObserver implements ObserversInterface
{  
	public function notify() {  
		echo “Usuário criado!”;  
	}
	
	public function clear() {  
		echo “Observadores limpos!”;  
	}  
}

$getDate = function() use(){
	echo Date(NOW);
}
$observer = new UserObserver('getDate', $getDate);  
EventManager::register(‘onCreated’, $observer);  
EventManager::notify(‘onCreated’);
```

* * *

## ⚠️ Observações

- Cada evento suporta apenas **um observador por chave** (sobrescreve se registrar novamente).
- Todos os métodos são **estáticos**, funcionando como um registry global.
- Não há suporte nativo para múltiplos observadores por evento (pode ser estendido).

* * *

## 📄 Licença Apache 2.0

A Licença Apache 2.0 é uma licença de software de código aberto permissiva e popular. Ela permite o uso, modificação, distribuição e comercialização do software, inclusive em projetos fechados, desde que mantenha os créditos de autoria, inclua uma cópia da licença e relate as alterações feitas.