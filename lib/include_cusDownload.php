<?php

//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class cusDownloadMethod extends method
{
    public function getId($where)
    {
        $id = $where[ 'id' ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " id,login_id ";
        $sql .= " FROM ";
        $sql .= " t_user ";
        $sql .= " WHERE ";
        $sql .= " id=".$id;

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        return $list;
    }

    public function getFileData($where)
    {
        $partner_id = $where[ 'partner_id' ];
        $dir_id     = $where[ 'dir_id'     ];
        $name       = $where[ 'filename'   ];
        $order      = $where[ 'order'      ];
        $basetype   = $where[ 'basetype'      ];

        $two       = date("Y-m-d H:i:s", strtotime("-2 week"));
        $sql = "";
        $sql = "SELECT ";
        $sql .= " * ";
        $sql .= " FROM ";
        $sql .= " uploadfile ";
        $sql .= " WHERE ";
        $sql .= " dir_id='".$dir_id."' AND ";
        $sql .= " partner_id=".$partner_id." AND ";
        if ($basetype != 1) {
            $sql .= " regist_date > '".$two."' AND ";
        }
        if ($name) {
            $sql .= " filename LIKE '%".$name."%' AND ";
        }
        $sql .= " 1=1 ";
        if ($order) {
            $sql .= " ORDER BY regist_date ASC ";
        } else {
            $sql .= " ORDER BY regist_date DESC ";
        }
        /*
                $r = mysql_query($sql );
                $i=0;
                while($rlt = mysql_fetch_assoc($r)){
                    $list[$i] = $rlt;
                    $i++;
                }
        */
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $list = array();
        while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[$i] = $rlt;
            $i++;
        }

        return $list;
    }

    public function getFileName($where)
    {
        $partner_id = $where[ 'partner_id' ];
        $dir_id     = $where[ 'dir_id'     ];
        $id         = $where[ 'id'         ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " filename ";
        $sql .= " FROM ";
        $sql .= " uploadfile ";
        $sql .= " WHERE ";
        $sql .= " id=".$id." AND ";
        $sql .= " partner_id=".$partner_id." AND ";
        $sql .= " dir_id='".$dir_id."'  ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[$i] = $rlt;
            $i++;
        }
        return $list;
    }

    public function editStatus($where)
    {
        $partner_id = $where[ 'partner_id' ];
        $dir_id     = $where[ 'dir_id'     ];
        $id         = $where[ 'id'         ];

        $sql = "";
        $sql = " UPDATE ";
        $sql .= " uploadfile ";
        $sql .= " SET ";
        $sql .= " status = 1 ";
        $sql .= " WHERE ";
        $sql .= " id=".$id." AND ";
        $sql .= " partner_id=".$partner_id." AND ";
        $sql .= " dir_id='".$dir_id."' ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
}
