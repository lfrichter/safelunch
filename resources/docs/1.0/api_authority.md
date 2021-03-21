# Api Authority

---

- [Api Authority](#api-authority)
  - [Index](#index)
    - [Success Response](#success-response)
    - [Error Response](#error-response)
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
