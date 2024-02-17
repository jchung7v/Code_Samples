
    <?php $title = "Home"; ?>
    <?php include("_header.php"); ?>
    <h3>
        <?php
        $firstName = "John";
        $lastName = "Doe";
        $salary = 100000;
        echo $firstName . " " . $lastName;
        // 'echo' is used for printing. You can also use 'print'. Interchangeable.
        ?>
        <br>
        <!-- people don't like to put <br> inside of php code lines -->
        <?php
        echo "$firstName $lastName earns $$salary per year";
        // Although, firstName and lastName are defined up there, they are still available
        # This is a comment.
        // This comment style also works.
        ?>
        <br>
        <hr>
        <?php
            // Constant
            define("PI", 3.14);
            // print the area of the circle with a radius of 4.
            $radius = 4;
            echo "The area of the circle is " . PI * $radius * $radius;
        ?>
        <br>
        <hr>
        <?php
            // PHP is not strongly typed language.
            // The statement below (see the lastname) is valid.
            $firstName = "John";
            $lastName = "Doe";
            $lastName = 1234;
            $salary = 100000;
            echo "$firstName $lastName earns $$salary per year";
        ?>
        <br>
        <hr>
        <?php
            // Array
            // $provinces[] = "British Columbia";
            // $provinces[] = "Alberta";
            // $provinces[] = "Saskatchewan";
            // $provinces[] = "Manitoba";
            // $provinces[] = "Ontario";
            // $provinces[] = "Quebec";
            $provinces = array(
                "British Columbia", 
                "Alberta", 
                "Saskatchewan", 
                "Manitoba", 
                "Ontario", 
                "Quebec"
                );
            echo $provinces[0];
            echo "<br>";
            var_dump($provinces); // ***this is for a developer. It shows the type of the variable and the value.
        ?>
        <br>
        <hr>
        <?php
            // Built-in three constants (for debugging purpose)
            echo "Line #: " . __LINE__ . "<br>";
            echo "File: " . __FILE__ . "<br>";
            echo "PHP Ver: " . PHP_VERSION . "<br>";
        ?>
        <br>
        <hr>
        <?php
            // You can turn the setting on and off
                
            // Dumping data
            // print_r(), var_dump(), var_export() -> Try them out.
            // Type casting is possible
        ?>
        <br>
        <hr>
        <?php
            
        ?>
    </h3>
    <?php include("_footer.php"); ?>