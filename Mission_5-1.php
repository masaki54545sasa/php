<html>
<link rel="stylesheet" href="btn-square.css">
<h1>掲示板</h1>
<?php
class Form
{
    private $dsn, $user, $password,$pdo;
    // DB接続設定////////////////////
    public function __construct()
    {
        $this->dsn = "xxxx";
        $this->user = "xxxx";
        $this->password = "xxxx";
        $this->pdo = new PDO($this->dsn, $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }
    ////////////////////////////////   
    public function create_sql($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS tb3"
            . " ("
            . "id INT AUTO_INCREMENT PRIMARY KEY,"
            . "name char(32),"
            . "comment TEXT,"
            . "datetime TEXT,"
            . "password TEXT"
            . ");";
        $stmt = $pdo->query($sql);
    }
    public function show_items($pdo, $id,$sql)
    {
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll();
        $r = [];
        foreach ($results as $row) {
            //$rowの中にはテーブルのカラム名が入る  
            array_push($r, $row['id']);
            array_push($r, $row['name']);
            array_push($r, $row['comment']);
            array_push($r, $row['password']);
            array_push($r, $row['datetime']);
            //echo "<hr>";
        }
        return $r;
    }
    public function delete_sql($pdo, $id)
    {
        //$id = 2; // idがこの値のデータだけを抽出したい、とする
        $sql = 'DELETE from tb3 WHERE id=:id';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();
    }
    public function add_sql($pdo, $name, $comment, $datetime, $p)
    {
        $sql = $pdo->prepare("INSERT INTO tb3 (name, comment, datetime, password) VALUES (:name, :comment, :datetime, :password)");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $sql->bindParam(':password', $p, PDO::PARAM_STR);
        $sql->execute();
    }

    public function update_sql($pdo, $i)
    {
        $id = $i; // idがこの値のデータだけを抽出したい、とする
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $datetime = date('Y-m-d G:i:s');
        $sql = 'UPDATE tb3 SET name=:name,comment=:comment,datetime=:datetime WHERE id=:id';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
        $stmt->execute(); // ←SQLを実行する。
    }

    //編集
    public function main()
    {
        $this->create_sql($this->pdo);
        if (isset($_POST["submit"])) {
            if (!empty($_POST["hidden"])) {
                $sql = 'SELECT * FROM tb3 WHERE id=:id ';
                $r = $this->show_items($this->pdo, $_POST["hidden"],$sql);
                if (pass_check($_POST["password"], $r[3])) {
                    $this->update_sql($this->pdo, $_POST["hidden"]);
                    $result = "編集成功！" . "<br>";
                }
                //データベース編集
                else {
                    $result = "Password is wrong" . "<br>";
                }
                //ファイルの書き込み
                echo $result;
            }
            //新規書き込み
            else {
                //データベース書き込み
                $date_time = date('Y-m-d G:i:s');
                $this->add_sql($this->pdo, $_POST["name"], $_POST["comment"],  $date_time, $_POST["password"]);
                echo "書き込み成功！" . "<br>";
            }
        } elseif (isset($_POST["delete"])) {
            //$number = $_POST["number"];
            $r = show_items($this->pdo, $_POST["number"]);
            if (pass_check($_POST["password"], $r[3])) {
                $this->delete_sql($this->pdo, $_POST["number"]);
                $d_result = "消去完了" . "<br>";
            } else {
                $d_result = "Password is wrong" . "<br>";
            }
            echo $d_result;
        } elseif (isset($_POST["edit"])) {
            $sql = 'SELECT * FROM tb3 WHERE id=:id ';
            $l = $this->show_items($this->pdo, $_POST["number"],$sql);
            $hidden = $l[0];
            $renumber = $l[0];
            $rename = $l[1];
            $recomment = $l[2];
            $p_pass = $l[3];
        }
    }
    public function pass_check($in_pass, $pass)
    {
        //echo strlen($in_pass).strlen($pass);
        if (strcmp($in_pass, $pass) == 0) {
            return True;
        } else {
            return false;
        }
    }
    
}
$main = new Form();
$main->main();
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
                                                            if (!isset($pw)) {
                                                                $pw;
                                                            } else {
                                                                echo $pw;
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


</form><br>
<br>
<?php
$dsn = 'mysql:dbname=tb221018db;host=localhost';
$user = 'tb-221018';
$password = 'QQjau7DgAF';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = 'SELECT * FROM tb3';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['datetime'].'<br>';
	    echo "<hr>";
	}
?>

</html>