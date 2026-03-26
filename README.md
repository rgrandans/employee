# Setup guide

## Prerequisites

1. Docker and docker compose must be installed on your machine.
2. Ports 8081, 5173 and 5434 must be available on your machine

## Steps to setup

1. Clone repository

```bash
https://github.com/rgrandans/employee.git
cd employee
```

2. Start docker containers

```bash
docker-compose up -d
```

3. Run doctrine migrations

```bash
docker-compose exec php-fpm php bin/console doctrine:migrations:migrate --no-interaction
```

## Access the application

Application is available on http://localhost:5173/employees

## Troubleshooting

If you are running on linux environment and getting error about permissions for ./var directory than need to set permissions

```bash
chmod 777 ./api/var/
```

This solution is acceptable only for development environment 