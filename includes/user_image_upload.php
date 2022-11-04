<?php
if (isset($_FILES['user_image']['name']) AND !empty($_FILES['user_image']['name'])) {
         
         
         $img_name = $_FILES['user_image']['name'];
         $tmp_name = $_FILES['user_image']['tmp_name'];
         $error = $_FILES['user_image']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);
     
            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
     
               $new_img_name = uniqid($full_name, true).'.'.$img_ex_to_lc;
               $img_upload_path = "../img/users/".$new_img_name;
               move_uploaded_file($tmp_name, $img_upload_path);
               //GET user id
               $sql_1="SELECT * FROM users ORDER BY id DESC LIMIT 1";
               $result_1=mysqli_query($conn,$sql_1);
               $user=mysqli_fetch_assoc($result_1);
               $user_id=$user['id'];
               $sql = "UPDATE users SET profile_img = '$new_img_name' where id=$user_id";
               $result = mysqli_query($conn, $sql);
               if (!$result) {
                  $response = array("success" => false, "message" => "Something went wrong!");
                  echo json_encode($response);
                  return;
               }
    }
    }
}