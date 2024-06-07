<!DOCTYPE html>
<html>
    <head>
        <title>Volume</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $id = $_GET['id'];

// Prepare statement kullanarak sorgu yapma
        $query = "SELECT id, name, publicationDate, firstSubOpen, firstSubDeadline, reviewStarts, reviewDeadline, resultsAnnouncement, secondSubOpen, secondSubDeadline FROM volume WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

// Sonuçları kontrol et ve tabloyu oluştur
        if ($result->num_rows > 0) {
            echo '<table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial, Helvetica, sans-serif">id</font></th>
                <th><font face="Arial, Helvetica, sans-serif">name</font></th>
                <th><font face="Arial, Helvetica, sans-serif">publicationDate</font></th>
                <th><font face="Arial, Helvetica, sans-serif">firstSubOpen</font></th>
                <th><font face="Arial, Helvetica, sans-serif">firstSubDeadline</font></th>
                <th><font face="Arial, Helvetica, sans-serif">reviewStarts</font></th>
                <th><font face="Arial, Helvetica, sans-serif">reviewDeadline</font></th>
                <th><font face="Arial, Helvetica, sans-serif">resultsAnnouncement</font></th>
                <th><font face="Arial, Helvetica, sans-serif">secondSubOpen</font></th>
                <th><font face="Arial, Helvetica, sans-serif">secondSubDeadline</font></th>
            </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td><a href="viewJournal.php?name=' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</a></td>
                <td>' . htmlspecialchars($row['publicationDate']) . '</td>
                <td>' . htmlspecialchars($row['firstSubOpen']) . '</td>
                <td>' . htmlspecialchars($row['firstSubDeadline']) . '</td>
                <td>' . htmlspecialchars($row['reviewStarts']) . '</td>
                <td>' . htmlspecialchars($row['reviewDeadline']) . '</td>
                <td>' . htmlspecialchars($row['resultsAnnouncement']) . '</td>
                <td>' . htmlspecialchars($row['secondSubOpen']) . '</td>
                <td>' . htmlspecialchars($row['secondSubDeadline']) . '</td>
            </tr>';
            }
            echo '</table>';
        } else {
            echo "Veri bulunamadı.";
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
