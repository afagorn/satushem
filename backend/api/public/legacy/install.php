<?php
include('connect.php');

$stmt = $db->prepare("INSERT INTO category(name) values('Молоко');");
#$stmt = $db->prepare("insert into member(login, password, visible_name) values ('user1', '1', 'Первый пользователь');");

if(!$stmt->execute()) {
    exit("mysql error");
}

echo "Success install";