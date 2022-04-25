<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', 'password', 'idea');
if($_GET[mode] == "login"){
    if($_GET[what] == "accaunt"){
        echo 'Вход';
    }
    if($_GET[what] == "name"){
        echo 'Введите логин и пароль, а если нет аккаунта, придумайте логин и пароль';
    }
    if($_GET[what] == "info"){
       
       ?>
       <form method="POST" action="">
           Логин<br>
           <input type="text" name="login" id="inputs"><br>
           Пароль<br>
           <input type="password" name="pass" id="inputs"><br><br>
           <input type="submit" name="btn" value="Далее" id="inputs">
       </form>
   <?php
    }
    
}
if($_GET[mode] == "new"){
    if($_GET[what] == "accaunt"){
        echo 'Новое';
    }
    if($_GET[what] == "name"){
        ?>
            Форма ниже!
        <?php
    }
    if($_GET[what] == "info"){
      ?>
        <form method="POST" enctype='multipart/form-data' action="">
            Название<br>
            <input type="text" id="inputs2" name="name"><br>
            Изображение<a id="grey"> (Не обязательно)</a><br>
            <input type="file" id="inputs2" name="img"><br>
            Текст<br>
            <textarea type="text" id="inputs2" name="text"></textarea><br><br>
            <input type="submit" name="btnsend" value="Далее" id="inputs2">
        </form>
      <?php
    }
    
}
if($_GET[mode] == "getid"){
    $logge = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` NOT in (SELECT `post` FROM `views` WHERE `login` = '$_SESSION[accaunt]') ORDER BY RAND() LIMIT 1");
    //$logge = mysqli_query($connection, "SELECT * FROM `posts`");
    
    if(($ac = mysqli_fetch_assoc($logge))){
        echo $ac[id];
        
    }else{
        echo 'all';
    }
}
if($_GET[mode] == "get"){
    $logge = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$_GET[id]' LIMIT 1");
    if(($ac = mysqli_fetch_assoc($logge))){
        if($_GET[what] == "accaunt"){
            echo $ac[login];
            echo ' | ';
            list($date, $time) = explode(' ', $ac[time]);
                list($year, $month, $day) = explode('-', $date);
                list($hour, $minute, $second) = explode(':', $time);
                $mo = '';
                        if($month == '01'){
                            $mo = 'Января';
                        }
                        if($month == '02'){
                            $mo = 'Февраля';
                        }
                        if($month == '03'){
                            $mo = 'Марта';
                        }
                        if($month == '04'){
                            $mo = 'Апреля';
                        }
                        if($month == '05'){
                            $mo = 'Мая';
                        }
                        if($month == '06'){
                            $mo = 'Июня';
                        }
                        if($month == '07'){
                            $mo = 'Июля';
                        }
                        if($month == '08'){
                            $mo = 'Августа';
                        }
                        if($month == '09'){
                            $mo = 'Сентября';
                        }
                        if($month == '10'){
                            $mo = 'Октября';
                        }
                        if($month == '11'){
                            $mo = 'Ноября';
                        }
                        if($month == '12'){
                            $mo = 'Декабря';
                        }
                if($year == date('Y')){
                    if($month == date('m')){
                        if($day == date('d')){
                            if($hour == date('H')){
                                if($minute == date('i')){
                                    if($second + 20 > date('s')){
                                        echo 'Прямо сейчас!';
                                    }else{
                                        echo date('s') - $second . ' секунд назад';
                                    }
                                }else{
                                    echo date('i') - $minute . ' минут назад';
                                }
                            }else{
                                echo 'Сегодня в ' . $hour . ':' . $minute;
                            }
                        }else if($day + 1 == date('d')){
                            echo 'Вчера в ' . $hour . ':' . $minute;
                        }else{
                            echo $day . ' числа в ' . $hour . ':' . $minute;
                        }
                       
                    }else{
                        echo $day . ' ' . $mo . ' в ' . $hour . ':' . $minute;
                    }
                   
                }else{
                    echo $year . ' год, ' . $day . ' ' . $mo . ' в ' . $hour . ':' . $minute;
                }
        }
        if($_GET[what] == "name"){
            echo $ac[name];
        }
        if($_GET[what] == "info"){
            if($ac[img] != NULL){
            $show_img = base64_encode($ac[img]);
echo '<img src="data:image/jpeg;base64, '. $show_img .'" alt="Изображение не добавлено" width="100%"><br>';
            }
            echo nl2br($ac[info]);
        }
        if($_GET[what] == "tags"){
            $logge = mysqli_query($connection, "SELECT * FROM `tags` WHERE `post` = '$_GET[id]'");
    while(($ac = mysqli_fetch_assoc($logge))){
        echo ' #';
        echo $ac[tag];
    }
        }
        if($_GET[what] == "likes"){
            echo $ac[likes];
        }
        if($_GET[what] == "views"){
            echo $ac[views];
        }
        
    }
}
if($_GET[mode] == 'next'){
    if($_SESSION[accaunt] != NULL){
        if($_GET[id] != 'un'){
            $logge = mysqli_query($connection, "SELECT * FROM `views` WHERE `post` = '$_GET[id]' AND `login` = '$_SESSION[accaunt]'");
            if(!($ac = mysqli_fetch_assoc($logge))){
                mysqli_query($connection, "INSERT INTO `views` (`post`, `login`) VALUES ('$_GET[id]', '$_SESSION[accaunt]')");
                $logget = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$_GET[id]'");
                $acc = mysqli_fetch_assoc($logget);
                $col = $acc[views] + 1;
                mysqli_query($connection, "UPDATE `posts` SET `views` = '$col' WHERE `id` = '$_GET[id]'");
            }
        }
    }
}
if($_GET[mode] == 'like'){
    if($_SESSION[accaunt] != NULL){
        if($_GET[id] != 'un'){
            $logge = mysqli_query($connection, "SELECT * FROM `views` WHERE `likes` = '$_GET[id]' AND `login` = '$_SESSION[accaunt]'");
            if(!($ac = mysqli_fetch_assoc($logge))){
                mysqli_query($connection, "INSERT INTO `likes` (`post`, `login`) VALUES ('$_GET[id]', '$_SESSION[accaunt]')");
                $logget = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$_GET[id]'");
                $acc = mysqli_fetch_assoc($logget);
                $col = $acc[likes] + 1;
                mysqli_query($connection, "UPDATE `posts` SET `likes` = '$col' WHERE `id` = '$_GET[id]'");
                $logge = mysqli_query($connection, "SELECT * FROM `views` WHERE `post` = '$_GET[id]' AND `login` = '$_SESSION[accaunt]'");
            if(!($ac = mysqli_fetch_assoc($logge))){
                mysqli_query($connection, "INSERT INTO `views` (`post`, `login`) VALUES ('$_GET[id]', '$_SESSION[accaunt]')");
                $logget = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$_GET[id]'");
                $acc = mysqli_fetch_assoc($logget);
                $col = $acc[views] + 1;
                mysqli_query($connection, "UPDATE `posts` SET `views` = '$col' WHERE `id` = '$_GET[id]'");
            }
            }
        }
    }
}
?>