<html>
 <h2>form delete</h2>
     <form action="Mission_3-5.php" method="post">
        <p>
        <select name="number">
        <?php
        for($number = 1; $number <= 50; $number = $number + 1) {
            echo '<option value="', $number, '">', $number, '行</option>';
        }
        ?>
        </select>
        </p>
        password:<br><input type="text" name="password" value="<?php 
        if(empty($password)){
            $password;
        }
        else{
         echo $password;
         }?>">

        <input type="submit" name="delete" value="ok">

    </form>
    </html>
