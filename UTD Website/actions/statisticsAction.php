
<?php

if(isset($_POST['statistics'])){
  require 'databaseHandler.php';

  $sql1 = "SELECT COUNT(*) AS Total FROM students;";
  $sql2 = "SELECT COUNT(*) AS Total FROM students WHERE GPA > 3.2 AND SATScore > 1200;";
  $sql3 = "SELECT COUNT(*) AS Total FROM students WHERE YEAR(CURDATE()) - YEAR(Birthday) > 20;";
  $sql4 = "SELECT ROUND(AVG(GPA),2) AS 'GPA Average' FROM students WHERE GPA > 3.2 AND SATScore > 1200;";
  $sql5 = "SELECT Zipcode, COUNT(*) AS 'Num Of Students Associated' FROM students WHERE GPA > 3.2 AND SATScore > 1200 GROUP BY Zipcode;";
  $sql6 = "SELECT COUNT(*) AS Total FROM students WHERE GPA > 3.8 AND SATScore > 1400;";

  $result = mysqli_query($connect, $sql1);
  $data1 = mysqli_fetch_assoc($result);

  $result2 = mysqli_query($connect, $sql2);
  $data2 = mysqli_fetch_assoc($result2);

  $result3 = mysqli_query($connect, $sql3);
  $data3 = mysqli_fetch_assoc($result3);

  $result4 = mysqli_query($connect, $sql4);
  $data4 = mysqli_fetch_assoc($result4);

  $result5 = mysqli_query($connect, $sql5);

  $result6 = mysqli_query($connect, $sql6);
  $data6 = mysqli_fetch_assoc($result6);

  $final1 = $data1['Total'];
  $final2 = $data2['Total'];
  $final3 = $data3['Total'];
  $final4 = $data4['GPA Average'];
  $final6 = $data6['Total'];

  echo "<p>Total Amount of Students that Applied: {$final1}</p>";
  echo "<p>Total Number Admitted: {$final2}</p>";
  echo "<p>Number of Students older than 20: {$final3}</p>";
  echo "<p>Admitted Students Average GPA: {$final4}</p>";

  echo "<table>
        <tr>
          <th>Zipcode</th>
          <th>Number Of Admitted Students</th>
        </tr>";
  while($data5 = mysqli_fetch_assoc($result5))
  {
    echo "<tr>
          <td>".$data5['Zipcode']."</td>
          <td>".$data5['Num Of Students Associated']."</td>
          </tr>";
  }
  echo "</table><br>";

  echo"<p>Number of Students who's GPA is Above 3.8 and SAT is above 1400: {$final6}</p>";

}
?>
