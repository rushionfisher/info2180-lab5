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
<?php if (isset($_GET['country']) && !isset($_GET['context'])):  ?>
    <table>
        <tr>
          <th> Country Name</th>  
          <th> Continent</th>  
          <th> Indenpendence Year</th>  
          <th> Head of State</th>  
        </tr>
        
        <tbody>
        <?php foreach ($countryQ as $place): ?>
            <tr>
                <td> <?= $place['name']; ?></td>  
                <td> <?= $place['continent']; ?></td>  
                <td> <?= $place['independence_year']; ?></td>  
                <td> <?= $place['head_of_state']; ?></td>  
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>