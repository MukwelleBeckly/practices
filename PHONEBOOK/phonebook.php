<?php
include_once 'db.php';

// ✅ Insert new contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['phone'])) {
  $name = $conn->real_escape_string($_POST['name']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";
  $conn->query($sql);
}

// ✅ Deletion confirmation message
if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
  echo "<p style='color: green;'>✅ Contact deleted successfully.</p>";
}

// ✅ Search feature
$searchQuery = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
  $search = $conn->real_escape_string($_GET['search']);
  $searchQuery = "WHERE name LIKE '%$search%' OR phone LIKE '%$search%'";
}

// ✅ Fetch contacts
$sql = "SELECT id, name, phone FROM contacts $searchQuery ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!-- 🔍 Search Form -->
 <h2>📒 Phone Book</h2>
<form method="GET" action="phonebook.php">
  <input type="text" name="search" placeholder="Search by name or phone...">
  <button type="submit">🔍Search</button>
</form>

<!-- 📒 Contact Form -->
<form method="POST" action="phonebook.php">
  <input type="text" name="name" placeholder="Full Name" required>
  <input type="text" name="phone" placeholder="Phone Number" required>
  <button type="submit">📋Add Contact</button>
</form>

<!-- 📋 Display Contacts -->
<?php
if ($result->num_rows > 0) {
  echo "<table border='1' cellpadding='10' style='margin-top:20px;'>
          <tr><th>Name</th><th>Phone</th><th>Actions</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['phone']}</td>
            <td>
              <form method='POST' action='delete.php' onsubmit=\"return confirm('Delete this contact?');\">
                <input type='hidden' name='id' value='{$row['id']}'>
                <button type='submit'>🗑️ Delete</button>
              </form>
            </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No entries found.</p>";
}
?>
