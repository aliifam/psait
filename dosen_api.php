<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            get_by_id($id);
         }
         else
         {
            get_all();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            update($id);
         }
         else
         {
            insert();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            delete($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }



   function get_all()
   {
      global $mysqli;
      $query="SELECT * FROM dosen";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Dosen Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function get_by_id($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM dosen";
      if($id != 0)
      {
         $query.=" WHERE id=".$id." LIMIT 1";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get Dosen by Id Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   function insert()
      {
         global $mysqli;
         if(!empty($_POST["nama"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nama' => '','prodi' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
               $result = mysqli_query($mysqli, "INSERT INTO dosen SET
               nama = '$data[nama]',
               prodi = '$data[prodi]',
               gaji = '$data[gaji]'");                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Dosen Added Successfully.'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Dosen Addition Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update($id)
      {
         global $mysqli;
         if(!empty($_POST["nama"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nama' => '','prodi' => '', 'gaji' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE dosen SET
              nama = '$data[nama]',
              prodi = '$data[prodi]',
              gaji = '$data[gaji]'
              WHERE id='$id'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Dosen Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Dosen Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete($id)
   {
      global $mysqli;
      $query="DELETE FROM dosen WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Dosen Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Dosen Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

 
?> 
