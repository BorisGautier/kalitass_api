# Kalitass-Api

New Services Laravel for project Medulink

## Installation

```sh
$ git clone https://github.com/BorisGautier/kalitass_api.git
$ cd services
$ cp .env.example .env
```

-   edit & add DB & Email infos in .env

```
DB_DATABASE=database name
DB_USERNAME=database username
DB_PASSWORD=database password

```

-   edit & add Docker config in .env

```
APP_PORT=
APP_PORT_HTTPS=
FORWARD_DB_PORT=
PG_PASSWORD=
```

```
$ docker-compose up -d
$ docker exec -it kalitass-api bash
$ composer install
```

```
$ php artisan key:generate
$ php artisan migrate
$ php artisan storage:link
$ php artisan scribe:generate
$ exit
```

-   Add authorization in docker

```
go to kalitass-api folder
$ chown -R www-data:www-data *
```

## Documentation

### Allowed verbs

`GET`, `POST`, `PUT`, `PATCH` ou `DELETE`

### Required in the header of all requests

```
Content-Type: application/json
Accept: application/json
```

-   Documentation Link : https://projectUrl/docs
