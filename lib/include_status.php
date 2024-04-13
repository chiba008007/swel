<?php

class statusMethod extends method
{
    public function get($where)
    {
        $sql = "
					SELECT
						number as list_num,
						exam_id as exam_id,
						GROUP_CONCAT(DISTINCT type ORDER BY type SEPARATOR ',') as list_type,
						GROUP_CONCAT( exam_state ORDER BY type SEPARATOR ','  ) as list_exam_state
						FROM
							t_testpaper
						WHERE 
							testgrp_id=:testgrp_id
						GROUP BY number
					";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':testgrp_id', $where[ 'testgrp_id' ], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        // exit();
        return $result;
    }
    public function getTestdata($where)
    {
        $sql = "SELECT * FROM t_test WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $where[ 'testgrp_id' ], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
