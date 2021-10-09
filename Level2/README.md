**Level2 - uses Docker for up Apache2 + MySQL(5.7) + PHP7.4 + PhpMyAdmin(127.0.0.1:8080) host need (test.local)**

install Docker and Composer - https://www.magemodule.com/all-things-magento/magento-2-tutorials/docker-magento-2-development/

**run Docker command (uses in directory the docker-compose.yml):**
- Spin Up 
  - _docker-compose up -d --build_
- Tear Down 
  - _docker-compose down_
- Connect to web container CLI 
  - _docker exec -it web bash_
    - root directory "cd app"
- Connect to database container CLI 
  - _docker exec -it mysql bash_
 
