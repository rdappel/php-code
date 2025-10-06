<script>
    /*
    Data Source: MySql -> MySql
    Download missing driver files
    ---

    Name: Database Server
    Host: 10.7.66.XX
    Auth: User & PW
    User: dbuser
    Password: dbdev123
    Database: phpclass

    OK

    -----

    Right-click > New > Table
    Name: movielist
        MovieID (int autoinc)
        MovieTitle: (varchar 50)
        MovieRating: (varchar 5)
    (Set MovieID to PK)
    */
</script>

<main>
	<h2>My Movie List</h2>

    <?php
try {

    function getConnection() {
        $con = mysqli_connect("localhost", "dbuser", "dbdev123");
        mysqli_select_db($con, "phpclass");
        return $con;
    }

    $con = getConnection()

    $results = mysqli_query("SELECT * FROM movielist");

    while ($row = mysqli_fetch_array($results)) {

        $movieID = $row['MovieID'];
        $movieTitle = $row['MovieTitle'];
        $movieRating = $row['MovieRating'];

        echo "<tr>";
        echo "    <td>$movieID</td>";
        echo "    <td>$movieTitle</td>";
        echo "    <td>$movieRating</td>";
        echo "</tr>";
    }
}
catch (mysqli_sql_exception ex) {
    echo $ex;
}

}

    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Rating</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Dune Part 1</td>
            <td>PG-13</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Tron</td>
            <td>PG-13</td>
        </tr>
    </table>
</main>