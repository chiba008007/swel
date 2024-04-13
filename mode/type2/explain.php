<?PHP
  
  if($_REQUEST[ 'flag' ]){
    $where = [];
    $where[ 'where' ][ 'id'  ] = $id;
    $where[ 'edit' ][ 'explain_page' ] = ($_REQUEST[ 'flag' ] )?0:1;
    $flg = $db->editUserData('t_user',$where);
    header("Location:/");
    exit();
  }

  $_SESSION[ 'explain' ] = "on";

$where = [];
$where[ 'id'  ] = $id;
$udata = $db->getUser($where);


