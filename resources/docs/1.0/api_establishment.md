# Api Establishment

---

- [Api Establishment](#api-establishment)
  - [Index](#index)
    - [Success Response](#success-response)
    - [Error Response](#error-response)
      - [Missing paramenter](#missing-paramenter)
      - [401 Unauthorized](#401-unauthorized)
  - [Show](#show)
    - [Success Response](#success-response-1)
    - [Error Responses](#error-responses)
      - [Entity not found](#entity-not-found)
      - [401 Unauthorized](#401-unauthorized-1)
  - [Store](#store)
    - [Params](#params)
    - [Success Response](#success-response-2)
    - [Error Responses](#error-responses-1)
      - [422 Unprocessable Entity](#422-unprocessable-entity)
      - [401 Unauthorized](#401-unauthorized-2)
  - [Update](#update)
    - [Params](#params-1)
    - [Success Response](#success-response-3)
    - [Error Responses](#error-responses-2)
      - [422 Unprocessable Entity](#422-unprocessable-entity-1)
      - [401 Unauthorized](#401-unauthorized-3)
  - [Delete](#delete)
    - [Success Response](#success-response-4)
      - [User with role `admin`](#user-with-role-admin)
      - [User with role `developer`](#user-with-role-developer)
      - [Sample e-mail notification](#sample-e-mail-notification)
    - [Error Responses](#error-responses-3)
      - [Entity not found](#entity-not-found-1)
      - [401 Unauthorized](#401-unauthorized-4)
  

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

