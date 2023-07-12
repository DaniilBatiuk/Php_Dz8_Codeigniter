<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $data["city"] = $db->query("SELECT * FROM Cities");
        $data["stars"] = $db->query("SELECT DISTINCT Stars FROM Hotels")->getResult("array");

        $selectedCity = $this->request->getGet("city");
        $selectedStars = $this->request->getGet("stars");
        
        if($selectedCity == "" && $selectedStars == ""){
            $data["hotel"] = $db->query("SELECT * FROM Hotels");
            return view('page1', $data);
        }
        if (!empty($selectedCity)) {
            if($selectedCity == ""){
                $data["hotel"] = $db->query("SELECT * FROM Hotels");
            }
            else{
                $data["hotel"] = $db->query("SELECT * FROM Hotels Where CityId = $selectedCity");
            }
        }
        if (!empty($selectedStars)) {
            if($selectedStars == ""){
                $data["hotel"] = $db->query("SELECT * FROM Hotels");
            }
            else{
                $data["hotel"] = $db->query("SELECT * FROM Hotels Where Stars = $selectedStars");
            }
        }
        $data["selectedCity"] = $selectedCity;
        $data["selectedStars"] = $selectedStars;
        return view('page1', $data);
    }

    public function cities() {
        $db = db_connect();
        $res = $db->query("SELECT * FROM Cities");
        echo "<h2>Cities</h2>";
        echo "<table><tbody>";
        foreach($res->getResult("array") as $city){
            echo "<tr>";
            echo "<td>".$city["Id"]."</td>";
            echo "<td>$city[CountryId]</td>";
            echo "<td>$city[City]</td>";
            echo "<td><a href='/home/city?id=".$city["Id"]."'>Details</td>";
            echo "<td><a href='/home/info/".$city["Id"]."'>Info</td>";
        }
        echo "</tbody></table>";
    }
    
    public function city(){
        $id = $this->request->getGet("id");
        $db = db_connect();
        // $sq1 = "SELECT Ci.Id, Co.Country, Ci.City FROM Cities Ci 
        // JOIN Countries Co ON Ci.CountryId = Co.Id WHERE Ci.Id = ?";
        // $res = $db->query($sq1, array($id));
        $sq1 = "SELECT Ci.Id, Co.Country, Ci.City FROM Cities Ci 
         JOIN Countries Co ON Ci.CountryId = Co.Id WHERE Ci.Id = :cityid:";
        $res = $db->query($sq1, ["cityid"=>$id]);
        $row = $res->getFirstRow("array");
        return view("header"). view("city", $row).view("footer");
    }

    public function info($id){
        $db = db_connect();
        $sq1 = "SELECT Ci.Id, Co.Country, Ci.City FROM Cities Ci 
         JOIN Countries Co ON Ci.CountryId = Co.Id WHERE Ci.Id = :cityid:";
        $res = $db->query($sq1, ["cityid"=>$id]);
        $row = $res->getFirstRow("array");
        return view("header"). view("city", $row).view("footer");
    }
}
