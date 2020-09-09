# 2THPlatform
base url:
http://localhost/2THPlatform

# Database

company / reports 

id - autoincrement
mac - varchar(12)
lat - int
lon - int
date - date
name - varchar(64)
tag - varchar(32)
groups - varchar(128)

# .env
```
$key_map = 'google_maps_api_key';
$companies = [
	"Company_1" => [
		"api_connector_password" => "apiPassword",
		"api_admin_password" => "platPassword",
		"db_password" => "TestDb",
		],
	"Company_2" => [
		"api_connector_password" => "password2",
		"api_admin_password" => "tpaswwordCompan",
		"db_password" => "DATAcompany2",
		],
	"TestCompany" => [
		"api_connector_password" => "Api.password2",
		"api_admin_password" => "TPword2",
		"db_password" => "TestDatabasePass",
		]
];
```
