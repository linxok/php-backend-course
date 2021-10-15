#!/bin/bash
cd reverse-proxy
docker-compose  down
cd ..
cd site1
docker-compose  down
cd ..
cd site2
docker-compose  down 

