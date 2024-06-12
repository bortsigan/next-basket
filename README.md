## Instructions

### Clone the repository
1. cd ./path/to/your/folder
2. git clone https://github.com/bortsigan/next-basket.git
3. Once you're in the folder, open the terminal where the project is located and then run "docker-compose up --build -d"
4. Setup the ./users service and ./notifications service

5. run the docker ps in the terminal
6. docker exec -it "container_id" /bin/bash (for windows)
7. once you're in the container, run the following: A. composer install --verbose --ignore-platform-reqs B. cp .env.example .env C. php artisan key:generate D. php artisan config:clear

### Perform the following to test the ./users

1. Open postman and copy the following: 
```
URL: "http://localhost:8081/api/users" 
Body: { "email": "johndoe@gmail.com.ph", "first_name": "John", "last_name": "Doe" }
```
#### PS: make sure the request type is POST

and the click send button

### to check the Queueing in the RABBITMQ open this 
```
url " http://localhost:15672/#/ " 
username: guest
pw: guest
```

### Perform the ./notifications testing in pulling the queued datas

1. docker ps
2. docker exec -it "container_id_of_notifications_app" /bin/bash
3. php artisan mq:consume 
```
(assuming that you already followed the previous instruction on setting up the ./notifications project)
```
