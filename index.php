<?php
    include("scripts/connectDB.php");

    $sql = "SELECT personID, addressID, firstName, surname, status FROM person";
    $result = mysqli_query($conn, $sql);

    echo "<form action=\"index.php\" method=\"get\">";
        echo "<select name=\"Person\">";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"".$row["personID"]."\">
                Firstname: ".$row["firstName"]." Surname: ".$row["surname"].
                "</option>";
        };
        echo "</select>";
        echo "<input type=\"submit\" value=\"Go\" name=\"Search\" />";
    echo "</form>";

    if(isset($_GET['Search']))
    {
        $personID = $_GET['Person'];
        $sql = "SELECT personID, address.addressID, houseNumName, addressTwo, addressThree,	townCity, county, postCode,	address.status
                FROM person, address 
                WHERE personID = $personID 
                AND person.addressID = address.addressID";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>".$row["houseNumName"]."</p>";
            echo "<p>".$row["addressTwo"]."</p>";
            echo "<p>".$row["addressThree"]."</p>";
            echo "<p>".$row["townCity"]."</p>";
            echo "<p>".$row["county"]."</p>";
            echo "<p>".$row["postCode"]."</p>";
        };
    };

    // ----------------------------------------------------------------------------------------------------------------------------------

    $sql = "SELECT addressID, houseNumName, postCode, status FROM address";
    $result = mysqli_query($conn, $sql);

    echo "<form action=\"index.php\" method=\"get\">";
        echo "<select name=\"AddressID\">";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"".$row["addressID"]."\">
                Address: ".$row["houseNumName"].", ".$row["postCode"].
                "</option>";
        };
        echo "</select>";
        echo "<input type=\"submit\" value=\"Go\" name=\"AddressSearch\" />";
    echo "</form>";

    if(isset($_GET['AddressSearch']))
    {
        $addressID = $_GET['AddressID'];
        $sql = "SELECT personID, address.addressID, firstName, middleName, surname,	person.status
                FROM person, address
                WHERE address.addressID = $addressID 
                AND person.addressID = address.addressID";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>".$row["firstName"]."</p>";
            echo "<p>".$row["middleName"]."</p>";
            echo "<p>".$row["surname"]."</p>";
        };
    };
?>
<!-- ------------------------------------------------------------------- -->
    <form action="scripts/doInsert.php" method="get">
        <?php
            $sql = "SELECT addressID, houseNumName, postCode, status 
                    FROM address";
            $result = mysqli_query($conn, $sql);
        ?>
        <input type="input" name="firstName" value="" placeholder="First Name" />
        <input type="input" name="middleName" value="" placeholder="Middle Name (optional)" />
        <input type="input" name="surname" value="" placeholder="Surname" />
        <select name="address">
            <?php
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"".$row["addressID"]."\">
                        Address: ".$row["houseNumName"].", ".$row["postCode"].
                        "</option>";
                };
            ?>
        </select>
        <input type="submit" name="submit" value="Insert Person" />
    </form>

<!-- ------------------------------------------------------------------- -->

    <form action="scripts/doInsert.php" method="get">
        <input type="input" name="houseNumName" value="" placeholder="House Number or Name" />
        <input type="input" name="addressTwo" value="" placeholder="Address Two (optional)" />
        <input type="input" name="addressThree" value="" placeholder="Address Three (optional)" />
        <input type="input" name="townCity" value="" placeholder="Town or City" />
        <input type="input" name="county" value="" placeholder="County" />
        <input type="input" name="postCode" value="" placeholder="Post Code" />
        <input type="submit" name="submit" value="Insert Address" />
    </form>

<!-- ------------------------------------------------------------------------- -->
    <div>
    <form action="index.php" method="get">
        <input type="input" name="firstName" value="" placeholder="First Name" />
        <input type="submit" value="Go" name="PersonNameSearch" />
    </form>

    <?php
        if(isset($_GET["PersonNameSearch"]))
        {
            $firstName = $_GET['firstName'];
            $prevPage = $_SERVER['HTTP_REFERER'];
    
            $sql = "SELECT firstName, middleName, surname 
                    FROM person
                    WHERE firstName LIKE '%$firstName%'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<p>".$row["firstName"]."</p>";
                echo "<p>".$row["middleName"]."</p>";
                echo "<p>".$row["surname"]."</p>";
            };
        }
    ?>
    </div>

<!-- --------------------------------------------------------------------------- -->
<div>
    <form action="index.php" method="get">
        <input type="input" name="surname" value="" placeholder="Surname" />
        <input type="submit" value="Go" name="PersonDetailSearch" />
    </form>
    <table>
        <tr>
            <th>First Name</th><th>Second Name</th><th>Surname</th><th>House Number or Name</th>
            <th>Address Two</th><th>Address Three</th><th>Town or City</th><th>County</th>
            <th>Post Code</th>
        </tr>
    <?php
        if(isset($_GET["PersonDetailSearch"]))
        {
            $surname = $_GET['surname'];
            //$prevPage = $_SERVER['HTTP_REFERER'];
    
            $sql = "SELECT firstName, middleName, surname, houseNumName, addressTwo, addressThree, townCity, county, postCode  
                    FROM person, address
                    WHERE surname LIKE '%$surname%'
                    AND address.addressID = person.addressID";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row["firstName"]."</td><td>".$row["middleName"]."</td><td>".$row["surname"]."</td><td>".$row["houseNumName"]."</td>
                        <td>".$row["addressTwo"]."</td><td>".$row["addressThree"]."</td><td>".$row["townCity"]."</td><td>".$row["county"]."</td>
                        <td>".$row["postCode"]."</td>
                    </tr>";
            };
        }
    ?>
    </table>
    </div>