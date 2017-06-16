<?php
$pageTitle = 'Albums';
require_once('header.php');
?>

<main class="container">
    <h1>Albums</h1>

    <?php
        if (!empty($_GET['searchTerms']))
            $searchTerms = $_GET['searchTerms'];
        else
            $searchTerms = null;
    ?>

    <form action="albums.php" class="formSpace form-inline">
        <div class="form-group">
            <input class="form-control" name="searchTerms" id="searchTerms"
                value="<?php echo $searchTerms ?>"/>
        </div>
        <button class="btn btn-default">Search</button>
    </form>
    <br />

    <!-- load the albums that match our search terms or all if no search terms are provided-->
    <?php

        //convert the string into array
        if (!empty($searchTerms))
            $searchTerms = explode(" ", $searchTerms);

        //step 1 - connect to the database
        require_once('db.php');

        //step 2 - decide which SQL command to run
        if (empty($searchTerms)) {
            $sql = "SELECT * FROM albums";
            $sqlSearchTerms = null;
        }
        else {
            $sql = "SELECT * FROM albums WHERE";
            $wordCounter = 0;

            foreach ($searchTerms as $searchTerm) {
                $sql .= " artist LIKE ? OR title LIKE ? OR genre LIKE ?";
                $searchTerms[$wordCounter] = "%" . $searchTerm . "%";
                $wordCounter++;

                if ($wordCounter < sizeof($searchTerms))
                    $sql .= " OR ";
            }


            //duplicate the search terms so that at run time, there are
            //enough tokens for the ?'s in the sql statement
            $sqlSearchTerms = array();
            foreach ($searchTerms as $searchTerm) {
                $sqlSearchTerms[] = $searchTerm;
                $sqlSearchTerms[] = $searchTerm;
                $sqlSearchTerms[] = $searchTerm;
            }
        }

        //step 3 - prepare the SQL command
        $cmd = $conn->prepare($sql);

        //step 4 - execute and store the results
        $cmd->execute($sqlSearchTerms);
        $albums = $cmd->fetchAll();

        //step 5 - disconnect from the DB
        $conn = null;

        //create a table and display the results
        echo '<table class="table table-striped table-hover">
            <tr><th>Title</th>
                <th>Year</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Cover Image</th>';

        if (!empty($_SESSION['email'])){
            echo '<th>Edit</th>
                  <th>Delete</th>';
        }

        echo '</tr>';

        foreach($albums as $album)
        {
            echo '<tr><td>'.$album['title'].'</td>
                      <td>'.$album['year'].'</td>
                      <td>'.$album['artist'].'</td>
                      <td>'.$album['genre'].'</td>
                      <td><img height="50" src='.$album['coverFile'].'></td>';

            //only show the edit and delete links if these are valid, logged in users
            if (!empty($_SESSION['email'])){
                echo '<td><a href="AlbumDetails.php?albumID='.$album['albumID'].'"
                                class="btn btn-primary">Edit</a></td>
                      <td><a href="deleteAlbum.php?albumID='.$album['albumID'].'" 
                                class="btn btn-danger confirmation">Delete</a></td>';
            }
            echo '</tr>';
        }

        echo '</table></main>';

        require_once ('footer.php');
    ?>

