<html>
    <head>
        <title>Lab 6</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php
        
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
        <div class="conatainer ml-3 mr-3">
        <?php
            $mysqli = new mysqli('kylin', 'miroslav', 'Stronghold666!', 'Library_db') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM Library_table") or die($mysqli->error);  
            //pre_r($result);
            ?>
        
            <div class="row justify-contetn-center">
                <table class ="table">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Bookname</th>
                            <th>Abstractname</th>
                            <th>ISBN</th>
                            <th>Review</th>
                            <th colspan="2"> Action </th>
                    </thead>
                <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['bookname']; ?></td>
                            <td><?php echo $row['abstractname']; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td><?php echo $row['review']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id'] ?>"
                                class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id'] ?>"
                                class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php endwhile; ?>
                </table>
            </div>
            <?php

            function pre_r ($array) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center"> 
        <form action="process.php" method="POST">
            <input type="hidden"name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" 
                    value="<?php echo $author; ?>" class="form-control"  placeholder="Enter author">
            </div>
            <div class="form-group">
            <label>Bookname</label>
            <input type="text" name="bookname" 
                    value="<?php echo $bookname; ?>"class="form-control" placeholder="Enter bookname">
            </div>
            <div class="form-group">
            <label>Abstractname</label>
            <input type="text" name="abstractname" 
                    value="<?php echo $abstractname; ?>"class="form-control" placeholder="Enter abstractname">
            </div>
            <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" 
                    value="<?php echo $isbn; ?>" class="form-control" placeholder="Enter isbn">
            </div>
            <div class="form-group">
            <label>Review</label>
            <input type="text" name="review" 
                    value="<?php echo $review; ?>" class="form-control" placeholder="Enter review"></input>
            </div>
            <div class="form-group">
            <?php 
            if ($update == true):
            ?>
                <button type="submit" class="btn btn-info" name="update">update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
    </div>
    </body>
</html>
