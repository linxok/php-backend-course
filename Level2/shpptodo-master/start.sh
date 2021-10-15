#!/bin/bash
cd site1
docker-compose up -d --build
cd ..
cd site2
docker-compose up -d --build
cd ..
cd reverse-proxy
docker-compose up -d --build
