# Booking API

## Requirements:
- Postman (https://www.postman.com/downloads/)

## Project Set Up:

### Clone the project

    git clone git@github.com:unsta/labforty_task_api.git

### Create an `.env` file from `.env.example`

### From the project directory run

    composer install

### To start the Docker containers in the background run

    ./vendor/bin/sail up -d

Note: Make sure that all the containers are started successfully and there are no port conflicts!

### To generate an APP_KEY run

    ./vendor/bin/sail artisan key:generate

### Run the migrations

    ./vendor/bin/sail artisan migrate

### Run the seeders

    ./vendor/bin/sail artisan db:seed

### Run code quality checks (Check the `app/Makefile`)

    make pipeline

### Run the Feature tests (Docker provides a testing db)

    make test-feature

# Rest APIs

The REST APIs to the LabForty home task are described below.

Roles are implemented so that we have a better overview and control of the system.

Currently, we have two users:
- john.doe@labforty.com | password | Role: User
- jane.doe@labforty.com | password456 | Role: User
- bob.bobber@labforty.com | password123 | Role: Admin

Note: The `role:user` can list/update/view/delete own bookings!

Note: The `role:admin` can only list and view the bookings! (list with extended filters) 

Note: Assuming you are accessing the application via `localhost`.

## #Login: Only authenticated users can access the APIs

### Request

`POST /api/v1/login`

```bash
curl --location --request POST 'localhost/api/v1/login' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "john.doe@labforty.com",
    "password": "password"
}'
```

### Response

`HTTP 200 OK`

```json
{
    "status": "success",
    "message": "User logged in successfully",
    "token": "2|twb1Ei84t3dQ1qXxwinQKGDH85zcxaFepnsIZLKW3d8787f9"
}
```

Note: the TOKEN is needed for the rest of the requests!

## #Create a new booking

### Request

`POST /api/v1/store-booking-hour`

```bash
curl --location --request POST 'localhost/api/v1/store-booking-hour' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 2|twb1Ei84t3dQ1qXxwinQKGDH85zcxaFepnsIZLKW3d8787f9' \
--data-raw '{
    "booking_date": "2025-06-22",
    "time_slot_id": 2,
    "egn": "3208080983",
    "notification_types": 3
}'
```

### Response

`HTTP 201 Created`

```json
{
    "status": "success",
    "message": "Booking Hour was successfully created!"
}
```

## #Get list of Bookings

### Request

`GET /api/v1/list-booking-hours`

```bash
curl --location --request GET 'localhost/api/v1/list-booking-hours' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 2|twb1Ei84t3dQ1qXxwinQKGDH85zcxaFepnsIZLKW3d8787f9'
```

### Response

`HTTP 200 OK`

```json
{
    "data": [
        {
            "booking_date": "2025-06-02",
            "description": null,
            "notification_types": [
                {
                    "value": 2,
                    "label": "SMS"
                }
            ],
            "status": "confirmed",
            "time_slot": {
                "time": "10:00",
                "is_active": true
            },
            "user": {
                "name": "John Doe",
                "personal_data": {
                    "egn": "eyJpdiI6Ik1iV0V2VWdvQ2ptKzYzR29pT1dTWnc9PSIsInZhbHVlIjoiUHlaU3M5M0JuYTVkVHdIWlpvVGZYUT09IiwibWFjIjoiMWM1MTliMWMwYmZkNzgwOTI1N2NiYTIzMTg4MTAzNzVlYzQzOTJmOGUyNzg5NmQ2Njk3NzUzOWEwYWZkYjdhZiIsInRhZyI6IiJ9"
                }
            }
        },
        {
            "booking_date": "2025-05-31",
            "description": null,
            "notification_types": [
                {
                    "value": 1,
                    "label": "Email"
                }
            ],
            "status": "confirmed",
            "time_slot": {
                "time": "11:30",
                "is_active": true
            },
            "user": {
                "name": "Bob Bobber",
                "personal_data": {
                    "egn": "eyJpdiI6Ilc3L3QyaDJQd2Q0a2ZidHZPWUdwTmc9PSIsInZhbHVlIjoibG5CVU5tZEFOVTNpRVRidVlpOGhBUT09IiwibWFjIjoiMTJjYTNmNzU5OWI3NWJjNTUwZDQ3ZTFhZGRiN2E4ZWNkZmQzNDA2NjQ1MWZmOGY1ZjAwNWU1NDVhOTAwYzg3MiIsInRhZyI6IiJ9"
                }
            }
        },
        {
            "booking_date": "2025-06-22",
            "description": null,
            "notification_types": [
                {
                    "value": 1,
                    "label": "Email"
                },
                {
                    "value": 2,
                    "label": "SMS"
                }
            ],
            "status": "confirmed",
            "time_slot": {
                "time": "13:30",
                "is_active": true
            },
            "user": {
                "name": "John Doe",
                "personal_data": {
                    "egn": "eyJpdiI6Ik1iV0V2VWdvQ2ptKzYzR29pT1dTWnc9PSIsInZhbHVlIjoiUHlaU3M5M0JuYTVkVHdIWlpvVGZYUT09IiwibWFjIjoiMWM1MTliMWMwYmZkNzgwOTI1N2NiYTIzMTg4MTAzNzVlYzQzOTJmOGUyNzg5NmQ2Njk3NzUzOWEwYWZkYjdhZiIsInRhZyI6IiJ9"
                }
            }
        }
    ],
    "links": {
        "first": "http://localhost/api/v1/list-booking-hours?page=1",
        "last": "http://localhost/api/v1/list-booking-hours?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/list-booking-hours?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost/api/v1/list-booking-hours",
        "per_page": 15,
        "to": 3,
        "total": 3
    }
}
```

## #Show Booking Hour

### Request

`GET /api/v1/show-booking-hour/{id}`

```bash
curl --location --request GET 'localhost/api/v1/show-booking-hour/{id}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 1|dDWeNPvfCyoIlM6lExjzlLqeThohewkGcvhWQIo0a0257485'
```

### Response

`HTTP 200 OK`

```json
{
    "data": {
        "booking_date": "2025-06-02",
        "description": null,
        "notification_types": [
            {
                "value": 2,
                "label": "SMS"
            }
        ],
        "status": "confirmed",
        "time_slot": {
            "time": "10:00",
            "is_active": true
        },
        "user": {
            "name": "John Doe",
            "personal_data": {
                "egn": "eyJpdiI6Ik1iV0V2VWdvQ2ptKzYzR29pT1dTWnc9PSIsInZhbHVlIjoiUHlaU3M5M0JuYTVkVHdIWlpvVGZYUT09IiwibWFjIjoiMWM1MTliMWMwYmZkNzgwOTI1N2NiYTIzMTg4MTAzNzVlYzQzOTJmOGUyNzg5NmQ2Njk3NzUzOWEwYWZkYjdhZiIsInRhZyI6IiJ9"
            }
        }
    },
    "upcoming_bookings": []
}
```


## #Edit Booking Hour

`PATCH /api/v1/update-booking-hour/{id}}`

```bash
curl --location --request PATCH 'localhost/api/v1/update-booking-hour/{id}}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 1|dDWeNPvfCyoIlM6lExjzlLqeThohewkGcvhWQIo0a0257485' \
--data-raw '{
    "booking_date": "2025-06-22",
    "time_slot_id": 1,
    "notification_types": 3
}'
```

### Response

`HTTP 200 OK`

```json
{
    "data": {
        "booking_date": "2025-06-22",
        "description": null,
        "notification_types": [
            {
                "value": 1,
                "label": "Email"
            },
            {
                "value": 2,
                "label": "SMS"
            }
        ],
        "status": "confirmed"
    }
}
```
## #Delete Booking Hour

### Request

`DELETE /api/v1/destroy-booking-hour/2`

```bash
curl --location --request DELETE 'localhost/api/v1/destroy-booking-hour/{id}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer 1|dDWeNPvfCyoIlM6lExjzlLqeThohewkGcvhWQIo0a0257485'
```

### Response

`HTTP 200 OK`

```json
{
    "message": "Booking hour soft-deleted successfully."
}
```

Note: A soft-delete is done and the status is changed to `canceled`!

# Future Ideas/Improvements
- `laminas/laminas-hydrator`
- `Laravel Queues`
- `Caching`
- `V2 of the APIs`
- `DDD`
- `More roles & permissions`
- `Cron/Worker to mark past bookings as completed`
