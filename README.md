# 2THPlatform

base url:
http://localhost/2THPlatform

classes:
http://localhost/2THPlatform/api/v1/report/

methods:
http://localhost/2THPlatform/api/v1/report/send/
http://localhost/2THPlatform/api/v1/report/get/
http://localhost/2THPlatform/api/v1/report/update/

# sending data to API 

MAC:1116144D4DFB
_
LAT:-21.0059731
_
LON:26.77222188

http://localhost/2THPlatform/api/v1/report/send/?mac=1116144D4DFB&lat=-21.0059731&lon=26.77222188

# database

company / reports 

id - autoincrement
mac - varchar(12)
lat - int
lon - int
date - date
name - varchar(64)
tag - varchar(32)
groups - varchar(128)