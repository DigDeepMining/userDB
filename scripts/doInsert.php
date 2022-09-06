<?php
    include("connectDB.php");

    if((isset($_GET['submit'])) && ($_GET['submit'] == "Insert Person"))
    {
        $addressID = $_GET['address'];
        $firstName = $_GET['firstName'];
        $middleName = $_GET['middleName'];
        $surname = $_GET['surname'];
        $prevPage = $_SERVER['HTTP_REFERER'];

        $sql = "INSERT INTO person (addressID, firstName, middleName, surname)
            VALUES ($addressID, '$firstName', '$middleName', '$surname')";
        if(mysqli_query($conn, $sql))
        {
            header("Location: $prevPage?Message=Success");
        }
        else
        {
            header("Location: $prevPage?Message=Fail");
        }
    }
    elseif(isset($_GET['submit']) && ($_GET['submit'] == "Insert Address"))
    {
        $houseNumName = $_GET['houseNumName'];
        $addressTwo = $_GET['addressTwo'];
        $addressThree = $_GET['addressThree'];
        $townCity = $_GET['townCity'];
        $county = $_GET['county'];
        $postCode = $_GET['postCode'];
        $prevPage = $_SERVER['HTTP_REFERER'];

        $sql = "INSERT INTO address (houseNumName, addressTwo, addressThree, townCity, county, postCode)
            VALUES ('$houseNumName', '$addressTwo', '$addressThree', '$townCity', '$county', '$postCode')";
        if(mysqli_query($conn, $sql))
        {
            header("Location: $prevPage?Message=Success");
        }
        else
        {
            header("Location: $prevPage?Message=Fail");
        }
    }
?>
