FROM node:8.11.3-alpine

WORKDIR /app

COPY app/*.json ./

RUN npm install &&\
    npm install -g @angular/cli