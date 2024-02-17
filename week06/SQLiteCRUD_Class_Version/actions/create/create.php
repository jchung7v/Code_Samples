<?php include("../../inc_header.php"); 
    $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>

<h1>Create New</h1>

<div class="row">
    <div class="col-md-4">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <form action="create_process.php" method="post">
            <div class="form-group">
                <label for="StudentId" class="control-label">Student ID</label>
                <input for="StudentId" class="form-control" name="StudentId" id="StudentId" required />
                <div id="studentIdWarning" style="color: red;"></div>            
            </div>

            <div class="form-group">
                <label for="FirstName" class="control-label">First Name</label>
                <input for="FirstName" class="form-control" name="FirstName" id="FirstName" required/>
            </div>

            <div class="form-group">
                <label for="LastName" class="control-label">Last Name</label>
                <input for="LastName" class="form-control" name="LastName" id="LastName" required/>
            </div>

            <div class="form-group">
                <label for="School" class="control-label">School</label>
                <input for="School" class="form-control" name="School" id="School" required/>
            </div>

            <div class="form-group">
                <a href="../../index.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Create" name="create" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<?php include("../../inc_footer.php"); ?>