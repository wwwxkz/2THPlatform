# 2THPlatform
base url:
http://localhost/2THPlatform

# Database

company / reports 

id - autoincrement
mac - varchar(12)
lat - float
lon - float
date - date
name - varchar(64)
tag - varchar(32)
groups - varchar(128)

# .env
```
$key_map = 'google_maps_api_key';
```

# companies.txt
```
{
  "companies": {
    "Company1": {
      "api_connector_password": "apipass",
      "api_admin_password": "platformOne",
      "db_password": "Dbp4ss",
      "theme": "dark"
    },
    "Company2": {
      "api_connector_password": "Api.password2",
      "api_admin_password": "platformPassword",
      "db_password": "TestDatabasePassword",
      "theme": "light"
    }
  }
}
```