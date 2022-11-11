<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$reqCountry=trim(filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING));
$country= $conn->query("SELECT * FROM countries WHERE name LIKE '%$reqCountry%'");
$countryQ= $country->fetchAll(PDO::FETCH_ASSOC);




?>


<ul>
<?php foreach ($countryQ as $check): ?>
  <li><?= $check['name']; ?></li>
<?php endforeach; ?>
</ul>

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
