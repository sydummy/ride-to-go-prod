## About
Car Rental API

## API's

**POST Register Admin User**
```
/api/v1/a/register/
```
**Usage**\
HEADERS\
`Acceptapplication/json`\
`Content-Typeapplication/json`
```
{
	"f_name":"First",
	"m_name":"Mid",
	"l_name":"Last",
	"age":"22",
	"birthdate":"1999-05-31",
	"email":"admin@gmail.com",	
	"password":"secret!!!1999!!!",
	"password_confirmation":"secret!!!1999!!!"
}
```
