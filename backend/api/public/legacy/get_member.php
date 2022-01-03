<?php
/*
 * This file is part of Satushem.
 *
 * Copyright (C) 2019 - Andrey Sokolov
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 */
include('headers.php');
include('connect.php');
$stmt = $db->prepare("SELECT id, login, contacts, visible_name
					  FROM member
					  WHERE id = ?");
$stmt->execute(array($_GET['id']));
if( $row = $stmt->fetch() ) {
	echo json_encode(
		array('meta' => array('code' => 200, 'success' => true, 'message' => 'User successfully founded')
			, 'data' => array('user' => array('isSeller' => false, 'id' => $row['id'], 'login' => $row['login'], 'visible_name' => $row['visible_name'], 'email' => $row['contacts'], 'phone' => '', 'card' => array(), 'picture' => 'https://gravatar.com/avatar/a52798efc2f6daae3ff94f007f574f2c?s200&d=retro')))
	);
} else {
	echo json_encode(
		array('meta' => array('code' => 200, 'success' => false, 'message' => 'No users with such name')
			, 'data' => null)
	);
}
?>
