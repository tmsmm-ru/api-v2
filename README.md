# Документация к TmSMM API совместимое с двумя популярными панелями для работы с соц. сетями

Получить PHP Class для работы с API можно по ссылке: https://github.com/tmsmm-ru/api-v2/blob/main/TmSMMApiV2.php

## #Получение баланса аккаунта
Используйте этот метод для получения баланса аккаунта



### Пример запроса

```
https://tmsmm.ru/api/v2?action=balance&key=yourKey
```

### Пример ответа

```
{
  "balance": "99.80", // текущий баланс
  "currency": "RUB" // валюта баланса
}
```



## #Получение списка услуг
Используйте этот метод для получения списка услуг

### Пример запроса

```
https://tmsmm.ru/api/v2?action=services&key=yourKey
```

### Пример ответа

```
[
  {
    "service": 117, // идентификатор сервиса
    "name": "Telegram - Подписчики премиум качества (Россия)", // название сервиса
    "type": "Default", // тип задания, один из: "Default", "Poll" или "Custom Comments"
    "category": "Telegram - Подписчики", // категория сервиса
    "rate": "1890.00", // цена за тысячу выполнений в валюте аккаунта
    "min": 10, // минимальное количество для заказа
    "max": 30000, // максимальное количество для заказа
    "refill": false, // доступен ли рефилл заказа
    "cancel": true // доступна ли отмена заказа
  }
]
```



## #Создание заказа
Используйте этот метод для создания заказа

### Пример запроса

```
https://tmsmm.ru/api/v2?action=add&service=117&link=https://t.me/username&quantity=100&key=yourKey
```

### Параметры для запроса

```
action=add // action
service // идентификатор сервиса 
link // ссылка на объект
quantity // количество выполнений
comments // если услуга на собственные комментарии, то необходимо передать "список фраз" в ином случае, поле не передавать
answer_number // если услуга на опрос, то необходимо передать "номер варианта ответа" в ином случае, поле не передавать
```

### Пример ответа

```
{
  "order": "65ae5538afdd1" // идентификатор заказа
}
```


## #Статус заказа
Используйте этот метод для получения информации о заказе

### Пример запроса

```
https://tmsmm.ru/api/v2?action=status&order=65ae5538afdd1&key=yourKey
```

### Параметры для запроса

```
action=status // action
order // идентификатор заказа 
```

### Пример ответа

```
{
  "charge": "189", // потраченные на заказ деньги
  "start_count": "3572", // количество на момент активации заказа
  "status": "Partial", // статус заказа, один из: "In progress", "Completed", "Awaiting", "Canceled", "Fail" или "Partial"
  "remains": "157", // оставшееся количество
  "currency": "RUB" // валюта заказа
}
```


## #Статус заказов
Используйте этот метод для получения информации о заказах

### Пример запроса

```
https://tmsmm.ru/api/v2?action=status&orders=65ae5538afdd1,65ae580a540f5,65ae57daea2c8&key=yourKey
```

### Параметры для запроса

```
action=status // action
orders // идентификаторы заказов, через запятую, максимум 100 штук 
```

### Пример ответа

```
[
  "65ae5538afdd1": {
    "charge": "189", // потраченные на заказ деньги
    "start_count": "3572", // количество на момент активации заказа
    "status": "Partial", // статус заказа, один из: "In progress", "Completed", "Awaiting", "Canceled", "Fail" или "Partial"
    "remains": "157", // оставшееся количество
    "currency": "USD" // валюта заказа
  },
  "65ae580a540f5": "Incorrect order ID",
  "65ae57daea2c8": "Incorrect order ID"
]
```


## #Создание рефилла для заказа
Используйте этот метод для создания рефилла для заказа

### Пример запроса

```
https://tmsmm.ru/api/v2?action=refill&order=65ae5538afdd1&key=yourKey
```

### Параметры для запроса

```
action=refill // action
order // идентификатор заказа
```

### Пример ответа

```
{
  "refill": "65ae5538afdd1" // идентификатор заказа
}
```


## #Создание рефилла для заказов
Используйте этот метод для создания рефилла для заказов

### Пример запроса

```
https://tmsmm.ru/api/v2?action=refill&orders=65ae5538afdd1,65ae580a540f5,65ae57daea2c8&key=yourKey
```

### Параметры для запроса

```
action=refill // action
orders // идентификаторы заказов, через запятую, максимум 100 штук 
```

### Пример ответа

```
[
  {
    "order": "65ae5538afdd1", // идентификатор заказа
    "refill": "65ae5538afdd1" // идентификатор рефилла
  },
  {
    "order": "65ae580a540f5", // идентификатор заказа
    "refill": "65ae580a540f5" // идентификатор рефилла
  },
  {
    "order": "65ae57daea2c8", // идентификатор заказа
    "refill": {
      "error": "Incorrect order ID"
   }
  }
]
```


## #Статус рефилла заказа
Используйте этот метод для получения статуса рефилла заказа

### Пример запроса

```
https://tmsmm.ru/api/v2?action=refill_status&refill=65ae5538afdd1&key=yourKey
```

### Параметры для запроса

```
action=refill_status // action
refill // идентификатор заказа
```

### Пример ответа

```
{
    "status": "Completed" // статус рефилла, один из: "In progress", "Completed", "Awaiting", "Canceled", "Fail" или "Partial"
}
```


## #Статус рефилла у заказов
Используйте этот метод для получения статусов рефилла у заказов

### Пример запроса

```
https://tmsmm.ru/api/v2?action=refill_status&refills=65ae5538afdd1,65ae580a540f5,65ae57daea2c8&key=yourKey
```

### Параметры для запроса

```
action=refill_status // action
refill // идентификаторы заказов, через запятую, максимум 100 штук 
```

### Пример ответа

```
[
  {
    "refill": "65ae5538afdd1", // идентификатор заказа
    "status": "Completed" // статус рефилла, один из: "In progress", "Completed", "Awaiting", "Canceled", "Fail" или "Partial" 
  },
  {
    "refill": "65ae580a540f5", // идентификатор заказа
    "status": "Rejected" // статус рефилла
  },
  {
    "refill": "65ae57daea2c8", // идентификатор заказа
    "status": {
      "error": "Refill not found"
    }
  }
]
```


## #Отмена заказа
Используйте этот метод для отмены заказа

### Пример запроса

```
https://tmsmm.ru/api/v2?action=cancel&order=65ae5538afdd1&key=yourKey
```

### Параметры для запроса

```
action=cancel // action
order // идентификатор заказа
```

### Пример ответа

```
{
  "ok": "true",
  "success": "true",
  "cancel": "65ae5538afdd1"
}
```


## #Отмена заказов
Используйте этот метод для отмены заказов

### Пример запроса

```
https://tmsmm.ru/api/v2?action=cancel&orders=65ae5538afdd1,65ae580a540f5,65ae57daea2c8&key=yourKey
```

### Параметры для запроса

```
action=cancel // action
orders // идентификаторы заказов, через запятую, максимум 100 штук 
```

### Пример ответа

```
[
  {
    "order": "65ae5538afdd1", // идентификатор заказа
    "cancel": "65ae5538afdd1" // идентификатор отмены
  },
  {
    "order": "65ae580a540f5", // идентификатор заказа
    "cancel": "65ae5538afdd1" // идентификатор отмены
  },
  {
    "order": "65ae57daea2c8", // идентификатор заказа
    "cancel": {
      "error": "Incorrect order ID"
   }
  }
]
```
