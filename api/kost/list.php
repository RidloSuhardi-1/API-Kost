<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$name = isset($_GET['kost_name']) ? $_GET['kost_name'] : '';

$sql_limit = '';
if (!empty($limit)) {
    $sql_limit = ' LIMIT 0,'.$limit;
}
$sql_query = '';
if (!empty($name)) {
    $sql_query = ' where kost_name LIKE \'%'.$name.'%\' ';
}

if (!empty($id)) {
    $sql_query = ' where kost_id = '.$id;
}

$cat_list = $db->query('select * from kost '.$sql_query.' '.$sql_limit);

$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cat_list);
$arr['result'] = $cat_list;

echo json_encode($arr);