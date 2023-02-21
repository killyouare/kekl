# DEMO YII

## Установка
```bash
cd demo/app
composer i
cd ../
```

или
```bash
cd demo
docker run --rm --interactive --tty --volume $PWD/app:/app --user $(id -u):$(id -g) composer i
```

## Запуск проекта

```bash
docker-compose up -d --build
```
