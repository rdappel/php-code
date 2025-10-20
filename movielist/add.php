<?php
// remember to fix nav and add "Add movie" link to index
// move dbconnect to includes


if (!empty($_GET['txtTitle']) && !empty($_GET['txtRating'])) {

    $txtTitle = $POST['txtTitle'];
    $txtRating = $POST['txtRating'];

    include "includes/db.php";
    /** @var mysqli $con */

    try {
        $query = "INSERT INTO movielist (movieTitle, movieRating) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ss", $txtTitle, $txtRating);

        header("Location:index.php");
    }
    catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}

?>


<html>
    <head>
        <style>
.grid-header { grid-area: 'grid-header' }
.movie-title { grid-area: 'movie-title' }
.title-input { grid-area: 'title-input' }
.movie-rating { grid-area: 'movie-rating' }
.rating-input { grid-area: 'rating-input' }
.grid-footer { grid-area: 'grid-footer' }


.grid-container {
    display: grid;
    grid-template-areas:
        'grid-header grid-header'
        'movie-title title-input'
        'movie-rating rating-input'
        'grid-footer grid-footer'
    ;
    border: 1px solid black;
    padding: 0;
}

.grid-container div {
    border: 1px solid black;
    text-align: center;
    padding: 15px 0;
    font-size: 1.1rem;
}

        </style>
    </head>
    <body>
        <main>
            <form method="get">
                <div class="grid-container">
                    <div class="grid-header"><h3>Add new movie:</h3></div>

                    <div class="movie-title">
                        <label for="txtTitle">Movie Title</label>
                    </div>
                    <div class="title-input">
                        <input type="text" name="txtTitle" id="txtTitle">
                    </div>

                    <div class="movie-rating">
                       <label for="txtRating">Movie Rating</label> 
                    </div>
                    <div class="rating-input">
                        <input type="text" name="txtRating" id="txtRating">
                    </div>

                    <div class="grid-footer">
                        <input type="submit" value="Add movie">
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>