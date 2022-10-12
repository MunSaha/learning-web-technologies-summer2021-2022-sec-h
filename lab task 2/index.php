<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
    .red {
        color: blue;
    }
    </style>
    <title>Data Validation</title>
</head>

<body>
    <div>
        <?php
            $name = $email= $dob  = $gender = $degree = $blood_group ="";
            $nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $blood_groupErr ="";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if(empty($_POST["name"])) {
                $nameErr = "Name should not be empty!\n";
              }
              else if(!preg_match("/^[a-zA-Z]{2}[a-zA-Z0-9- ]{2,}$/",$_POST["name"])) {
                $nameErr = "Name is in invalid format! no number allowed in front\n";
              } else {
                $name = $_POST["name"];
              }



              if(empty($_POST["email"])) {
                $emailErr = "Email should not be empty!\n";
              } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Please enter valid email address!";
              } else {
                $email = $_POST["email"];
              }


              if(empty($_POST["dob_dd"]) || empty($_POST["dob_mm"]) || empty($_POST["dob_yyyy"])) {
                $dobErr = "Date of birth should not be empty!\n";
              } else if (!checkdate($_POST["dob_mm"], $_POST["dob_dd"], $_POST["dob_yyyy"])) {
                $dobErr = "Please enter valid date of birth!";
              } else {
                $dob = $_POST['dob_dd'] . "-"  . $_POST['dob_mm'] . "-" . $_POST['dob_yyyy'];
              }

              if(empty($_POST["gender"])) {
                $genderErr = "Gender should not be empty!\n";
              } else {
                $gender = $_POST["gender"];
              }

              if(empty($_POST["degree"])){
                $degreeErr = "Degree should not be empty!\n";
              } else if(!is_array($_POST["degree"]) || sizeof($_POST["degree"]) <2 )  {
                $degreeErr = "Atleast should have two degrees!\n";
              } else {
                foreach($_POST['degree'] as $selected){
                    $degree .= $selected."</br>";
                }
              }

              if(empty($_POST["blood_group"])) {
                $blood_groupErr = "Blood group must be selected!";
              } else {
                $blood_group = $_POST["blood_group"];
              }
            }
        ?>
        <form action="index.php" method="post">
            <label>
               <h2>Name</h2>
                <input type="text" name="name" />
                <span class="red">
                    <?php echo $nameErr; ?>
                </span>
                <br />
            </label>

            <label>
                <h2>Email</h2>

                <input type="text" name="email" />
                <span class="red">
                    <?php echo $emailErr; ?>
                </span>
                <br />
            </label>



            <label>
                <h2>Date of Birth</h2>

                <input type="text" placeholder="day" name="dob_dd" /> /
                <input type="text" placeholder="month" name="dob_mm" /> /
                <input type="text" placeholder="year" name="dob_yyyy" />
                <span class="red">* <?php echo $genderErr;?></span>
                <br />
            </label>


            <label>
                <h2>Gender</h2>

                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>
                    value="female">Female
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>
                    value="male">Male
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?>
                    value="other">Other

                <span class="red">* <?php echo $genderErr;?></span>

                <br />
            </label>


            <label>
                <h2>Degree</h2>
                <input type="checkbox" id="ssc" name="degree[]" value="ssc">
                <label for="ssc"> SSC</label>
                <input type="checkbox" id="hsc" name="degree[]" value="hsc">
                <label for="hsc"> HSC</label>
                <input type="checkbox" id="bsc" name="degree[]" value="bsc">
                <label for="bsc"> BSc</label>
                <input type="checkbox" id="msc" name="degree[]" value="msc">
                <label for="msc">MSc</label>
                <br />
            </label>

            </br>

            <label for="blood_group">
                <h2>Blood Group </h2>
                <select name="blood_group" id="blood_group">
                    
                    <option value=""> </option>
                    <option value="A-">A-</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O-">O-</option>
                    <option value="O+">O+</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <span class="red">* <?php echo $blood_groupErr;?></span>
            </label>

            <input type="submit" />
        </form>
    </div>

    <hr />
    <div>
        <?php 
        
            echo "$name </br>"; 
            
            echo "$email </br>";
            
            echo "$gender </br>";
            echo "$dob </br>";
            echo "$degree </br>";
            echo "$blood_group </br>";
        ?>
    </div>
</body>

</html>