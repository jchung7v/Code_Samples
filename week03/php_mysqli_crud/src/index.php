<?php include("inc_header.php"); ?>

<h1>CRUD Operations with PHP &amp; MySQL</h1>
<h3>Juan Chung (A01353601)</h3>
<br>
<div style="font-size: x-large;">
    <p><a href="./create_db">Create School database</a></p>
    <p><a href="./create_table">Create Students table</a></p>
    <p><a href="./insert_sample_data">Insert Sample Student Data</a></p>
    <p><a href="./crud/list">List Students (CRUD)</a></p>
    <p><a href="./crud/injection/injection.php">SQL Injection Example</a></p>
    <br/><br/>
    <p class='alert alert-warning'>
        <b>NOTE:</b>
        <br/><br/>
        Use this command to start MySQL server in a container listening on port 3333: 
        <br/><br/>
        docker run -d -p 3333:3306 --name maria -e MYSQL_ROOT_PASSWORD=secret mariadb:10.7.3
    </p>
</div>

<?php include("inc_footer.php"); ?>