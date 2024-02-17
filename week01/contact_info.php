<?php echo $title = "Contact Info"; ?>
<?php include("_header.php"); ?>
<!-- create an HTML form with first name, last name, email, and phone number -->
<form action="contact_submit.php" method="post"> <!-- action is the file that will process the form -->
    <label for="firstName">First Name</label>
    <input type="text" name="firstName" id="firstName" required />
    <br />
    <label for="lastName">Last Name</label>
    <input type="text" name="lastName" id="lastName" required />
    <br />
    <label for="email">Email</label>
    <input name="email" id="email" required />
    <br />
    <label for="phone">Phone Number</label>
    <input name="phone" id="phone" required />
    <br />
    <input type="submit" value="Submit" />

<?php include("_footer.php"); ?>