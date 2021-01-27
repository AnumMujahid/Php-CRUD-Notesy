<?php
include_once("config/config.php");
$result = mysqli_query($mysqli, "select * from note order by id desc;");
require("partials/header.php");
?>   

<?php
if(isset($_POST['add'])){

    $title = mysqli_real_escape_string($mysqli, $_POST['title']);
    $detail = mysqli_real_escape_string($mysqli, $_POST['detail']);
    if(empty($title)||empty($detail)){
        if(empty($title)){
            echo"<div class='alert alert-danger' role='alert'>Title field is empty!</div>";
        }
        if(empty($detail)){
            echo"<div class='alert alert-danger' role='alert'>Description field is empty!</div>";
        }
    }else{
        $result = mysqli_query($mysqli, "insert into note(title, detail) values('$title','$detail');");
        echo"<div class='alert alert-success' role='alert'>New note added successfully!</div>";
        $result = mysqli_query($mysqli, "select * from note order by id desc;");
    }
}
?>

<?php
if(isset($_GET['search'])){

    $search_string = mysqli_real_escape_string($mysqli, $_GET['string']);
    if(empty($search_string)){
            echo"<div class='alert alert-danger' role='alert'>Search field is empty!</div>";
    }else{
        $result = mysqli_query($mysqli, "SELECT * FROM note WHERE CONCAT(title, '', detail) LIKE '%$search_string%'");
    }
}
?>

    <div class="container mt-5 px-0">
        <form action= "index.php" method="POST">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Type title here">
            </div>
            <div class="form-group">
                <label for="detail">Description</label>
                <textarea class="form-control" id="detail" rows="3"
                    placeholder="Type description here" name="detail"></textarea>
            </div>
            <button type="submit" class="btn btn-dark" value="add" name="add">Add</button>
        </form>
    </div>

    <div class="container my-5">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40; width: 100%;">
            <a class="navbar-brand" href="#">Notes</a>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0" action = "index.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="string">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="search" value="search">Search</button>
                </form>
            </div>
            </nav>
        </div>

        <?php
        while ($res = mysqli_fetch_array($result)){
            echo "<div class='row card d-flex flex-row'>";
            echo "<div class='col-12 col-md-8 col-lg-9 mt-3'>
                ".$res[title]."
            </div>
            <div class='col-12 col-md-4 col-lg-3 mt-2 d-flex justify-content-end'>
                <button type='submit' class='btn btn-dark mr-2'><a href=\"edit.php?id=$res[id]\">Edit</a></button>
                <button type='submit' class='btn btn-dark'><a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></button>
            </div>
            <div class='col-12'>
                <hr>
            </div>
            <div class='col-12 mb-3'>
                ".$res[detail]."
            </div>";
            echo "</div>";
        }
        $mysqli->close();
        require("partials/footer.php");
        ?>
    </div>