# DEMO YII

## Установка
```bash
git clone https://github.com/killyouare/kekl.git
cd kekl/app
composer i
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
