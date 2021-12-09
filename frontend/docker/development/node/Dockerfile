FROM node:8.11.3-alpine

RUN mkdir -p /app
#RUN mkdir -p /app/src

WORKDIR /app

COPY app/*.json ./

RUN npm install &&\
    npm install -g @angular/cli #&&\
    #/usr/local/bin/ng  build --prod \

#CMD [ "npm", "start" ]