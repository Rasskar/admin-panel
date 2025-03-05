1. Клонируем проект
```bash
git clone git@github.com:Rasskar/admin-panel.git
```
2. Переходим в папку с проектом
```bash
cd admin-panel/
```
3. Устанавливаем права доступа на файл sail
```bash
chmod 777 -R ./sail
```
4. Копируем .env.example в .env
```bash
cp .env.example .env
```
5. Запускаем docker контейнеры 
```bash
./sail up -d
```
6. Устанавливает зависимости проекта, указанные в composer.lock
```bash
./sail composer install
```
7. Генерируем ключ проекта
```bash
./sail artisan key:generate
```
8. Запускаем миграции
```bash
./sail artisan migrate
```
9. Запускаем сидеры
```bash
./sail artisan db:seed
```
10. Устанавливает зависимости проекта, указанные в package.json
```bash
./sail npm install
```
11. Собираем фронтенд проекта
```bash
./sail npm run build
```

http://localhost/

http://localhost:8025/












