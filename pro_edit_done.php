<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>EC-SITE</title>
  </head>
  <body>
      <?php
        try{
          $pro_code=$_POST['code'];  
          $pro_name=$_POST['name'];
          $pro_price=$_POST['price'];

          $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
          $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
          $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');
          
          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn, $user, $password);
          $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = "UPDATE `mst_product` SET name=?, price=? WHERE code=?";
          $stmt = $dbh->prepare($sql);
          $data[] = $pro_name;
          $data[] = $pro_price;
          $data[] = $pro_code;
          $stmt->execute($data);

          $dbh = null;

          print '修正しました。<br />';
        }catch(Exception $e){
            print 'ただいま障害によりご迷惑をお掛けしております。';
            print $e->getMessage ();
            exit();
        }
      ?>

        <a href="pro_list.php">戻る</a>

  </body>
</html>
