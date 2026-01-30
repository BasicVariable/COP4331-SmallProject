# API Documentation

---
## API Error Responses
All API errors will be returned in this JSON format with their respective error codes:
```json
{ "error": "" }
```
---
## /Register
**Description:** Registers user with required info, then passes a cookie with the set-cookie header if successful.

**Request Body:**

```json
{
  "username": "",
  "password": "",
  "email": "",
  "firstName": "",
  "lastName": ""
}
```

**Response Body:**
```json
{}
```

**Response Codes:**
- **401:** Incorrect format for username or password.
- **500:** Unknown server error.


---
## /api/add
**Description:** Add a contact. Requires authentication cookie.

**Request Body:**

```json
{
  "firstName": "",
  "lastName": "",
  "email": "",
  "phone": "",
  "dateCreated": ""
}
```

**Response Body:**
```json
{}
```

**Response Codes:**
- **403:** Invalid session 
- **500:** Unknown server error