FROM node:8.11.3-alpine

RUN mkdir -p /app

WORKDIR /app

COPY frontend/*.json ./
COPY frontend/src/ ./src/

RUN npm install &&\
    npm install -g @angular/cli #&&\
    #/usr/local/bin/ng  build --prod \

#CMD [ "npm", "start" ]