Instructions

Clone the repository
cd ./path/to/your/folder
Once you're in the folder, open the terminal where the project is located and then run "docker-compose up --build -d"
Setup the ./users service and ./notifications service

run the docker ps in the terminal
docker exec -it "container_id" /bin/bash (for windows)
once you're in the container, run the following: A. composer install --verbose --ignore-platform-reqs B. cp .env.example .env C. php artisan key:generate D. php artisan config:clear
Perform the following to test the ./users

Open postman and copy the following: 
```
URL: "http://localhost:8081/api/users" 
Body: { "email": "aaaaaa@gmail.com.ph", "first_name": "abcdit", "last_name": "1111Oh yeah" }
```
PS: make sure the request type is POST

and the execute send

to check the Queueing in the RABBITMQ open this url " http://localhost:15672/#/ " username/password: guest / guest

Perform the ./notifications testing in pulling the queued datas

docker ps
docker exec -it "container_id_of_notifications_app" /bin/bash
php artisan mq:consume (assuming that you already followed the previous instruction on setting up the ./notifications project)
