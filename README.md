# Movie Task - Schedule Movie Seeder using Laravel

<p align="center">
<img src="task.png" alt="Build Status">
</p>

Simple Schedule to seed most popular movies from  [https://www.themoviedb.org/](https://www.themoviedb.org/)

# Installation
1. Make sure that docker is installed on your machine
2. copy the contents of `.env.example` into ```.env``` 
3. Run the following command to build the docker container: ```docker-compose build ```
4. After the build finishes run the following command to  run the container:  ```  docker-compose up ```
5. When the container is running ,Open a new terminal and run the following command to     to access container :
    ```bash 
    docker exec -it seeder-app bash -c "sudo -u devuser /bin/bash" 
    ```
6. Run ```php artisan migrate:fresh --seed``` to create database table and seed the movie genres.
7. Run ```php artisan short-schedule:run ``` to start the schedule. 
8. Import the file `` Movie_task.postman_collection `` in postman.

## Endpoints

1. Just one end point ``` http://localhost:8000/api/movies ```
2. You can filter by Category_id if added as a paramater to the url.
3. You can sort by rate&popular whether asc or desc.
