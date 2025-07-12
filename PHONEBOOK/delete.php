<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = (int) $_POST['id']; // Sanitize to avoid SQL injection

  $sql = "DELETE FROM contacts WHERE id = $id";
  if ($conn->query($sql)) {
    // Redirect back to phonebook.php with a success flag
    header("Location: phonebook.php?deleted=1");
    exit;
  } else {
    echo "<p style='color: red;'>❌ Error deleting contact: " . $conn->error . "</p>";
  }
} else {
  echo "<p style='color: orange;'>⚠️ No contact selected for deletion.</p>";
}
?>

