<!DOCTYPE html>
<html>
    <head>
        <title>Journal</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $id = $_GET['id'];

        // Fetch article details using the article ID
        $query = "SELECT * FROM article WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check results and create the table
        if ($result->num_rows > 0) {
            echo '<h1>Makale Bilgileri</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>ID</th>
                <th>Volume Name</th>
                <th>Volume ID</th>
                <th>Title</th>
                <th>Body Text</th>
                <th>Corresponding Author</th>
                <th>Submission Date</th>
                <th>Result</th>
            </tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td>' . htmlspecialchars($row['volname']) . '</td>
                <td>' . htmlspecialchars($row['volid']) . '</td>
                <td>' . htmlspecialchars($row['title']) . '</td>
                <td>' . htmlspecialchars($row['bodyText']) . '</td>
                <td>' . htmlspecialchars($row['correspAut']) . '</td>
                <td>' . htmlspecialchars($row['submissionDate']) . '</td>
                <td>' . htmlspecialchars($row['result']) . '</td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo "Makale bilgisi bulunamadı.";
        }

        // Fetch volumes related to the article's volume name
        $query = "SELECT id, publicationDate FROM volume WHERE name = (SELECT volname FROM article WHERE id = ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<h2>Ciltler</h2>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th>Volume ID</th>
                <th>Publication Date</th>
            </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</a></td>
                <td>' . htmlspecialchars($row['publicationDate']) . '</td>
                </tr>';
            }
            echo '</table>';
        } else {
            echo "Bu dergiye ait cilt bulunamadı.";
        }

        // Close the connection
        $stmt->close();
        $conn->close();
        ?>

        <P>
            <a href="./">Ana sayfaya dön</a>
        </P>

    </body>
</html>
