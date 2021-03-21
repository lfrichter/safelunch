# Api Authentication

---

- [Api Authentication](#api-authentication)
  - [Header](#header)
  - [Register](#register)
    - [Params](#params)
    - [Success Response](#success-response)
    - [Error Response](#error-response)
      - [422 Unprocessable Entity](#422-unprocessable-entity)
  - [Login](#login)
    - [Params](#params-1)
    - [Success Response](#success-response-1)
    - [Error Response](#error-response-1)
      - [422 Unprocessable Entity](#422-unprocessable-entity-1)
      - [401 Unauthorized](#401-unauthorized)
  

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
