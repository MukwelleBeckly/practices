
<form action="form.php" method="post">
  <h2>Add New Contact</h2><br
    <?php
    if(!empty($errormessage)){
      echo "$errormessage";
    }
  ?>
  <label>Name:</label><br>
  <input type="text" name="name" required><br>
  <label>Phone Number:</label><br>
  <input type="text" name="number" ><br>
  <label>Email:</label></br>
  <input type="text" name="email" required><br>
  <input type="submit" value="Add Contact">
</form>
