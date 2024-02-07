<html>
<head>
  <meta charset="UTF-8">
  <title>Facts about the USA</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      text-align: center;
      font-size: 32px;
      margin-top: 40px;
    }
    img {
      display: block;
      margin: 40px auto;
      max-width: 100%;
      height: auto;
    }
    table {
      margin: 40px auto;
      border-collapse: collapse;
      width: 80%;
      max-width: 600px;
      font-size: 20px;
    }
    td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    td:first-child {
      font-weight: bold;
      width: 35%;
    }
    td:last-child {
      text-align: right;
      width: 35%;
    }
    tr:nth-child(odd) {

    }
    small {
      font-size: 12px;
      text-align: center;
      display: block;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h1>Facts about the USA!!!</h1>
  <img src="usa-map.png" alt="Map of the USA">
  <table>
    <tr>
      <td>Total area</td>
      <td>3,717,792 square miles</td>
    </tr>
    <tr>
      <td>Population</td>
      <td>333,287,557</td>
    </tr>
    <tr>
      <td>Capitol</td>
      <td>Washington, D.C.</td>
    </tr>
  </table>
  <h1>Most populated states</h1>
  <table>
<?php
   $database = "usa";
   $user = "web_user";
   $password  = "Password1";
   $host = "db";

   try {
      $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
      $query = $connection->query("SELECT state_name, population FROM states ORDER BY population DESC");
      $states = $query->fetchAll();

      if (empty($states)) {
         echo "<tr><td>No data.</td></tr>\n";
      } else {
         foreach ($states as $state) {
            print "<tr><td>{$state['state_name']}</td><td align=\"right\">{$state['population']}</td></tr>\n";
         }
      }
   }
   catch (PDOException $e) {
      print "<tr><td>No connection to the database. Try again later.</td></tr>\n";
   }
?>
      </table>
      <footer>
            <small><i>Build: 2023.02.03. K8s microservice architecture deployed on GCP. See the whole code - https://github.com/zefirnikolov/gcpapp-k8scluster</i></small>
      </footer>
</body>
</html>
