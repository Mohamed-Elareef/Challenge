
# Short URL API

This application is a simple API built with Laravel to create short URLs and to validate strings. You can use this application to create short links for use in web applications or any scenario where you need to use short URLs.

## How to Use

### Create Short URL

You can use the API to create a short URL using the POST method to the `/api/v1/short-urls` endpoint. You must pass the `url` parameter containing the original link you want to shorten.

#### Example Request

```http
POST /api/v1/short-urls
Content-Type: application/json

{
    "url": "https://example.com/very/long/url/to/shorten"
}
```

#### Expected Response
```
{
    "short_url": "https://short.url/abc123"
}

```


Validate String

You can also use the API to validate a string and check if it contains balanced parentheses. You can use the POST method to the /check-string endpoint. You must pass the string parameter containing the string you want to validate.



Example Request
```
POST /check-string
Content-Type: application/json

{
    "string": "((()))"
}
```


Expected Response
```
{
    "isValid": true
}
```






# run auto test
```
php artisan  test
```
