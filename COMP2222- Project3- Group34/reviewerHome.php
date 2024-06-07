<!DOCTYPE html>
<html>
    <head>
        <title>Reviewer Home Page</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $email = $_POST['email'];

// Fetch articles assigned to the reviewer by email
        $query = "SELECT a.id AS articleID, a.title 
          FROM article a 
          JOIN articlereviews ar ON a.id = ar.id 
          WHERE ar.email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<h1>Articles Assigned to You</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Article ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Title</font></th>
        </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
            <td><a href="article.php?id=' . htmlspecialchars($row['articleID']) . '">' . htmlspecialchars($row['articleID']) . '</a></td>
            <td>' . htmlspecialchars($row['title']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "No articles found for this reviewer.";
        }

// Close the connection
        $stmt->close();
        $conn->close();
        ?>

        <p><a href="reviewer.php">Back to Reviewer Page</a></p>

    </body>
</html>
