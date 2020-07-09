<?php
$submitPressed = filter_input(INPUT_POST, 'submit');
if (isset($submitPressed)){
    $name = filter_input(INPUT_POST, 'name');
    $link = mysqli_connect('localhost','root','','pw1872042',
        '3306') or die(mysqli_connect_error());
    $query = "INSERT INTO category(name) VALUES(?)";
    mysqli_autocommit($link, false);
    if($stmt = mysqli_prepare($link, $query)){
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt) or die (mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<form action="" method="POST">
    <p>
        <label for="catId">Name  :  </label>
        <input type="text" name="name" placeholder="Insert Name" />
    </p>
    <p>
        <input style="padding: 8px 12px;" type="submit" name="submit" value="Send"/>
    </p>
</form>
<table border="1">
    <thead>
        <tr>
            <thead>ID</thead>
            <thead>Name</thead>
        </tr>
    </thead>
    <tbody>
    <?php

    $link = mysqli_connect('localhost','root','','pw1872042',
        '3306') or die(mysqli_connect_error());

    $query = 'SELECT * FROM category';
    if ($result = mysqli_query($link, $query) or die(mysqli_error($link))){
        while ($row = mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>' . $row['id']  . '</td>' ;
            echo '<td>' . $row['name'] . '</td>' ;
            echo '</tr>';
        }
        mysqli_close($link);
    }

    ?>
    </tbody>
</table>
