<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', 'password', 'idea');
$err = 0;
if(isset($_POST[btn])){
    if($_POST[login] != ''){
        if($_POST[pass] != ''){
            $logge = mysqli_query($connection, "SELECT * FROM `accaunts` WHERE `login` = '$_POST[login]'");
            if(($ac = mysqli_fetch_assoc($logge))){
                if($ac[password] == $_POST[pass]){
                    $_SESSION[accaunt] = $_POST[login];
                   $err = 4;
                }else{
                  $err = 1;
                }
            }else{
                mysqli_query($connection, "INSERT INTO `accaunts` (`login`, `password`) VALUES ('$_POST[login]', '$_POST[pass]')");
                $err = 2;
                $_SESSION[accaunt] = $_POST[login];
            }
        }else{
            $err = 3;
        }
    }else{
        $err = 3;
    }
}
if(isset($_POST[btnsend])){
    if($_SESSION[accaunt] != NULL){
    if($_POST[name] != ''){
        if($_POST[text] != ''){
            $img = NULL;
            if(empty($_FILES['img']['tmp_name'])){

            }else{
               
               
                if(!empty($_FILES['img']['tmp_name'])){
                   
                    $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
                    
                }
                
                
            }
            mysqli_query($connection, "INSERT INTO `posts` (`name`, `info`, `img`, `login`) VALUES ('$_POST[name]', '$_POST[text]', '$img', '$_SESSION[accaunt]')");
            $err = 5;
        }else{
            $err = 3;
        }
    }else{
        $err = 3;
    }

}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,900&display=swap" rel="stylesheet">
    <title>Idea</title>
</head>
<body>
<div id="bg">
    
            <img id="im" src="img/like.png" alt=""><br>
            <a class="likes"></a>
        </div>
    <div id="center">
       <div id="menu"><br>
       <?php
            if($_SESSION[accaunt] == NULL){
?>
 <a id="meco"><img width="50px" onclick="login()" src="img/login.png" alt=""></a>
 <a id="meco"><img width="50px" src="img/find.png" alt=""></a>
<?php
            }else{
       ?>   <?php echo $_SESSION[accaunt]; ?><br>
            <a id="meco"><img width="50px" src="img/accaunt.png" alt=""></a>
            <a id="meco"><img width="50px" src="img/like.png" alt=""></a>
            <a id="meco"><img width="50px" onclick="ne()" src="img/plus.png" alt=""></a>
            <a id="meco"><img width="50px" src="img/find.png" alt=""></a>
            <a href="out.php" id="meco"><img width="50px" src="img/out.png" alt=""></a>
            <?php
            }
            ?>
            
           
       </div>
    <div id="card">
    <div id="top">
    <a id="acc">Аккаунт</a> 
</div>
<div id="bottom">
<h1 id="name">Свайпайте по инструкции ниже</h1>
</div>
       
       
    </div>
    <div id="info">
        <div id="info-content">
            ⬅ Далее<br>
            ➡ Лайк<br>
            ⬇ Меню<br>
            ⬆ Подробнее
        </div>
        <div id="info-content">
            <a class="tag" id="grey"></a>
        </div>
    </div>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $( "#menu" ).hide();
    var id = "un";
    var menu = 0;
   const windowInnerWidth = document.documentElement.clientWidth
const windowInnerHeight = document.documentElement.clientHeight
var likes = "";
      var views = "";
    function detectswipe(el,func) {
      swipe_det = new Object();
      swipe_det.sX = 0;
      swipe_det.sY = 0;
      swipe_det.eX = 0;
      swipe_det.eY = 0;
      
      var obx = 0;
      var oby = 0;
      var min_x = 20;  //min x swipe for horizontal swipe
      var max_x = 40;  //max x difference for vertical swipe
      var min_y = 100;  //min y swipe for vertical swipe
      var max_y = 150;  //max y difference for horizontal swipe
      var direc = "";
      ele = document.getElementById(el);
      ele.addEventListener('touchstart',function(e){
        var t = e.touches[0];
        swipe_det.sX = t.screenX; 
        swipe_det.sY = t.screenY;
        
      },false);
      ele.addEventListener('touchmove',function(e){
        e.preventDefault();
        var t = e.touches[0];
        swipe_det.eX = t.screenX; 
        swipe_det.eY = t.screenY;   
        obx = swipe_det.eX - swipe_det.sX;
        oby = swipe_det.eY - swipe_det.sY;
        $( "#card" ).css( "left", obx * 2 + "px" );
        
        $( "#card" ).css( "top", oby / 5 + "px" );
        $( "#card" ).css( "transform", "rotate(" + obx / 10 + "deg)");
        if(oby < 0 || obx < -50 || obx > 50)
        $( "#info" ).css( "top", oby * 2 + "px" );
        $( "#info" ).css( "right", obx / 3 + "px" );
        if(obx < 0){
            $( "#bg" ).html(' <img id="im" src="img/next.png" alt=""><br><a class="views">' + views + '</a>');
        }else{
            $( "#bg" ).html(' <img id="im" src="img/like.png" alt=""><br><a class="likes">' + likes + '</a>');
        }
        
      },false);
      ele.addEventListener('touchend',function(e){
         if(obx != 0 || oby != 0){
            if(oby < 0 || obx < -50 || obx > 50)
            if(obx < 0){
                $( "#card" ).animate({left:-1000},300);
            }else{
                $( "#card" ).animate({left:1000},300);
            }
        $( "#info" ).animate({top:1000},300);
           
//ЗАГРУЗКА КОТЕНТА

if(Math.abs(obx) > 100)
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'getid'},
      success: function(data){  
          if(data == 'all'){
            id = "un";
            $('#acc').html("Всё!");
            $('#name').html("Похоже вы добрались до конца!");
            $('#info-content').html("Вы просмотрели ВСЁ что есть на сайте! Время передохнуть.");
            $('.likes').html("0");
       likes = "0";
       $('.views').html("0");
        views = "0";
        $('.tag').html("");
          }else{
        id = data;
        $.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "accaunt"},
      success: function(data1){  
        $('#acc').html(data1);
       
	}
});

$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "name"},
      success: function(data1){  
        $('#name').html(data1);
       
	}
});

