<!DOCTYPE html>
<html>
    <head>
        <title>Author Home Page</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';

        $email = $_POST['email'];

// Fetch articles submitted by the author by email
        $query = "SELECT a.id AS articleID, a.title, a.status, a.secondSubmissionDeadline, v.name AS volumeName 
          FROM article a 
          JOIN volume v ON a.volid = v.id 
          WHERE a.correspAut = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<h1>Your Articles</h1>';
            echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr>
            <th><font face="Arial, Helvetica, sans-serif">Article ID</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Title</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Volume</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Status</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Second Submission Deadline</font></th>
        </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
            <td>' . htmlspecialchars($row['articleID']) . '</td>
            <td>' . htmlspecialchars($row['title']) . '</td>
            <td>' . htmlspecialchars($row['volumeName']) . '</td>
            <td>' . htmlspecialchars($row['status']) . '</td>
            <td>' . htmlspecialchars($row['secondSubmissionDeadline']) . '</td>
        </tr>';
            }
            echo '</table>';
        } else {
            echo "No articles found for this author.";
        }

// Close the connection
        $stmt->close();
        $conn->close();
        ?>

        <p><a href="author.php">Back to Author Page</a></p>

    </body>
</html>
