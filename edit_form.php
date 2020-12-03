<html>
     <h2>edit form</h2>
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
        
        <input type="submit" name="edit" value="edit">

    </form>
    
</html>