$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "info"},
      success: function(data1){  
        $('#info-content').html(data1);
       
	}
});

$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "likes"},
      success: function(data1){  
        $('.likes').html(data1);
       likes = data1;
	}
});

$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "views"},
      success: function(data1){  
        $('.views').html(data1);
        views = data1;
	}
});
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'get',
             id: data,
             what: "tags"},
      success: function(data1){  
        $('.tag').html(data1);
       
	}
});
}
	}
    
});

            $( "#card" ).animate({left:0},300);
        $( "#card" ).animate({top:0},300);
        $( "#card" ).css( "transform", "rotate(" + 0 + "deg)");
        $( "#info" ).animate({top:0},300);
        $( "#info" ).animate({right:0},300);
        
          }
       
        //horizontal detection
        if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y)))) {
          if(swipe_det.eX > swipe_det.sX && Math.abs(obx) > Math.abs(oby)) direc = "r";
          else if(Math.abs(obx) > Math.abs(oby)){
              direc = "l";
        }
        }
        //vertical detection
        if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {
          if(swipe_det.eY > swipe_det.sY && Math.abs(obx) < Math.abs(oby) && oby > 10) direc = "d";
          else if(Math.abs(obx) < Math.abs(oby)){
              direc = "u";
          }
        }
    
        if (direc != "") {
          if(typeof func == 'function') func(el,direc);
        }
        direc = "";
      },false);  
    }

    function myfunction(el,d) {
     if(d == "l"){
        console.log("next");
        $.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'next',
             id: id},
      success: function(data1){  
        $('.tag').html(data1);
       
	}
});
        $( "#menu" ).hide();
    menu = 0;
     }
     if(d == "r"){
        console.log("like");
        $.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'like',
             id: id},
      success: function(data1){  
        $('.tag').html(data1);
       
	}
});
        $( "#menu" ).hide();
    menu = 0;
     }
     if(d == "u"){
        //$('body,html').animate({scrollTop:windowInnerWidth},100);
        $( "#menu" ).hide();
    menu = 0;
     }
     if(d == "d"){
        if(menu){
            $( "#menu" ).hide();
            menu = 0;
        }else{
            $( "#menu" ).show();
            menu = 1;
        }
     }
    }



    detectswipe('card',myfunction);
function ne(){
    $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        id = "un";
        $.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'new',
             what: 'name'},
      success: function(data){  
        $('#name').html(data);
       
	}
});
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'new',
             what: 'accaunt'},
      success: function(data){  
        $('#acc').html(data);
       
	}
});
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'new',
             what: 'info'},
      success: function(data){  
        $('#info-content').html(data);
       
	}
});
$('.tag').html("");
likes = 0;
views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
}
    function login(){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        id = "un";
        $.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'login',
             what: 'name'},
      success: function(data){  
        $('#name').html(data);
       
	}
});
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'login',
             what: 'accaunt'},
      success: function(data){  
        $('#acc').html(data);
       
	}
});
$.ajax({
      method: "GET",
      url: "gen.php",
      dataType: "text",
      data: {mode: 'login',
             what: 'info'},
      success: function(data){  
        $('#info-content').html(data);
       
	}
});
$('.tag').html("");
likes = 0;
views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }



    var loginerr = <?php echo $err; ?>;




    if(loginerr == 1){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        $('#name').html("Пароль не верный!");
        $('#acc').html("Вход");
        $('#info-content').html("Попробуйте ещё раз, может вы опечатались?");
        $('.tag').html("");
        likes = 0;
        views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }
    if(loginerr == 2){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        $('#name').html("Новый аккаунт создан!");
        $('#acc').html("Вход");
        $('#info-content').html("Мы рады, что вы к нам присоединились!");
        $('.tag').html("");
        likes = 0;
        views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }
    if(loginerr == 3){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        $('#name').html("Пустые строки!");
        $('#acc').html("Вход");
        $('#info-content').html("Ой, вы пропустили строчку, будьте внимательней)");
        $('.tag').html("");
        likes = 0;
        views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }
    if(loginerr == 4){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        $('#name').html("Здравствуйте, <?php echo $_SESSION[accaunt]; ?>");
        $('#acc').html("Вход");
        $('#info-content').html("Добро пожаловать снова!");
        $('.tag').html("");
        likes = 0;
        views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }
    if(loginerr == 5){
        $( "#card" ).animate({left:-1000},300);
        $( "#info" ).animate({top:1000},300);
        $('#name').html("Добавлено!");
        $('#acc').html("Новое");
        $('#info-content').html("Всё, новый пост добавлен!");
        $('.tag').html("");
        likes = 0;
        views = 0;
        $( "#card" ).animate({left:0},300);
        $( "#info" ).animate({top:0},300);
        $( "#menu" ).hide();
            menu = 0;
    }
</script>