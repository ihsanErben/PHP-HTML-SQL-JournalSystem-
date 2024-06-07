<!DOCTYPE html>
<html>
    <head>
        <title>All Volumes</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $journal_name = $_GET['name'];

// SQL sorgusunu prepared statement ile oluşturma
        $query = "SELECT DISTINCT v.id, v.name 
          FROM volume v 
          LEFT OUTER JOIN person p ON v.id = p.vid
          LEFT OUTER JOIN volumetheme vt ON v.id = vt.id
          LEFT OUTER JOIN journal j ON vt.name = j.name
          WHERE j.name = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $journal_name);
        $stmt->execute();
        $result = $stmt->get_result();

        $num = $result->num_rows;

        if ($num > 0) {
            echo '<table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial, Helvetica, sans-serif">Volume ID</font></th>
                <th><font face="Arial, Helvetica, sans-serif">Volume Name</font></th>
            </tr>';

            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $name = $row["name"];
                echo '<tr>
                <td><a href="accessVolume.php?id=' . htmlspecialchars($id) . '">' . htmlspecialchars($id) . '</a></td>
                <td>' . htmlspecialchars($name) . '</td>
              </tr>';
            }

            echo '</table>';
        } else {
            echo "Derginin ciltleri yok.<br>";
        }

        $stmt->close();
        $conn->close();
        ?>

        <p>
            <a href="./">Return to main page</a>
        </p>

    </body>
</html>
