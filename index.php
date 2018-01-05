<?php 
  require_once('./button.php');
  include("lib/crawler.php");
  include_once("lib/vncrawler.php");
  include("lib/vxcrawler.php");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Crawler</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
  $test = new Crawler;
  $result = $test->getContents('SELECT * FROM vnn');

  $crawler_sources = array ('vne' => 'VXCrawler','vietnam' => 'VNCrawler');
    if (isset($_POST['gettlink'])) {
        $test->crawl();
      $source = $_POST['check'];

      $test1= new $crawler_sources[$source];
      $test1->get_info();
    }

?>
<div class="container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Crawler</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    </div>
  </div>
</nav>
<div class="form-group">
  <form action="" method="post">
      <label>Nhập link:</label>
      <input type="text" class="form-control" name="getlink">
      <br>
      <label>Nguồn dữ liệu:</label>
      <select class="form-control" name="check">
        <option value="vne">Vnexpress</option>
        <option value="vietnam">Vietnamnet</option>
      </select>
      <br>
      <button class="btn btn-success" type="submit" name="gettlink">GET</button>
      <br>  
  </form>
</div>
<div class="form-group">
  
  <?php 
      if(isset($_POST["savevnn"])){
          $titless = $_POST["savetitvnn"];
          $contentss = $_POST["saveconvnn"];
          $test->save("INSERT INTO vnn (title, content) VALUES ('$titless', '$contentss')");

        header('Location: ./index.php');
      } 
   ?>

  <?php 
      if (isset($_POST['gettlink'])) {
   ?>
<form action="" method="post">
        <label for="usr">Title</label>
        <input type="text" class="form-control" name="savetitvnn" value="<?php echo $test1->tits ?>">
        <label for="usr">Content</label>
        <textarea rows="5" class="form-control" name="saveconvnn"><?php echo $test1->contents ?></textarea>
        <br>
        <button class="btn btn-primary" type="submit" name="savevnn">Lưu data</button>     
        <?php 
          if(isset($msg)){
            echo $msg;
          }
        ?>
  </form>
   <?php 
 }
    ?>
</div>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $key) { ?>
        <tr>
          <td><?= $key['id']?></td>
          <td><?= $key['title']?></td>
          <td><?= $key['content']?></td>
        </tr>
      <?php } ?>    
    </tbody>
  </table>
</div>
</body>
</html>
