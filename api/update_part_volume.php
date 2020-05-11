<?php
/*
 * This file is part of Satushem.
 *
 * Copyright (C) 2020 - Andrey Sokolov
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
include('select_jp.php');

$stmt = $db->prepare("UPDATE purchase_event 
                      SET amount = ?
                      WHERE purchase_id = ? AND member_id = ? AND event_id in (1, 2)");

if( $stmt->execute(array($_GET['new_volume'], $_GET['purchase_id'], $_GET['participant_id'])) ) {
	$jp = select_jp($db, $_GET['purchase_id']);
	echo json_encode(
		array('meta' => array('code' => 200, 'success' => true, 'message' => 'PURCHASE UPDATED')
			, 'data' => array('purchase' => $jp))
	);
} else {
	$errInfo = $stmt->errorInfo();
	http_response_code(500);
	echo json_encode(
		array('meta' => array('code' => 500, 'success' => false, 'message' => 'Ошибка при обновлении закупки'. implode($errInfo, ','))
			, 'data' => null)
	);
}
?>
