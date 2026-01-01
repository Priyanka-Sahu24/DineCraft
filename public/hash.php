<?php
// Simple PHP to generate bcrypt hashes

echo "<h2>Dinecraft Hashed Passwords</h2>";

echo "<p>Admin hash: " . password_hash("admin123", PASSWORD_BCRYPT) . "</p>";
echo "<p>Staff hash: " . password_hash("staff123", PASSWORD_BCRYPT) . "</p>";
