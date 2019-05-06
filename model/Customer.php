<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author meriam.bediss
 */
class Customer extends config {

    // select all data from the database

    public function select() {

        $sql = "SELECT * from customer";

        $result = $this->connect()->query($sql);

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function insert($fields) {

        // insert into customer (name, lastname, city) values (:name, :city, :designation);

        $implodeColumns = implode(', ', array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO customer ($implodeColumns) VALUES (:" . $implodePlaceholder . ")";

        $stmt = $this->connect()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmtExec = $stmt->execute();
        if ($stmtExec) {

            header('Location: index.php');
        }
    }

    public function selectOne($id) {

        $sql = "SELECT * FROM customer WHERE id = :id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":id",$id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($fields, $id) {

        //$sql = "UPDATE customer SET name=:name, lasname=:lastname, city=:city";

        $st = "";
        $counter = 1;
        $total_fields = count($fields);

        foreach ($fields as $key => $value) {
            if ($counter === $total_fields) {
                $set = "$key = :".$key;
                $st = $st.$set;
            } else {
                $set = "$key = :".$key.", ";
                $st = $st.$set;
                $counter++;
            }
        }

        $sql = "";
        $sql .= "UPDATE customer SET ".$st;
        $sql .= " WHERE id = ".$id;
        $stmt = $this->connect()->prepare($sql);
        
        foreach ($fields as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
            //var_dump($stmt);
        }
        
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            header('Location:index.php');
        }
        
    }
    
    public function destroy($id){
        
        $sql ="DELETE FROM customer where id= :id";
        
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindValue(":id", $id);
        
        $stmt->execute();
        
    }

}
