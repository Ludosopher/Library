# Тестовое приложение "Библиотека"

## Общая информация
Приложение разработано на фреймворке Laravel в качестве тестового задания при соискании должности PHP-developer(Laravel) в компанию ООО "Медкорт" г. Екатеринбург. 
**[Здесь размещено задание (28.04.2023)](https://docs.google.com/forms/d/e/1FAIpQLSe2wsvLlznZMphfJJqtYCbKRGIcHOzDuarDMdOhlljCzQ2sAw/viewform)**

## Стек технологий
PHP 7.2; Laravel 7; Laravel Blade; maatwebsite/excel 3.1; Bootstrap 4; HTML; CSS.  

## Содержание приложения
Были выполнены все задания. 
Приложение содержит:
- миграции для пользователей, книг, комментариев к книгам и категорий книг;
- посев тестовых данных в том числе первого пользователя;
- регистрацию и авторизацию пользователей;
- отображение общего списка книг или категорий книг с пагинацией;
- фильтрацию списка книг по категориям;
- добавление, обновление и удаление пользователей, книг или их категорий;
- при добавлении или обновлении книг можно загрузить изображение обложки в хранилище (storage/app/public/covers);
- домашнюю страницу пользователя;
- отображение каждой отдельной книги и каталога;
- валидацию входящих данных путём создания специальных классов Request;
- работу с базой данных исключительно на основе Eloquent ORM (без обычных SQL-запросов);
- email уведомления при добавлении нового пользователя в очереди (Job);
- возможность читателям оставлять комментарии к книгам;
- парсер excel файла с реестром книг в очереди (job) кусками по 100 книг за раз;
- API аутентификацию и получение json со списком книг определённой категории.


## Начало работы
После установки приложения запустить:
1. миграции и посев тестовых данных: php artisan migrate:fresh --seed
2. работу очередей: php artisan queue:work
3. Можно войти в качестве заранее зарегистрированного пользователя: 
    Логин: admin@mail.ru
    Пароль: 1234567890


## Email уведомления при добавлении нового пользователя
При регистрации нового пользователя укажите реально существующий адрес электронной почты. Сразу после регистрации на него придёт уведомление.


## Комментарии к книгам
Комментарии к книгам можно оставить на странице каждой отдельной книги.


## Парсинг excel файла с реестром книг
Для того чтобы выплнить парсинг excel файла с реестром книг в общем меню перейдите: "Книги -> Импорт". Далее выберите на своём компьютере Excel файл со списком книг и нажмите "Импортировать". Затем перейдите: "Книги -> Список" чтобы увидеть добавление новых книг. 
[Пример Excel файла со списком книг (28.04.2023)](https://docs.google.com/spreadsheets/d/1LpyjeuO9Tz7zN4myiDSt1AVlGn9PFd4l/edit#gid=682307266)


## API аутентификация и получение списка книг определённой категории по API
1. В Postman добавьте POST-запрос по адресу: http://localhost/medkort_library/public/api/login
   Тело запроса:
    {
      "email": "admin@mail.ru",
      "password": "1234567890"
    }
    В ответе должен быть токен.
2. В Postman создайте новый POST-запрос по адресу: http://localhost/medkort_library/public/api/book/get-all
   Используйте в качестве Bearer token токен, полученный при первом запросе.
   Тело запроса:
    {
        "category_id": 1
    }
    В ответе вы должен быть список книг категории "Научная фантастика".