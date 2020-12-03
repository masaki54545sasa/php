<html>
<link rel="stylesheet" href="btn-square.css">
<h1>掲示板</h1>
<?php
$filename = "mission_3-1.txt";
$fp = fopen($filename, "a");
//編集
if (isset($_POST["submit"])) {
    //$num=$_POST["hidden"];
    //echo $num;
    if (!empty($_POST["hidden"])) {
        $list = f_list($filename);
        //var_dump()
        foreach ($list as &$value) {
            $split_list = explode("<>", $value);
            $n = strlen($_POST["password"]) + 1;
            //$m=strlen($split_list[4]);
            //echo $n.$m;
            if ($split_list[0] == $_POST["hidden"]) {
                if ($n == strlen($split_list[4])) {
                    //echo $split_list[4];
                    $value = $_POST["hidden"] . "<>" . $_POST["name"] . "<>" . $_POST["comment"] . "<>" . date("Y年m月d日 H時i分s秒") . "<>" . $_POST["password"] . "\n";
                    $result = "編集成功！" . "<br>";
                }
            }
        }
        if (!isset($result) or empty($_POST["password"])) {
            $result = "Password is wrong" . "<br>";
        }
        //ファイルの書き込み
        file_put_contents($filename, $list);
        fclose($fp);
        $hidden = "";
        echo $result;
    }
    //書き込み
    else {
        $max = read($filename);
        fwrite($fp, $max . "<>" . $_POST["name"] . "<>" . $_POST["comment"] . "<>" . date("Y年m月d日 H時i分s秒") . "<>" . $_POST["password"] . "\n");
        fclose($fp);
        echo "書き込み成功！" . "<br>";
    }
} elseif (isset($_POST["delete"])) {
    $number = $_POST["number"];
    $filename = "mission_3-1.txt";
    $fp = fopen($filename, "a");
    //ファイルの内容を配列に格納する
    $list = file($filename);
    foreach ($list as &$value) {
        $split_list = explode("<>", $value);
        //echo $split_list[4];
        if ($split_list[0] == $number) {
            $n = strlen($_POST["password"]) + 1;
            $m = strlen($split_list[4]);
            echo $n . $m;
            //echo $split_list[4];
            if ($n == $m) {
                //指定した要素を削除する
                $value = "";
                echo "delete Complete";
            }
            /*else{
                    echo "Password is wrong";
                }*/
        }
    }
    //ファイルの書き込み
    file_put_contents($filename, $list);
    fclose($fp);
} elseif (isset($_POST["edit"])) {

    $list = f_list($filename);
    //var_dump()
    foreach ($list as &$value) {
        $split_list = explode("<>", $value);
        if (explode("<>", $value)[0] == $_POST["number"]) {
            //echo $value;
            //echo 1;
            $hidden = $split_list[0];
            $renumber = $split_list[0];
            $rename = $split_list[1];
            $recomment = $split_list[2];
        }
    }
    //echo $rename;
    fclose($fp);
}
function f_list($filename)
{
    $fp = fopen($filename, "a");
    //ファイルの内容を配列に格納する
    $list = file($filename);
    return $list;
}
function read($filename)
{
    $max = 0;
    $list = file($filename);
    foreach ($list as $value) {
        if ($max < $value) {
            $max = explode("<>", $value)[0];
        }
    }
    //echo $max."<br>";
    $max = intval($max) + 1;
    echo "行数:" . $max . "<br>";
    return $max;
}
?>
<form action="" method="POST">
    <input type="hidden" name="hidden" value="<?php
                                                if (!isset($hidden)) {
                                                    $hidden;
                                                } else {
                                                    echo $hidden;
                                                }
                                                ?>"><br>
    name:<br><input type="text" name="name" value="<?php
                                                    if (!isset($rename)) {
                                                        $rename;
                                                    } else {
                                                        echo $rename;
                                                    } ?>"><br>
    password:<br><input type="text" name="password" value="<?php
                                                            if (!isset($password)) {
                                                                $password;
                                                            } else {
                                                                echo $password;
                                                            } ?>">
    <br>
    comment:<br><textarea name="comment" rows="4" cols="40"><?php
                                                            if (!isset($recomment)) {
                                                                $recomment;
                                                            } else {
                                                                echo $recomment;
                                                            } ?></textarea>
    <br>
    <input type="submit" name="submit" value="submit">
</form>

<a href="delete_form.php" class="btn-square">delete form </a>
<a href="edit_form.php" class="btn-square">edit form </a>


</form>

</html>
