<<<<<<< HEAD
# Tickets Gateway

## Описание
REST API для работы с билетным шлюзом.  
Используется Laravel 12.  
Реализация через сервис с интерфейсом для легкой смены поставщика билетов.

## Запуск
1. Клонировать репозиторий git clone https://github.com/Masyanov/tickets-gateway.git
2. Выполнить `composer install`
3. Запустить сервер: php artisan serve

4. Доступные эндпоинты:
- GET /api/shows — список мероприятий
- GET /api/shows/{showId}/events — детали мероприятия
- GET /api/events/{eventId}/places — детали события
- POST /api/events/{eventId}/reserve — бронирование мест

5. Документация Swagger доступна по:

http://localhost:8000/api/documentation


## Архитектура
- Используется сервисный слой с интерфейсом TicketProviderInterface
- Реализация LeadBookTicketProvider взаимодействует с внешним API по токену
- Контроллер проксирует запросы к провайдеру
- Swagger для автодокументации
- Тесты с моками для независимости от внешнего API

Этот подход позволяет легко поменять поставщика билетов: достаточно добавить новую реализацию TicketProviderInterface и переключить биндинг в сервис-контейнере.


=======
# tickets-gateway
>>>>>>> 036c1b799652fddbb3c9c8dbb1cf9f49a66da860
