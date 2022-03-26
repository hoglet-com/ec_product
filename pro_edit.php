<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>EC-SITE</title>
  </head>
  <body>
      <?php
        try{

            // pro_listでのprocodeを受け取っている
            $pro_code=$_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 商品コードで絞り込みます
            $sql='SELECT * FROM mst_product WHERE code=?';
            //クエリー作成
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_code;
            //プレースホルダに値をセットし、SQL文を実行
            $stmt->execute($data);

            //$pro_nameにDBに保存されているnameを格納している
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name=$rec['name'];
            $pro_price=$rec['price'];

            $dbh=null;

        }catch(Exception $e){
            print 'ただいま障害によりご迷惑をお掛けしております。';
            print $e->getMessage ();
            exit();
        }
      ?>

        商品修正<br/>
        <br/>
        商品コード<br/>
        <?php print $pro_code; ?>
        <br/>
        <br/>
        <form method="POST" action="pro_edit_check.php">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>">
        商品名<br/>
        <input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br/>
        価格<br/>
        <input type="text" name="price" style="width:200px" value="<?php print $pro_price; ?>">円<br/>
          <br />
          <input type="button" onclick="history.back()" value="戻る">
          <input type="submit" value="OK">
      </form>
  </body>
</html>
