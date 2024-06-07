<!DOCTYPE html>
<html>
    <head>
        <title>Editor Volume Page</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $id = $_GET['id'];

// Cilt bilgilerini çekme
        $query = "SELECT v.id, v.name, v.publicationDate FROM volume v WHERE v.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $volumeResult = $stmt->get_result();

        if ($volumeResult->num_rows > 0) {
            $volume = $volumeResult->fetch_assoc();
            echo '<h1>Cilt Bilgileri</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Volume ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Volume Name</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Publication Date</font></th>
        </tr>';
            echo '<tr>
        <td>' . htmlspecialchars($volume['id']) . '</td>
        <td>' . htmlspecialchars($volume['name']) . '</td>
        <td>' . htmlspecialchars($volume['publicationDate']) . '</td>
    </tr>';
            echo '</table>';
        } else {
            echo "Cilt bilgisi bulunamadı.";
        }

// Makaleleri ve inceleyici bilgilerini çekme
        $query = "SELECT a.id AS articleID, a.title, ar.email AS reviewerEmail, ar.scoreOfTheReviewer 
          FROM article a 
          LEFT JOIN articlereviews ar ON a.id = ar.id 
          WHERE a.volid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $articleResult = $stmt->get_result();

        if ($articleResult->num_rows > 0) {
            echo '<h2>Makaleler ve İnceleyiciler</h2>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Article ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Title</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Reviewer Email</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Reviewer Score</font></th>
        </tr>';
            while ($row = $articleResult->fetch_assoc()) {
                echo '<tr>
            <td>' . htmlspecialchars($row['articleID']) . '</td>
            <td>' . htmlspecialchars($row['title']) . '</td>
            <td>' . htmlspecialchars($row['reviewerEmail']) . '</td>
            <td>' . htmlspecialchars($row['scoreOfTheReviewer']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "Bu cilte ait makale bulunamadı.";
        }

// Bağlantıyı kapat
        $stmt->close();
        $conn->close();
        ?>

        <P>
            <a href="editor.php">Cilt Seçimine Dön</a>
        </P>

    </body>
</html>
