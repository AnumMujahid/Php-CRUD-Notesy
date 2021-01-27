<?php
include_once("config/config.php");
if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);	
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
        $result = mysqli_query($mysqli, "UPDATE note SET title='$title', detail='$detail' WHERE id=$id;");
        echo"<div class='alert alert-success' role='alert'>New note added successfully!</div>";
        $mysqli->close();
        header("Location: index.php");
    }
}
?>

<?php
$id = $_GET['id'];
$result = mysqli_query($mysqli, "select * from note where id = $id");
while($res=mysqli_fetch_array($result)){
    $title = $res['title'];
    $detail = $res['detail'];
}
$mysqli->close();
?>

<?php
require("partials/header.php");
?>
    <div class="container mt-5 px-0">
        <form action= "edit.php" method="POST">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input name="title" type="text" class="form-control" id="title" value="<?php echo $title;?>">
            </div>
            <div class="form-group">
                <label for="detail">Description</label>
                <textarea class="form-control" id="detail" rows="3"
                    placeholder="<?php echo $detail; ?>" name="detail"></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <button type="submit" class="btn btn-dark" value="update" name="update">Edit</button>
        </form>
    </div>

<?php
require("partials/footer.php");
?>