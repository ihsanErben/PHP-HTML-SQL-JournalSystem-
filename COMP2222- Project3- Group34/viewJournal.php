<!DOCTYPE html>
<html>
    <head>
        <title>Journal</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $name = $_GET['name'];

// Prepare statement kullanarak dergi bilgilerini çekme
        $query = "SELECT name, frequency FROM journal WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

// Sonuçları kontrol et ve tabloyu oluştur
        if ($result->num_rows > 0) {
            echo '<h1>Dergi Bilgileri</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Name</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Frequency</font></th>
        </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
            <td>' . htmlspecialchars($row['name']) . '</td>
            <td>' . htmlspecialchars($row['frequency']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "Dergi bilgisi bulunamadı.";
        }

// Derginin ciltlerini çekme
        $query = "SELECT id, publicationDate FROM volume WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<h2>Ciltler</h2>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Volume ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Publication Date</font></th>
        </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
            <td><a href="viewVolumes.php?name=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</a></td>
            <td>' . htmlspecialchars($row['publicationDate']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "Bu dergiye ait cilt bulunamadı.";
        }

// Bağlantıyı kapat
        $stmt->close();
        $conn->close();
        ?>

        <P>
            <a href="./">Ana sayfaya dön</a>
        </P>

    </body>
</html>
