<!DOCTYPE html>
<html>
    <head>
        <title>Editor Page</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

// Tüm ciltleri çekme
        $query = "SELECT v.id, v.name, v.publicationDate, j.name AS journalName FROM volume v JOIN journal j ON v.name = j.name";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<h1>Cilt Seçimi</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Journal Name</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Volume ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Publication Date</font></th>
        </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
            <td>' . htmlspecialchars($row['journalName']) . '</td>
            <td><a href="editorVolume.php?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</a></td>
            <td>' . htmlspecialchars($row['publicationDate']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "Hiç cilt bulunamadı.";
        }

        $conn->close();
        ?>

        <P>
            <a href="./">Ana sayfaya dön</a>
        </P>

    </body>
</html>


