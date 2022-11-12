<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pcountry=trim(filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING));
$country= $conn->query("SELECT * FROM countries WHERE name LIKE '%$pcountry%'");
$countryque= $country->fetchAll(PDO::FETCH_ASSOC);

$pcity =trim(filter_var(htmlspecialchars($_GET['context']), FILTER_SANITIZE_STRING)); 
$city= $conn->query("SELECT cities.population, cities.district ,cities.name FROM cities JOIN countries ON countries.code=cities.country_code WHERE countries.name LIKE '%$pcity%'");
$cityque= $city->fetchAll(PDO::FETCH_ASSOC);

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
        <?php foreach ($countryque as $area): ?>
            <tr>
                <td> <?= $area['name']; ?></td>  
                <td> <?= $area['continent']; ?></td>  
                <td> <?= $area['independence_year']; ?></td>  
                <td> <?= $area['head_of_state']; ?></td>  
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
        
    <?php elseif (isset($_GET['context']) && isset($_GET['country'])):?>
        <table>
            <tr>
              <th> Name</th>  
              <th> District</th>  
              <th> Popululation</th>  
            </tr>
            
            <tbody>
            <?php foreach ($cityque as $place): ?>
                <tr>
                    <td> <?= $place['name']; ?></td>  
                    <td> <?= $place['district']; ?></td>  
                    <td> <?= $place['population']; ?></td>  
                </tr>
             <?php endforeach; ?>
            </tbody>
        </table>
<?php endif ?>