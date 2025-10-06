<?
// add link to "Add new movie" in index.php

    if (!empty($_POST['txtTitle']) && !empty($_POST['txtRating'])) {
        // include db

        $query = "INSERT INTO movielist (movieTitle, movieRating) VALUES (?, ?)";

        
    }

?>

<style>

.grid-header { grid-area: grid-header; }
.movie-title { grid-area: movie-title; }
.title-input { grid-area: title-input; }
.movie-rating { grid-area: movie-rating; }
.rating-input { grid-area: rating-input; }
.grid-footer { grid-area: grid-footer; }

.gc {
    display: grid;
    /* grid-template-areas: none; */
    grid-template-areas:
        'grid-header grid-header'
        'movie-title title-input'
        'movie-rating rating-input'
        'grid-footer grid-footer'
}

.gc div {
    border: 1px solid black;
}



</style>


<main>
    <form method="get">
        <div class="gc">
            <div class="grid-header"><h3>Add a New Movie:</h3></div>
            <div class="movie-title">Movie Title</div>
            <div class="title-input">
                <intut type="text" name="txtMovie" id="txtMovie">
            </div>
            <div class="movie-rating">Movie Rating</div>
            <div class="rating-input">
                <intut type="text" name="txtRating" id="txtRating">
            </div>
            <div class="grid-footer">
                <input type="submit" value="Add a New Movie">
            </div>
        </div>
    </form>
</main>