
<?php
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
     <!--font awesome-->
  <script src="https://kit.fontawesome.com/c30254e864.js" crossorigin="anonymous"></script>
    <title>Döviz kuru</title>
    <style>
      body{
        background-image: url(360_F_357165707_26OZ4FfKDoOWmlghEiUoY9WRe64Ffe9X.jpg);
        background-repeat: no-repeat;
        background-size: cover;
      }
        input {
  border: 0;
  border-radius: 0.5rem;
  box-shadow: 0 0 0.5rem 0 rgb(0, 0, 0, 0.25) inset;
  
  height: 1.5rem;
  align-items: center;
  padding: 0.5rem;
  
}
label {
  font-size: 1rem;
  margin-right: 0.5rem;
  width: 5rem;
}
.form {
  background-color: white;
  border-radius: 1rem;
  box-shadow: 0 0 0.5rem 0 rgb(0, 0, 0, 0.55);
  display: flex;
  flex-direction: column;
  padding: 5%;
  width: 35rem;
  margin: auto;
  margin-top: 17rem;
}
.input-field {
  align-items: center;
  display: flex;
  flex: 1 1 auto;
  flex-wrap: wrap;
  margin: 0.5rem;
}
input[type="submit"] {
  background-color: white;
  cursor: pointer;
  display: flex;
  flex-grow: 0;
  font-size: 1rem;
  font-weight: bold;
  height: auto;
  justify-content: center;
  margin: 0 auto;
  padding: 0.5em;
  width: 75%;
  
}
    </style>
</head>
<body>
    <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    //
    $doviz;
    $tl = $_POST["Dolar"];
    $connect_web = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/today.xml');
    $usd_buying = $connect_web->Currency[0]->BanknoteBuying;
    $usd_selling = $connect_web->Currency[0]->BanknoteSelling;
    $euro_buying = $connect_web->Currency[3]->BanknoteBuying;
    $euro_selling = $connect_web->Currency[3]->BanknoteSelling;
    $bgn_buying = $connect_web->Currency[12]->BanknoteBuying;
    $bgn_selling = $connect_web->Currency[12]->BanknoteSelling;

    
    //
    //$jsonVeri=file_get_contents("https://finans.truncgil.com/today.json");
    //$veri=json_decode($jsonVeri,1);
    //echo $veri["EURO"]["Alış"];
    //echo $veri["EURO"]["Satış"];

    ?>
    <!--<div class="container">
        <div class="row">
        <div class="col-md-12">
        <form method="POST" action="doviz.php">
          <input type="text" name="tl" id="tl">
          <input type="submit">
         
          </form>
        </div>
        </div>
    </div> -->
    
    <div class="form">
    
        <form action="doviz.php" method="POST" id="doviz">
        <?php
 
          if (!isset($_SESSION["usd"])) {
            $_SESSION["usd"]=0;  //Değişken tanımlı mı diye tersine bakar
          }
          if (!isset($_SESSION["euro"])) {
            $_SESSION["euro"]=0; //Değişken tanımlı mı diye tersine bakar
          }
        if ($euro_buying >= $_SESSION["euro"]) {
          $_SESSION["euro"]= $euro_buying;
          echo '<i class="fas fa-euro-sign"></i>'."Euro=".$euro_buying.'<i class="fas fa-angle-up" style="color:green; font-size: 20px;"></i>'."&nbsp; &nbsp;";
        }else {
          echo '<i class="fas fa-euro-sign"></i>'."Euro=".$euro_buying.'<i class="fas fa-angle-down" style="color:red; font-size: 20px;"></i>'." &nbsp; &nbsp;";
        }if ($usd_buying >= $_SESSION["usd"]) {
          $_SESSION["usd"]= $usd_buying;
          echo '<i class="fas fa-dollar-sign"></i>'."USD=".$usd_buying.'<i class="fas fa-angle-up" style="color:green; font-size: 20px;"></i>';
        }else {
          echo '<i class="fas fa-dollar-sign"></i>'."USD=".$usd_buying.'<i class="fas fa-angle-down" style="color:red; font-size: 20px;"></i>';
        }
        ?>
        
        <div class="row">
            <div class="input-field">
                <h1>Döviz hesaplama</h1>
                <label for="first-name">Dolar</label>
               <input type="text" id="Dolar" name="Dolar">
              
            </div>
            <div class="input-field">
              <label for="surname">Türk lirası</label>
              <?php  
               echo  $doviz = $tl * $usd_selling;

              ?>
            </div>
            <div class="input-field">
                <input type="submit" id="buton" value="Hesapla">
            </div>
          </div>
        </form>
    </div>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
  integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
  integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
  crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script>
    [syntax type=”js”]var = new XMLHttpRequest();[/syntax]//request oluşturma
    $(document).ready(function(){
      $($connect_web){//
        var doviz=$("#doviz").serialize();// idsi gonderilenform olan formun içindeki tüm elemanları serileştirdi ve gonderilenform adlı değişken oluşturarak içine attı
        $.ajax({
          url:'ajax.php', // serileştirilen değerleri ajax.php dosyasına
          type:'POST', // post metodu ile 
          data: doviz //yukarıda serileştirdiğimiz doviz değişkeni
          success:function(e){ // gonderme işlemi başarılı ise e değişkeni ile gelen değerleri aldı
            $("div").html("").html(e); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
			}
          }
        })
      })
    })
    </script>
    <script>
      
            $(document).ready(function(){
                var interval = 0;
                setInterval(function(){
                    //interval ++;
                    $($connect_web).html(interval);
                },1000); //her bir saniyede yenileme yapar
            });
            
           
        </script>
</body>
</html>