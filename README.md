 DEMO YII

## Установка

```bash
git clone https://github.com/killyouare/kekl.git
cd kekl/app
composer i --ignore-platform-reqs
cd ../
```

или

```bash
git clone https://github.com/killyouare/kekl.git
cd kekl
docker run --rm --interactive --tty --volume $PWD/app:/app --user $(id -u):$(id -g) composer i
```

## Запуск проекта

```bash
docker-compose up -d --build
```

## Приложение

| Приложение | Порт |
|------------|------|
| yii        | 80   |
| phpmyadmin | 8888 |
| mysql      | 3306 |

## База данных

| Атрибут  | Значение |
|----------|----------|
| host     | db |
| user     | root |
| password | my_root_password |
| database | my_database_name |