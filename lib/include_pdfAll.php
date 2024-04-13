<?PHP
class pdfAll extends method{
    public function getUserData(){
        $sql = "SELECT 
                id
                ,name
                FROM
                    t_user
                WHERE
                  type=?  
                ";
        $sth = $this->db->prepare($sql);
        $param = [];
        $param[] = 2;
        $sth->execute($param);
        $data = $sth->fetchAll();
        return $data;
    }
    public function getPartner(){
        $sql = "SELECT 
                id
                ,name
                FROM
                    t_user
                WHERE
                  partner_id=?  
                ";
        $sth = $this->db->prepare($sql);
        $param = [];
        $param[] = $_REQUEST[ 'tid' ];
        $sth->execute($param);
        $data = $sth->fetchAll();
        return $data;
    }
    public function getTestData(){
        $sql = "SELECT 
                id
                ,name
                FROM
                    t_test
                WHERE
                    partner_id=? AND 
                    customer_id=? AND
                    test_id=0 
                    ORDER BY registtime DESC
                ";
        $sth = $this->db->prepare($sql);
        $param = [];
        $param[] = $_REQUEST[ 'tid' ];
        $param[] = $_REQUEST[ 'pid' ];
        $sth->execute($param);
        $data = $sth->fetchAll();
        return $data;
    }
}
?>
