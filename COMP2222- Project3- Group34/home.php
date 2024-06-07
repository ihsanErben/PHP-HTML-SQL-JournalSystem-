<html>
    <head>
        <title>All Journals</title>
    </head>
    <body>

        <?php
        include './databaseConnection.php';
        $query = "select name,frequency from journal";
        $result = mysqli_query($conn, $query);
        mysqli_close($conn);
        ?>


        <table border="2" cellspacing="2" cellpadding="2">
            <tr>
                <th><font face="Arial, Helvetica, sans-serif">Journal Name</font></th>
                <th><font face="Arial, Helvetica, sans-serif">Frequency</font></th>
            </tr>

            <?php
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["name"];
                $frequency = $row["frequency"];
                ?>

                <tr>
                    <td>
                        <a href="viewVolumes.php?name=<?php echo $name; ?>"><?php echo $name; ?></a></td>
                    <td><?php echo $frequency; ?></td>
                </tr>

                <?php
            }
            ?>

        </table>

        <br><br>

        <table border="1">
            <tr>
                <td>
                    <a href="editor.php">Ciltler Sayfası</a> 
                </td>
            </tr>

            <tr>
                <td>
                    <a href="reviewer.php">Rewiever Sayfası</a>
                </td>
            </tr>

            <tr>
                <td>
                    <a href="author.php">Author Sayfası</a>
                </td>
            </tr>

        </table>

        <P>
            <a href="./">Return to main page</a>

    </body>
</html>
