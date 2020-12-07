<?php
session_start();
require 'Dbconnect.php';

if (isset($_GET['id5'])) {
    $id = $_GET['id5'];
    $rideid = $_GET['rideid'];
    $user = new user();
    $dbcon = new Dbconnect();
    $user->canceluserride($id, $rideid, $dbcon->conn);
}

if (isset($_POST['update2'])) {
    $id = $_GET['id6'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $user = new user();
    $dbcon = new Dbconnect();
    $user->updateuser2($id, $name, $mobile, $dbcon->conn);
}

if (isset($_POST['update3'])) {
    $id = $_GET['id7'];
    $name = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];
    $user = new user();
    $dbcon = new Dbconnect();
    $user->updatepass($id, $name, $newpass, $conpass, $dbcon->conn);
}

class user
{
    public $username;
    public $password;
    public $confirmpassword;
    public $userid;
    public $name;
    public $date;
    public $mobile;
    public $isblock;
    public $isadmin;

    function Login($username, $password, $conn)
    {
        $error = array();

        if ($username == "" || $password == "") {
            $error[] = array("id" => 'form', 'msg' => "Field cant be empty");
        }

        $sql1 = "SELECT * FROM tbl_user WHERE user_name='".$username."'";
        $result = $conn->query($sql1);

        if ($result->num_rows == 0) {
            $error[] = array(
                "id" => 'form',
                'msg' => "Please register first no register user found"
            );
        }

        if (count($error) == 0) {
            $sql =
                "SELECT * FROM `tbl_user` WHERE `user_name`='" .
                $username .
                "'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //echo "<br>".$row['password'];

                    if (
                        $row['user_name'] == $username &&
                        $row['password'] == $password &&
                        $row['isblock'] == 1
                    ) {
                        if ($row['is_admin'] == 0) {
                            $_SESSION['userdata'] = array(
                                'userid' => $row['user_id'],
                                'username' => $row['user_name'],
                                'name' => $row['name']
                            );
                            header('Location:admin.php');
                        } elseif ($row['is_admin'] == 1) {
                            $_SESSION['userdata'] = array(
                                'userid' => $row['user_id'],
                                'username' => $row['user_name'],
                                'name' => $row['name']
                            );
                            if (!isset($_SESSION['book'])) {
                                header('Location:homeuser.php');
                            } elseif (isset($_SESSION['book'])) {
                                header('Location:bookride.php');
                            }
                        }
                    } elseif( $row['isblock'] == 0) {
                        echo "<script>alert('Please wait for admin to approve you');</script>";
                        unset($_SESSION['book']);
                    }
                    else{
                        echo "<script>alert('Username or Password doesnt match');</script>";
                        unset($_SESSION['book']);
                    }
                }
            }
        } else {
            foreach ($error as $err) {
                $display = $err['msg'];
            }

            if($display=="Field cant be empty")
            {
            echo '<script type="text/javascript">; 
            alert("Field cant be empty"); 
            window.location= "login2.php";
            </script>';
            }

            elseif($display=="Please register first no register user found")
            {
            echo '<script type="text/javascript">; 
            alert("Please register first no register user found"); 
            window.location= "login2.php";
            </script>';
            }

        }
    }

    function register(
        $username,
        $password,
        $name,
        $confirmpassword,
        $mobile,
        $date,
        $conn
    ) {
        $error = array();

        if (
            $username == "" ||
            $password == "" ||
            $confirmpassword == "" ||
            $name == "" ||
            $mobile == ""
        ) {
            $error[] = array("id" => 'form', 'msg' => "Field cant be empty");
        }

        if ($password != $confirmpassword) {
            $error[] = array(
                "id" => 'form',
                'msg' => "Password does not matches"
            );
        }

        $sql1 = "SELECT * FROM tbl_user WHERE user_name='".$username."'";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            $error[] = array(
                "id" => 'form',
                'msg' => "Username/Email already present"
            );
        }

        if (count($error) == 0) {
            setcookie("user", $username, time() + 60 * 60 * 24);

            $sql =
                "INSERT INTO tbl_user (user_name, name, dateofsignup, mobile, isblock, password, is_admin)
            VALUES ('" .
                $username .
                "','" .
                $name .
                "','" .
                $date .
                "','" .
                $mobile .
                "',0,'" .
                $password .
                "',1)";
            if ($conn->query($sql) === true) {
                echo '<script type="text/javascript">; 
                alert("Registration done successfully ,Please wait till admin approve you"); 
                window.location= "login2.php";
                </script>';
                }    
            
            else {
                echo '<script type="text/javascript">; 
                alert("Oops some error occur,please register agn"); 
                window.location= "registration2.php";
                </script>';
            }
        } else {
            foreach ($error as $err) {
                $display1 = $err['msg'];
              
            }
            if($display1=="Field cant be empty")
            {
            echo '<script type="text/javascript">; 
            alert("Field cant be empty"); 
            window.location= "registration2.php";
            </script>';
            }
            else if($display1=="Password does not matches")
            {
            echo '<script type="text/javascript">; 
            alert("Password does not matches"); 
            window.location= "registration2.php";
            </script>';
            }

            else if($display1=="Username/Email already present")
            {
            echo '<script type="text/javascript">; 
            alert("Username/Email already present"); 
            window.location= "registration2.php";
            </script>';
            }
        }
    }

    function book($pick, $drop, $cars, $weight, $date, $conn)
    {
        echo "Your cab type is " . $cars . "<br>";
        if ($drop == $pick || $pick == "0" || $drop == "10" || $cars == "20") {
            echo 'Location cant be Same or Field is empty';
        } else {
            if (isset($_SESSION['userdata'])) {
                $id = $_SESSION['userdata']['userid'];
                if (isset($_SESSION['book'])) {
                    $drop2 = $_SESSION['book']['to'];
                    $pick2 = $_SESSION['book']['from'];
                    $cars2 = $_SESSION['book']['cars'];
                    $weight2 = $_SESSION['book']['weight'];

                    $distance1 = 0;
                    $distance2 = 0;
                    $totalcost = 0;
                    date_default_timezone_set("Asia/Calcutta");

                    $sql =
                        "SELECT distance FROM tbl_location WHERE `name`='" .
                        $pick2 .
                        "'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $distance1 = $row['distance'];
                        }
                    }

                    $sql1 =
                        "SELECT distance FROM tbl_location WHERE `name`='" .
                        $drop2 .
                        "'";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $distance2 = $row1['distance'];
                        }
                    }

                    $totaldistance = abs($distance2 - $distance1);

                    if ($cars == "cedmicro") {
                        if ($totaldistance <= 10) {
                            $totalcost = 50 + $totaldistance * 13.5;
                        } elseif (
                            $totaldistance >= 10 &&
                            $totaldistance <= 60
                        ) {
                            $totalcost =
                                50 + 10 * 13.5 + ($totaldistance - 10) * 12;
                        } elseif (
                            $totaldistance >= 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost =
                                50 +
                                10 * 13.5 +
                                50 * 12 +
                                ($totaldistance - 60) * 10.2;
                        } elseif ($totaldistance >= 160) {
                            $totalcost =
                                50 +
                                10 * 13.5 +
                                50 * 12 +
                                100 * 10.2 +
                                ($totaldistance - 160) * 8.5;
                        }
                    } elseif ($cars == "cedmini") {
                        if ($totaldistance <= 10) {
                            $totalcost += 150 + $totaldistance * 14.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                150 + 10 * 14.5 + ($totaldistance - 10) * 13;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                150 +
                                10 * 14.5 +
                                50 * 13 +
                                ($totaldistance - 60) * 11.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                150 +
                                10 * 14.5 +
                                50 * 13 +
                                100 * 11.2 +
                                ($totaldistance - 160) * 9.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 50;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 100;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 200;
                        }
                    } elseif ($cars == "cedroyal") {
                        if ($totaldistance <= 10) {
                            $totalcost += 200 + $totaldistance * 15.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                200 + 10 * 15.5 + ($totaldistance - 10) * 14;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                200 +
                                10 * 15.5 +
                                50 * 14 +
                                ($totaldistance - 60) * 12.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                200 +
                                10 * 15.5 +
                                50 * 14 +
                                100 * 12.2 +
                                ($totaldistance - 160) * 10.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 50;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 100;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 200;
                        }
                    } elseif ($cars == "cedsuv") {
                        if ($totaldistance <= 10) {
                            $totalcost += 250 + $totaldistance * 16.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                250 + 10 * 16.5 + ($totaldistance - 10) * 15;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                250 +
                                10 * 16.5 +
                                50 * 15 +
                                ($totaldistance - 60) * 13.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                250 +
                                10 * 16.5 +
                                50 * 15 +
                                100 * 13.2 +
                                ($totaldistance - 160) * 11.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 100;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 200;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 400;
                        }
                    }

                  

                    $sql5 =
                        "INSERT INTO `tbl_ride`(`ride_date`, `from_distance`, `to_distance`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`,`car`)
    VALUES ('" .
                        $date .
                        "', '" .
                        $pick2 .
                        "', '" .
                        $drop2 .
                        "', '" .
                        $totaldistance .
                        "', '" .
                        $weight2 .
                        "', '" .
                        $totalcost .
                        "', 1,'" .
                        $id .
                        "','" .
                        $cars2 .
                        "')";

                    if ($conn->query($sql5) === true) {
                    }
                  
                    echo " Your Ride has been booked please wait for corfirmation. <br> Total fare is 	&#x20B9;" .
                        $totalcost .
                        "/-";
                    unset($_SESSION['book']);
                    unset($_SESSION['cost']);
                } else {
                    $distance1 = 0;
                    $distance2 = 0;
                    $totalcost = 0;
                    $sql =
                        "SELECT distance FROM tbl_location WHERE `name`='" .
                        $pick .
                        "'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $distance1 = $row['distance'];
                        }
                    }

                    $sql1 =
                        "SELECT distance FROM tbl_location WHERE `name`='" .
                        $drop .
                        "'";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $distance2 = $row1['distance'];
                        }
                    }

                    $totaldistance = abs($distance2 - $distance1);

                    if ($cars == "cedmicro") {
                        if ($totaldistance <= 10) {
                            $totalcost = 50 + $totaldistance * 13.5;
                        } elseif (
                            $totaldistance >= 10 &&
                            $totaldistance <= 60
                        ) {
                            $totalcost =
                                50 + 10 * 13.5 + ($totaldistance - 10) * 12;
                        } elseif (
                            $totaldistance >= 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost =
                                50 +
                                10 * 13.5 +
                                50 * 12 +
                                ($totaldistance - 60) * 10.2;
                        } elseif ($totaldistance >= 160) {
                            $totalcost =
                                50 +
                                10 * 13.5 +
                                50 * 12 +
                                100 * 10.2 +
                                ($totaldistance - 160) * 8.5;
                        }
                    } elseif ($cars == "cedmini") {
                        if ($totaldistance <= 10) {
                            $totalcost += 150 + $totaldistance * 14.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                150 + 10 * 14.5 + ($totaldistance - 10) * 13;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                150 +
                                10 * 14.5 +
                                50 * 13 +
                                ($totaldistance - 60) * 11.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                150 +
                                10 * 14.5 +
                                50 * 13 +
                                100 * 11.2 +
                                ($totaldistance - 160) * 9.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 50;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 100;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 200;
                        }
                    } elseif ($cars == "cedroyal") {
                        if ($totaldistance <= 10) {
                            $totalcost += 200 + $totaldistance * 15.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                200 + 10 * 15.5 + ($totaldistance - 10) * 14;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                200 +
                                10 * 15.5 +
                                50 * 14 +
                                ($totaldistance - 60) * 12.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                200 +
                                10 * 15.5 +
                                50 * 14 +
                                100 * 12.2 +
                                ($totaldistance - 160) * 10.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 50;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 100;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 200;
                        }
                    } elseif ($cars == "cedsuv") {
                        if ($totaldistance <= 10) {
                            $totalcost += 250 + $totaldistance * 16.5;
                        } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                            $totalcost +=
                                250 + 10 * 16.5 + ($totaldistance - 10) * 15;
                        } elseif (
                            $totaldistance > 60 &&
                            $totaldistance <= 160
                        ) {
                            $totalcost +=
                                250 +
                                10 * 16.5 +
                                50 * 15 +
                                ($totaldistance - 60) * 13.2;
                        } elseif ($totaldistance > 160) {
                            $totalcost +=
                                250 +
                                10 * 16.5 +
                                50 * 15 +
                                100 * 13.2 +
                                ($totaldistance - 160) * 11.5;
                        }

                        if ($weight >= 1 && $weight <= 10) {
                            $totalcost = $totalcost + 100;
                        }

                        if ($weight > 10 && $weight <= 20) {
                            $totalcost = $totalcost + 200;
                        }
                        if ($weight > 20) {
                            $totalcost = $totalcost + 400;
                        }
                    }

                   
                    echo "Total cost: 	&#x20B9;" . $totalcost . "/-";
                }
            } else {
                $drop2 = $_SESSION['book']['to'];
                $pick2 = $_SESSION['book']['from'];
                $cars2 = $_SESSION['book']['cars'];
                $weight2 = $_SESSION['book']['weight'];
                $distance1 = 0;
                $distance2 = 0;
                $totalcost = 0;
                $sql =
                    "SELECT distance FROM tbl_location WHERE `name`='" .
                    $pick2 .
                    "'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $distance1 = $row['distance'];
                    }
                }

                $sql1 =
                    "SELECT distance FROM tbl_location WHERE `name`='" .
                    $drop2 .
                    "'";
                $result1 = $conn->query($sql1);

                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $distance2 = $row1['distance'];
                    }
                }

                $totaldistance = abs($distance2 - $distance1);

                if ($cars == "cedmicro") {
                    if ($totaldistance <= 10) {
                        $totalcost = 50 + $totaldistance * 13.5;
                    } elseif ($totaldistance >= 10 && $totaldistance <= 60) {
                        $totalcost =
                            50 + 10 * 13.5 + ($totaldistance - 10) * 12;
                    } elseif ($totaldistance >= 60 && $totaldistance <= 160) {
                        $totalcost =
                            50 +
                            10 * 13.5 +
                            50 * 12 +
                            ($totaldistance - 60) * 10.2;
                    } elseif ($totaldistance >= 160) {
                        $totalcost =
                            50 +
                            10 * 13.5 +
                            50 * 12 +
                            100 * 10.2 +
                            ($totaldistance - 160) * 8.5;
                    }
                } elseif ($cars == "cedmini") {
                    if ($totaldistance <= 10) {
                        $totalcost += 150 + $totaldistance * 14.5;
                    } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                        $totalcost +=
                            150 + 10 * 14.5 + ($totaldistance - 10) * 13;
                    } elseif ($totaldistance > 60 && $totaldistance <= 160) {
                        $totalcost +=
                            150 +
                            10 * 14.5 +
                            50 * 13 +
                            ($totaldistance - 60) * 11.2;
                    } elseif ($totaldistance > 160) {
                        $totalcost +=
                            150 +
                            10 * 14.5 +
                            50 * 13 +
                            100 * 11.2 +
                            ($totaldistance - 160) * 9.5;
                    }

                    if ($weight >= 1 && $weight <= 10) {
                        $totalcost = $totalcost + 50;
                    }

                    if ($weight > 10 && $weight <= 20) {
                        $totalcost = $totalcost + 100;
                    }
                    if ($weight > 20) {
                        $totalcost = $totalcost + 200;
                    }
                } elseif ($cars == "cedroyal") {
                    if ($totaldistance <= 10) {
                        $totalcost += 200 + $totaldistance * 15.5;
                    } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                        $totalcost +=
                            200 + 10 * 15.5 + ($totaldistance - 10) * 14;
                    } elseif ($totaldistance > 60 && $totaldistance <= 160) {
                        $totalcost +=
                            200 +
                            10 * 15.5 +
                            50 * 14 +
                            ($totaldistance - 60) * 12.2;
                    } elseif ($totaldistance > 160) {
                        $totalcost +=
                            200 +
                            10 * 15.5 +
                            50 * 14 +
                            100 * 12.2 +
                            ($totaldistance - 160) * 10.5;
                    }

                    if ($weight >= 1 && $weight <= 10) {
                        $totalcost = $totalcost + 50;
                    }

                    if ($weight > 10 && $weight <= 20) {
                        $totalcost = $totalcost + 100;
                    }
                    if ($weight > 20) {
                        $totalcost = $totalcost + 200;
                    }
                } elseif ($cars == "cedsuv") {
                    if ($totaldistance <= 10) {
                        $totalcost += 250 + $totaldistance * 16.5;
                    } elseif ($totaldistance > 10 && $totaldistance <= 60) {
                        $totalcost +=
                            250 + 10 * 16.5 + ($totaldistance - 10) * 15;
                    } elseif ($totaldistance > 60 && $totaldistance <= 160) {
                        $totalcost +=
                            250 +
                            10 * 16.5 +
                            50 * 15 +
                            ($totaldistance - 60) * 13.2;
                    } elseif ($totaldistance > 160) {
                        $totalcost +=
                            250 +
                            10 * 16.5 +
                            50 * 15 +
                            100 * 13.2 +
                            ($totaldistance - 160) * 11.5;
                    }

                    if ($weight >= 1 && $weight <= 10) {
                        $totalcost = $totalcost + 100;
                    }

                    if ($weight > 10 && $weight <= 20) {
                        $totalcost = $totalcost + 200;
                    }
                    if ($weight > 20) {
                        $totalcost = $totalcost + 400;
                    }
                }
               
                echo "Total cost: 	&#x20B9;" . $totalcost . "/-";
            }
        }

        $_SESSION['cost']=$totalcost;
    }

    function pendingride($id, $conn)
    {
        $sql =
            "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`='" .
            $id .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }

    function canceluserride($id, $rideid, $conn)
    {
        $sql =
            "UPDATE tbl_ride SET status=0  WHERE customer_user_id=" .
            $id .
            " AND `status`=1 AND `ride_id`=" .
            $rideid .
            "";

        if ($conn->query($sql) === true) {
            echo '<script type="text/javascript">; 
    alert("Ride Cancel successfully"); 
    window.location= "pendingride.php";
    </script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    function cancelledride($id, $conn)
    {
        $sql =
            "SELECT * FROM tbl_ride WHERE (`status`=0 OR `status`=3) AND `customer_user_id`='" .
            $id .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }

    function completedride($id, $conn)
    {
        $row2 = array();
        $sql =
            "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`='" .
            $id .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }


   

    function allride($id, $conn)
    {
        $sql = "SELECT * FROM tbl_ride WHERE `customer_user_id`='" . $id . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }

    function updateuser($id, $conn)
    {
        $sql = "SELECT * FROM tbl_user WHERE user_id=" . $id . "";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }

    function updateuser2($id, $name, $mobile, $conn)
    {
        $sql =
            "UPDATE tbl_user SET name='" .
            $name .
            "' , mobile='" .
            $mobile .
            "' WHERE user_id=" .
            $id .
            "";

        if ($conn->query($sql) === true) {
            echo '<script type="text/javascript">; 
        alert("Update Done successfully"); 
        window.location= "updateuser.php";
        </script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    function updatepass($id, $name, $newpass, $conpass, $conn)
    {
        $count = 0;
        $pass = md5($name);
        $newpass = md5($newpass);
        $conpass = md5($conpass);
        $sql = "SELECT `password` FROM `tbl_user` WHERE `user_id`=" . $id . "";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dbpass = $row['password'];
            }
            if ($pass == $dbpass) {
                $count = 1;
            } else {
                $count = 0;
            }
        }

        if ($count == 1 && $newpass == $conpass) {
            $sql2 =
                "UPDATE tbl_user SET password='" .
                $newpass .
                "' WHERE user_id=" .
                $id .
                "";

            if ($conn->query($sql2) === true) {
                echo '<script type="text/javascript">; 
            alert("Password Changed successfully ,Please relogin agn with new pass"); 
            window.location= "Logout.php";
            </script>';
            }
        } else {
            echo '<script type="text/javascript">; 
            alert("Password does not matched "); 
            window.location= "changepass.php";
           
            </script>';
        }
    }

    function filteruser($id12, $text, $conn)
    {
        $row1 = array();
        if ($text != "none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id12 .
                " AND status=1 ORDER BY " .
                $text .
                " ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif($text=="none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id12 .
                " AND status=1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }
    }

    function filtercompleteuser($id13, $text, $conn)
    {
        $row1 = array();
        if ($text != "none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id13 .
                " AND status=2 ORDER BY " .
                $text .
                " ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif($text=="none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id13 .
                " AND status=2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }
    }

    function filtercanceluser($id14, $text, $conn)
    {
        $row1 = array();
        if ($text != "none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id14 .
                " AND (status=0 OR status=3) ORDER BY " .
                $text .
                " ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif($text=="none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id14 .
                " AND (status=0 OR status=3)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }
    }

    function filteralluser($id15, $text, $conn)
    {
        $row1 = array();
        if ($text != "none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" .
                $id15 .
                " ORDER BY " .
                $text .
                " ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif($text=="none") {
            $sql =
                "SELECT * FROM tbl_ride WHERE customer_user_id=" . $id15 . "";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }
    }

    function home($conn)
    {
        $row1 = array();
        $sql = "SELECT * FROM tbl_location WHERE is_available=1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
    }

    function filteruserride($id20, $value, $conn)
    {
        if ($value == "week") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)  AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);

            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "month") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)  AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "today") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY)  AND customer_user_id=" .
                $id20 .
                "";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }

        elseif($value=="none")
        {

            $sql = "SELECT * FROM tbl_ride WHERE `customer_user_id`='" . $id20 . "'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row2 = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($row2, $row);
                }
                return $row2;
            } else {
                echo "0 results";
            }

        }
    }

    function filteruserpendingride($id21, $value, $conn)
    {
        if ($value == "week") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=1  AND customer_user_id='" .
                $id21 .
                "'";
            $result = $conn->query($sql);

            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "month") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=1  AND customer_user_id='" .
                $id21 .
                "'";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "today") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=1  AND customer_user_id=" .
                $id21 .
                "";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }

        elseif($value=="none")

        {

            $sql =
            "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`='" .
            $id21 .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }

        }
    }

    function filterusercompletedride($id20, $value, $conn)
    {
        if ($value == "week") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND status=2  AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);

            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "month") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status=2  AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "today") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status=2  AND customer_user_id=" .
                $id20 .
                "";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }


        elseif($value=="none")

        {
            $sql =
            "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`='" .
            $id20 .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }

        }
    }

    function filterusercancelride($id20, $value, $conn)
    {
        if ($value == "week") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND (status=0 OR status=3)  AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);

            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "month") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND (status=0 OR status=3) AND customer_user_id='" .
                $id20 .
                "'";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        } elseif ($value == "today") {
            $sql =
                "SELECT * FROM tbl_ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 1 DAY) AND (status=0 OR status=3) AND customer_user_id=" .
                $id20 .
                "";
            $result = $conn->query($sql);
            $row1 = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($row1, $row);
                }
                return $row1;
            } else {
                echo "0 results";
            }
        }

        elseif($value=="none")
        {
            $sql =
            "SELECT * FROM tbl_ride WHERE (`status`=0 OR `status`=3) AND `customer_user_id`='" .
            $id20 .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
        }
    }

    function filtercompletecab($id31, $value, $conn)
    {
        if($value!="none")
        {
        $sql =
            "SELECT * FROM tbl_ride WHERE `car`='" .
            $value .
            "' AND `status`=2 AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        $row1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
    }
    elseif($value=="none")
    {
        $sql =
        "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`='" .
        $id31 .
        "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row2 = array();
        while ($row = $result->fetch_assoc()) {
            array_push($row2, $row);
        }
        return $row2;
    } else {
        echo "0 results";
    }
    }
    }

    function filterpendingcab($id31, $value, $conn)
    {
        if($value!="none")
        {
        $sql =
            "SELECT * FROM tbl_ride WHERE `car`='" .
            $value .
            "' AND status=1 AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        $row1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
        }
        elseif($value=="none")
        {
            $sql =
            "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
        }
    }

    function filtercancelcab($id31, $value, $conn)
    {
        if($value!="none")
        {
        $sql =
            "SELECT * FROM tbl_ride WHERE `car`='" .
            $value .
            "' AND (status=0 OR status=3) AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        $row1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
    }
    elseif($value=="none")
    {
        $sql =
            "SELECT * FROM tbl_ride WHERE (`status`=0 OR `status`=3) AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row2 = array();
            while ($row = $result->fetch_assoc()) {
                array_push($row2, $row);
            }
            return $row2;
        } else {
            echo "0 results";
        }
    }
    }

    function filterallcab($id31, $value, $conn)
    {
        if($value!="none")
        {
        $sql =
            "SELECT * FROM tbl_ride WHERE `car`='" .
            $value .
            "' AND `customer_user_id`='" .
            $id31 .
            "'";
        $result = $conn->query($sql);

        $row1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
    }
    elseif($value=="none")
    {
        $sql = "SELECT * FROM tbl_ride WHERE `customer_user_id`='" . $id31 . "'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row2 = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($row2, $row);
                }
                return $row2;
            } else {
                echo "0 results";
            }

    }
    }

    function countnewrequest($id, $conn)
    {
        $sql =
            "SELECT * FROM tbl_ride WHERE status=2 AND customer_user_id='" .
            $id .
            "'";
        $result08 = $conn->query($sql);
        $len = 0;

        if ($result08->num_rows > 0) {
            $len = $result08->num_rows;
            return $len;
        } else {
            echo "0";
        }
    }

    function countnewriderequest($id, $conn)
    {
        $sql =
            "SELECT * FROM tbl_ride WHERE status=1 AND customer_user_id='" .
            $id .
            "'";
        $result08 = $conn->query($sql);
        $len = 0;

        if ($result08->num_rows > 0) {
            $len = $result08->num_rows;
            return $len;
        } else {
            echo "0";
        }
    }

    function counttotalearning($id, $conn)
    {
        $sql08 =
            "SELECT total_fare FROM `tbl_ride` WHERE `status`=2 AND customer_user_id='" .
            $id .
            "'";
        $result08 = $conn->query($sql08);

        if ($result08->num_rows > 0) {
            $row1 = 0;

            while ($row = $result08->fetch_assoc()) {
                $row1 = $row1 + $row['total_fare'];
            }

            return $row1;
        } else {
            echo "0";
        }
    }

    function calci($conn)
    {
        $sql = "SELECT * FROM tbl_location";
        $result = $conn->query($sql);

        $row1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($row1, $row);
            }
            return $row1;
        } else {
            echo "0 results";
        }
    }
}

?>
