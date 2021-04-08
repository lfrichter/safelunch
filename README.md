# Safelunch
@(Richter Tecnologia)[webdev,laravel]

![Safelunch|right](https://i.imgur.com/mdkjvLk.jpg?1)

[![ubuntu](https://img.shields.io/badge/ubuntu-18.04.1-E95420.svg?logo=ubuntu&logoColor=white&style=for-the-badge)](https://www.ubuntu.com/)                                                                                                                                                                                                                               [![Composer](https://img.shields.io/badge/Composer-2.0.11-885630.svg?logo=composer&logoColor=white&style=for-the-badge)](https://getcomposer.org/)                                                                                                                                                                                                                                     [![git](https://img.shields.io/badge/Git-2.17.1-F05032.svg?logo=git&style=for-the-badge&logoColor=white)](https://git-scm.com/downloads)                                                                                                                                                                                                                                                                                                                                                                                                                                                                         [![php](https://img.shields.io/badge/php-7.4.16-777BB4.svg?logo=php&logoColor=white&style=for-the-badge)](http://php.net/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                   [ ![Laravel](https://img.shields.io/badge/Laravel-8.32.1-E74430.svg?logo=laravel&logoColor=white&style=for-the-badge)](https://laravel.com/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                          [![mySql](https://img.shields.io/badge/mysql-5.7.26-4479A1.svg?logo=mysql&logoColor=white&style=for-the-badge) ](https://www.mysql.com/)                                                                                                                                                                                                                                     [![nginx](https://img.shields.io/badge/nginx-1.14.0-269539.svg?logo=nginx&logoColor=white&style=for-the-badge)](http://nginx.org/) 
[![npm](https://img.shields.io/badge/NPM-7.6.3-CB3837.svg?logo=npm&style=for-the-badge&logoColor=white)](https://www.npmjs.com)                                                                                                                                                                                                                                                                                                                                  [![Node.js](https://img.shields.io/badge/Node-15.12.0-339933.svg?logo=node.js&style=for-the-badge&logoColor=white)](https://nodejs.org/en/)

Search for a safe meal across the UK, information based on the [FHRS](https:%20//ratings.food.gov.uk/) platform.

This application offers:
- a data import system
- a search page
- an API to query, create, modify and delete this data


## Instalation
- This application was developed using laradock with
	- PHP 7.4
	- Mysql 5.7
	- Mailhog
- After installing and configuring the database run the command to import `updateDatabase: fromApiFHRS`
- All documentation is available at url [/docs](http://localhost/docs)

## Search
After importing the entire database through the API, this simple filtering system will be available for all locations and regions in the United Kingdom.
![Serach page](https://i.imgur.com/JS8bwBj.png)

## Database
<a name="database"></a>


### Roles
<a name="roles"></a>
- `admin`
- `developer`

### FHRS data
<a name="fhrs-data"></a>
Both these tables have soft delete approach.
- `authorities`
- `establishments`

### User
<a name="user"></a>
- The default user administrator is:  `fernando.richter@gmail.com`  pass `12345678`
- Other users will be developers and their pass is `password` 

---
<a name="api-authentication"></a>
# API

<a name="header"></a>
## Header

- Default
	- `Accept`: `application/json`
- Authenticated
	- `Authorization`: `Bearer {Hash}`

<a name="register"></a>
## Register

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| POST      | `/register`                            |  default                      |

<a name="params"></a>
### Params
- `name`
- `email`
- `password`

<a name="success-response"></a>
### Success Response
```
{
  "access_token": "{Hash}",
  "token_type": "Bearer"
}
```

<a name="error-response"></a>
### Error Response
<a name="422-unprocessable-entity"></a>
#### 422 Unprocessable Entity
```
{
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ],
    "email": [
      "The email field is required."
    ],
    "password": [
      "The password field is required."
    ]
  }
}
```


---
<a name="login"></a>
## Login

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| POST      | `/login`                               |  default                      |

<a name="params-1"></a>
### Params

- `email`
- `password`

<a name="success-reponse-1"></a>
### Success Response

```
{
  "access_token": "{Hash}",
  "token_type": "Bearer"
}
```

<a name="error-reponse-1"></a>
### Error Response

<a name="422-unprocessable-entity-1"></a>
#### 422 Unprocessable Entity

```
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email field is required."
    ],
    "password": [
      "The password field is required."
    ]
  }
}
```
<a name="401-unauthorized"></a>
#### 401 Unauthorized
```
{
  "message": "Invalid login details"
}
```

---
<a name="api-authority"></a>
# Authority

<a name="index"></a>
## Index

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| GET       | `/authority`                           |  default, authenticated       |


<a name="success-reponse"></a>
### Success Response

```
{
  "authorities": [
    {
      "id": 1,
      "local_authority_id_code": "027",
      "name": "Cambridge City",
      "region_name": "East Counties",
      "created_at": "2021-03-14T19:06:21.000000Z",
      "updated_at": "2021-03-14T19:06:21.000000Z"
    },
    {
      "id": 2,
      "local_authority_id_code": "028",
      "name": "East Cambridgeshire",
      "region_name": "East Counties",
      "created_at": "2021-03-14T19:06:21.000000Z",
      "updated_at": "2021-03-14T19:06:21.000000Z"
    },
    {...},
   }
}    
  
```
<a name="error-reponse"></a>
### Error Response

<a name="401-unauthorized"></a>
#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="show"></a>
## Show

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| GET       | `/authority/{id}`                      |  default, authenticated       |

<a name="success-reponse-1"></a>
### Success Response

```
{
  "authority": {
    "id": 1,
    "local_authority_id_code": "027",
    "name": "Cambridge City",
    "region_name": "East Counties",
    "created_at": "2021-03-14T19:06:21.000000Z",
    "updated_at": "2021-03-14T19:06:21.000000Z"
  }
}
```
<a name="error-reponse-1"></a>
### Error Responses
#### Entity not found
```
{
  "message": "Entity does not exist."
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="store"></a>
## Store

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| POST      | `/authority/`                          |  default, authenticated       |

<a name="params"></a>
### Params
- `id`
- `name`
- `region_name`
- `local_authority_id_code` (optional)

<a name="success-reponse-2"></a>
### Success Response
```
{
  "message": "Authority successful created."
}
```

### Error Responses
#### 422 Unprocessable Entity
```
{
  "message": "The given data was invalid.",
  "errors": {
    "id": [
      "The id field is required."
    ],
    "name": [
      "The name field is required."
    ],
    "region_name": [
      "The region name field is required."
    ]
  }
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="update"></a>
## Update

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| PUT       | `/authority/`                          |  default, authenticated       |

### Params
- `id`
- `name`
- `region_name`
- `local_authority_id_code` (optional)

### Success Response
```
{
  "message": "Authority successful updated."
}
```

### Error Responses
#### 422 Unprocessable Entity
```
{
  "message": "The given data was invalid.",
  "errors": {
    "id": [
      "The id field is required."
    ],
    "name": [
      "The name field is required."
    ],
    "region_name": [
      "The region name field is required."
    ]
  }
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="delete"></a>
## Delete

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| DELETE    | `/authority/{id}`                      |  default, authenticated       |

### Success Response
#### User with role `admin`
```
{
  "message": "Authority successful deleted."
}
```
#### User with role `developer`
```
{
  "message": "Your notification for delete was sent to Administrator."
}
```
#### Sample e-mail notification
![delete_request|center](https://i.imgur.com/MYaAnEK.png)

### Error Responses
#### Entity not found
```
{
  "message": "Authority does not exist."
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```











---
<a name="api-establishment"></a>
# Establishment
<a name="index"></a>
## Index

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| GET       | `/establishments/{authority_id}`       |  default, authenticated       |


### Success Response

```
{
  "authorities": [
    {
      "id": 1,
      "local_authority_id_code": "027",
      "name": "Cambridge City",
      "region_name": "East Counties",
      "created_at": "2021-03-14T19:06:21.000000Z",
      "updated_at": "2021-03-14T19:06:21.000000Z"
    },
    {
      "id": 2,
      "local_authority_id_code": "028",
      "name": "East Cambridgeshire",
      "region_name": "East Counties",
      "created_at": "2021-03-14T19:06:21.000000Z",
      "updated_at": "2021-03-14T19:06:21.000000Z"
    },
    {...},
   }
}    
  
```

### Error Response
#### Missing paramenter
```
{
  "message": "The endpoint does not exist or a mandatory parameter is missing."
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="show"></a>
## Show

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| GET       | `/establishment/{id}`                  |  default, authenticated       |


### Success Response

```
{
  "establishment": {
    "id": 3,
    "authority_id": 15,
    "business_name": "Papa Teacher Delicious",
    "business_type": "Restaurant\/Cafe\/Canteen",
    "address_line_1": "34 John Kenedy",
    "address_line_2": null,
    "address_line_3": null,
    "postcode": "L1 WE2",
    "rating_value": "5",
    "created_at": "2021-03-20T09:59:44.000000Z",
    "updated_at": "2021-03-20T13:32:48.000000Z"
  }
}
```

### Error Responses
#### Entity not found
```
{
  "message": "Entity does not exist."
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="store"></a>
## Store

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| POST      | `/establishment/`                          |  default, authenticated       |

### Params
- `id`
- `authority_id`
- `business_name`
- `business_type`
- `address_line_1`
- `address_line_2` (optional)
- `address_line_3` (optional)
- `postcode`
- `rating_value`

### Success Response
```
{
  "message": "Establishment successful created."
}
```

### Error Responses
#### 422 Unprocessable Entity
```
{
  "message": "The given data was invalid.",
  "errors": {
    "id": [
      "The id field is required."
    ],
    "authority_id": [
      "The authority id field is required."
    ],
    "business_name": [
      "The business name field is required."
    ],
    "business_type": [
      "The business type field is required."
    ],
    "address_line_1": [
      "The address line 1 field is required."
    ],
    "postcode": [
      "The postcode field is required."
    ],
    "rating_value": [
      "The rating value field is required."
    ]
  }
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="update"></a>
## Update

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| PUT       | `/establishment/`                      |  default, authenticated       |

### Params
- `id`
- `authority_id`
- `business_name`
- `business_type`
- `address_line_1`
- `address_line_2` (optional)
- `address_line_3` (optional)
- `postcode`
- `rating_value`

### Success Response
```
{
  "message": "Establishment successful updated."
}
```

### Error Responses
#### 422 Unprocessable Entity
```
{
  "message": "The given data was invalid.",
  "errors": {
    "id": [
      "The id field is required."
    ],
    "authority_id": [
      "The authority id field is required."
    ],
    "business_name": [
      "The business name field is required."
    ],
    "business_type": [
      "The business type field is required."
    ],
    "address_line_1": [
      "The address line 1 field is required."
    ],
    "postcode": [
      "The postcode field is required."
    ],
    "rating_value": [
      "The rating value field is required."
    ]
  }
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
<a name="delete"></a>
## Delete

| Method    | URI                                    |  Headers                      |
| :-------- | :------------------------------------- | :---------------------------: |
| DELETE    | `/establishment/{id}`                  |  default, authenticated       |

### Success Response
#### User with role `admin`
```
{
  "message": "Establishment successful deleted."
}
```
#### User with role `developer`
```
{
  "message": "Your notification for delete was sent to Administrator."
}
```
#### Sample e-mail notification
![delete_request|center](https://i.imgur.com/5lVYKXe.png)

### Error Responses
#### Entity not found
```
{
  "message": "Establishment does not exist."
}
```

#### 401 Unauthorized
```
{
  "message": "Unauthenticated."
}
```

---
## License

The Safelunch is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

