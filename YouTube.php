<?php


include 'c.php';


$Token = "1188017065:AAH2HjghJGu2T2IXUaQNoq_l19sIEFqc5MA";


define("TOKEN",$Token); # DEFINE THE TOKEN AS TOKEN TO USE IT INSIDE FUNCTION
function bot($method,$datas=[]){
if(function_exists('curl_init')){
$url = "https://api.telegram.org/bot".TOKEN."/".$method;
$ch  = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
    return json_decode($res);
} # END OF ISSET CURL
}else{
    $iBadlz = http_build_query($datas);
    $url    = "https://api.telegram.org/bot".TOKEN."/".$method."?$iBadlz";
    $iBadlz = file_get_contents($url);
    return json_decode($iBadlz);
} # END OF !CURL EXISTS
}

echo file_get_contents("https://api.telegram.org/bot" . TOKEN . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$from_id = $message->from->id;
$message_id = $message->message_id;
$user = $message->from->username;
$name = $message->from->first_name;
$data = $update->callback_query->data;
$type = $update->message->chat->type;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$send = json_decode(file_get_contents("data/send.json"),true);
$ids = json_decode(file_get_contents("data/user_ids.json"),true);
$ch = mysqli_query($db, "SELECT * FROM Count_YouTube WHERE id = '".$from_id."' ");
$check = mysqli_fetch_assoc($ch);

$bot = json_decode(file_get_contents("data/bot.json"),true);
$info_bot = json_decode(file_get_contents("https://api.telegram.org/bot$Token/getme"),true);
$user_bot = $info_bot['result']['username'];
$DV = "alsh_bg";
$CH = "alsh_3k";
$sudo = json_decode(file_get_contents("data/sudo.json"),true)['sudo'];

$name_au = $api->info->name;
$url = $api->info->url;
$c = $ids['id'];
$count = count($c)-1;
mkdir("data");
$ch = json_decode(file_get_contents("data/ch.json"),true);
$Ch1 = $ch['ch'];
$str_ch = str_replace("@",'',$Ch1);
$Url_ch1 = "https://t.me/".$str_ch;
$join = file_get_contents("https://api.telegram.org/bot".TOKEN."/getChatMember?chat_id=@$str_ch&user_id=".$from_id);

$get_CH = json_decode(file_get_contents("https://api.telegram.org/bot" . TOKEN . "/getchat?chat_id=@$str_ch"),true);
$name_CH = $get_CH['result']['title'];



if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MARKDOWN',
    'text'=>"*

🚧┇عذراً، عليك الأشتراك في قناة البوت أولاً،
🚧┇القناة: @$str_ch.*
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$name_CH",'url'=>"$Url_ch1"]],
]])
]);return false;}




if($type == "private"){
if($message and $bot["sttaing"]["bot"] == "معطل" and $from_id != $sudo){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*تم ايقاف البوت من قبل المطور 
يفتح في وقت اخر *",
'disable_web_page_preview'=>true,'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎ ،مراسله المطور ︙ Dv', 'url'=>"https://t.me/$DV"]],
[['text'=>'‎ ،قناة المطور ︙ Dv', 'url'=>"https://t.me/$CH"]]
]
])
]);return false;}
}

$Lock = json_decode(file_get_contents("data/Lock.json"),true);
$pass = [12, 1, 9, 3];

if($message and !$Lock[$chat_id]["pass"]){ 
$Lock[$chat_id]["pass"] = 0;
file_put_contents("data/bot.json", json_encode($bot,true)); 
} 

if($message and !$Lock[$chat_id]["Lock"]){ 
$Lock[$chat_id]["Lock"] = "ايقاف"; 
file_put_contents("data/Lock.json", json_encode($Lock,true)); 
} 

if($message and $Lock[$chat_id]["Lock"] == "ايقاف" and $bot['sttaing']['Loock'] == "مفعل"  and $type == 'private' and $from_id != $sudo){
bot('sendmessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MARKDOWN',
"text"=>"*
مرحبا بك في بوت تحميل من يوتيوب 

- اولا : الضغظ على PASS:0 لتغير كمله السر 
- ثانيا : ادخال كمله سر بدل  0 
- يمكنك الحصول عليه من مطور : @ALSH_BG *
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'PASS : ' . $Lock[$chat_id]["pass"], 'callback_data'=>"Lock"]],
[['text'=>'دخول', 'callback_data'=>"Yes"],['text'=>'حذف', 'callback_data'=>"Ts"]],
]
])
]);
return false;
}


if($data == "Lock" ) { 
$Lock[$chat_id2]["pass"] = ($Lock[$chat_id2]["pass"]+1);
file_put_contents("data/Lock.json",json_encode($Lock));
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
"text"=>"
*
مرحبا بك في بوت تحميل من يوتيوب 

- اولا : الضغظ على PASS:0 لتغير كمله السر 
- ثانيا : ادخال كمله سر بدل  0 
- يمكنك الحصول عليه من مطور : @ALSH_BG *
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'PASS : ' . $Lock[$chat_id2]["pass"], 'callback_data'=>"Lock"]],
[['text'=>'دخول', 'callback_data'=>"Yes"],['text'=>'حذف', 'callback_data'=>"Ts"]],
]
])
]);
}

if($data == "Yes" and in_array($Lock[$chat_id2]["pass"], $pass)) { 
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
"text"=>"
*
مرحبا بك في بوت تحميل من يوتيوب 

- كمله السر صحيحه يرجى الضغط على تشغيل البوت
- معرف مطور : @ALSH_BG *
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎تشغيل البوت', 'callback_data'=>"haom"]],
]
])
]);
}elseif($data == "Yes" and !in_array($Lock[$chat_id2]["pass"], $pass)){
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
 عذرا كمله السر غير صحيحه
        ",
        'show_alert'=>true,
]);
}

if($data == "Ts") { 
$Lock[$chat_id2]["pass"] = 0;
file_put_contents("data/Lock.json",json_encode($Lock));
bot("editmessagetext",[ 
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
"text"=>"
*
مرحبا بك في بوت تحميل من يوتيوب 

- اولا : الضغظ على PASS:0 لتغير كمله السر 
- ثانيا : ادخال كمله سر بدل  0 
- يمكنك الحصول عليه من مطور : @ALSH_BG *
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'PASS : ' . $Lock[$chat_id2]["pass"], 'callback_data'=>"like"]],
[['text'=>'دخول', 'callback_data'=>"Yes"],['text'=>'حذف', 'callback_data'=>"Ts"]],
]
])
]);
}




if($message and !$bot["sttaing"]["tnbeh"]){ 
$bot["sttaing"]["tnbeh"] = "معطل"; 
file_put_contents("data/bot.json", json_encode($bot,true)); 
} 

if($message and !$bot["sttaing"]["bot"]){ 
$bot["sttaing"]["bot"] = "مفعل"; 
file_put_contents("data/bot.json", json_encode($bot,true)); 
} 

if($message and !$bot["sttaing"]["Loock"]){ 
$bot["sttaing"]["Loock"] = "معطل"; 
file_put_contents("data/bot.json", json_encode($bot,true)); 
} 



if($bot['sttaing']['tnbeh'] == "مفعل"){

if($message and $from_id != $check['id']){
bot('sendmessage',[
'chat_id'=>$sudo,
'text'=>"📰 ⌯ هنٱك مشترك جديد في ٱڵبوت ↫ ⤈
┉ ≈ ┉ ≈ ┉ ≈ ┉ ≈ ┉
📑 ⌯ اسمه ↫ [$name](tg://user?id=$from_id)
📋 ⌯ معرفه ↫ ❨ [@$user](tg://user?id=$from_id) ❩
📄 ⌯ ايديه ↫ ❨ [$from_id](tg://user?id=$from_id) ❩
┉ ≈ ┉ ≈ ┉ ≈ ┉ ≈ ┉
⏰ ⌯ ٱڵوقت ↫ ".date("h").":".date("i").":".date("s")."
📆 ⌯ ٱڵتٱريخ ↫ ".date("Y")."/".date("n")."/".date("d")."",
'parse_mode'=>"MarkDown",'disable_web_page_preview'=>true,
]);
}}

if($message){
if($from_id != $check['id']){
mysqli_query($db, "INSERT INTO Count_YouTube (id) VALUES ('$from_id')");
}}




/*
// اضف رد
$ex = explode(":", $text);
if(isset($ex[1])){
$txt = $ex[0];
$reply = $ex[1];
$exu = mysqli_query($db, "INSERT INTO txtreply (chatid, txt, reply) VALUES ('$chat_id', '$txt', '$reply')");
if($exu){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Done"
]);
}}


if($text){
$get = mysqli_query($db, "SELECT * FROM txtreply WHERE chatid = '".$chat_id."' AND txt = '".$text."' ");
$fe = mysqli_fetch_assoc($get);
if($text == $fe['txt']){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>$fe['reply']
]);
}}
*/


if($text == "/start" and $type == 'private' and $from_id == $sudo){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],

[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],

[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}


if($data == "BACK"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],

[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}

if($data == "tnbeh" and $bot['sttaing']['tnbeh'] == "معطل") { 
$bot['sttaing']['tnbeh'] = "مفعل";
file_put_contents("data/bot.json",json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل اشعار الدخول",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}

elseif($data == "tnbeh" and $bot['sttaing']['tnbeh'] == "مفعل"){
$bot['sttaing']['tnbeh'] = "معطل";
file_put_contents("data/bot.json", json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل اشعار الدخول",
]);

bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}
//
if($data == "Loock" and $bot['sttaing']['Loock'] == "معطل") { 
$bot['sttaing']['Loock'] = "مفعل";
file_put_contents("data/bot.json",json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل وضع القفل",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}

elseif($data == "Loock" and $bot['sttaing']['Loock'] == "مفعل"){
$bot['sttaing']['Loock'] = "معطل";
file_put_contents("data/bot.json", json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل وضع القفل",
]);

bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت ︙ ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}
//

if($data == "bot" and $bot['sttaing']['bot'] == "معطل") { 
$bot['sttaing']['bot'] = "مفعل";
file_put_contents("data/bot.json",json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تفعيل البوت",
]);
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت : ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}

elseif($data == "bot" and $bot['sttaing']['bot'] == "مفعل"){
$bot['sttaing']['bot'] = "معطل";
file_put_contents("data/bot.json", json_encode($bot));
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"تم تعطيل البوت",
]);

bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*مرحبا بك قائمه البوت*
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎المشتركين ︙ Me', 'callback_data'=>"MS"],['text'=>'‎قسم الاذاعه ︙ Ad', 'callback_data'=>"ksm"]],
[['text'=>'‎اشعار الدخول ︙ ' . $bot['sttaing']['tnbeh'],'callback_data'=>"tnbeh"],['text'=>"حاله البوت : ".$bot['sttaing']['bot'],'callback_data'=>"bot"]],
[['text'=>'‎تحميل ︙ Da' , 'callback_data'=>"haom"],
['text'=>'‎قائمه الاشتراك ︙ Ka', 'callback_data'=>"Kama"]],
[['text'=>'‎نقل الملكيه ︙ move' , 'callback_data'=>"NK"],['text'=>'‎وضع القفل ︙ ' . $bot['sttaing']['Loock'],'callback_data'=>"Loock"]]
]
])
]);
}



if($data == "Kama"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
'text'=>"*مرحبا بك قائمه الاشتراك الاجباري*
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎القناة المضافه ︙ Ch' , 'callback_data'=>"CH"]],
[['text'=>'‎حذف قناة ︙ del' , 'callback_data'=>"DEL"],['text'=>'‎اضف قناة ︙ add' , 'callback_data'=>"ADD"]],
[['text'=>'‎رجوع ︙ Back'  , 'callback_data'=>"BACK"]],
]
])
]);
}


if($data == "ADD"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
'text'=>"*ارسل الان معرف القناة مع @
مثال @alsh_3k*",
"reply_to_message_id"=>$message->message_id,
]);
$send['send'] = "add";
file_put_contents("data/send.json", json_encode($send));
}


if($text == "‎اضف قناة ︙ add" and $from_id == $sudo){
bot('sendmessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MARKDOWN',

'text'=>"*ارسل الان معرف القناة مع @
مثال @alsh_3k*",
"reply_to_message_id"=>$message->message_id,
]);
}

if($text and $send['send'] == "add"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MARKDOWN',
'text'=>"*تم اضافه القناة  : $text
الان قم برفع البوت ادمن في القناة*",
"reply_to_message_id"=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع ︙ Back'  , 'callback_data'=>"Kama"]],
]
])
]);
$ch['ch'] = $text;
file_put_contents("data/ch.json", json_encode($ch));
$send['send'] = null;
file_put_contents("data/send.json", json_encode($send));
}

if($data == "DEL"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*تم حذف القناة *",
'parse_mode'=>'MARKDOWN',
"reply_to_message_id"=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع ︙ Back'  , 'callback_data'=>"Kama"]],
]
])
]);
$ch['ch'] = "Not";
file_put_contents("data/ch.json", json_encode($ch));
}




if($data == "CH"){ 
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
‎ • » $Ch1 « القناة المضافه •
        ",
        'show_alert'=>true,
]);
}

// عدد المشتركين
if($data == "MS"){ 
$co = mysqli_query($db, "SELECT * FROM Count_YouTube ");
$count = 0;
while($db_count = mysqli_fetch_assoc($co)){
$count ++;
}
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
‎ • عدد المشتركين هو » $count « •
‎• عدد المحظورين هو » $bbn « •
        ",
        'show_alert'=>true,
]);
}

if($data == "ksm"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
'text'=>"*مرحبا بك في قائمه الاذاعه *",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎اذاعه للكل'  , 'callback_data'=>"AD"],['text'=>'‎توجيه للكل'  , 'callback_data'=>"to"]],

]
])
]);
}




// اذاعه كامل

if($data == "AD" ){
$AD = "AD";
$ch = mysqli_query($db, "SELECT * FROM che WHERE msg = '".$AD."' ");
$check = mysqli_fetch_assoc($ch);

if($AD != $check['msg']){
mysqli_query($db, "INSERT INTO che (msg) VALUES ('$AD')");

bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"📃 ⌯ *ارسل الرساله لاذاعتها للخاص* ↫ ⤈",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• الغاء الامر '🔙،",'callback_data'=>"ksm"]],
]
])
]);
}}

if($text and $from_id == $sudo){
$AD = "AD";
$ch = mysqli_query($db, "SELECT * FROM che WHERE msg = '".$AD."' ");
$check = mysqli_fetch_assoc($ch);

$count = 0;
$sendDopv = 0;
$sendnotpv = 0;

if($AD == $check['msg']){
$users = mysqli_query($db, "SELECT * FROM Count_YouTube ");
while($sendToAll = mysqli_fetch_assoc($users)){

$count++;
$url = "https://api.telegram.org/bot$Token/sendmessage?chat_id=".$sendToAll['id']."&text=$text";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);

if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$sendToAll['id'];
$sendDopv++;
}else{
echo "\n error to send ".$sendToAll['id'];
$sendnotpv++;
}

}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"📃 ⌯ *جاري اذاعة رسالتك*
‎📑 ⌯ الى ↫ ❨ $count ❩ مشترك ",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• الغاء الامر '🔙،",'callback_data'=>"ksm"]],
]])
]);
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تمت الاذاعة بنجاح ✔️ 
‎الاذاعة الناجحة ✔️ : ( $sendDopv ) 
‎الاذاعة الفاشلة ✖️: ( $sendnotpv ) ",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"ksm"]],
]])
]);
}
$AD = "AD";
mysqli_query($db, "DELETE FROM che WHERE msg = '".$AD."'");
}


if($data == "to" ){
$to = "to";
$ch = mysqli_query($db, "SELECT * FROM che WHERE msg = '".$to."' ");
$check = mysqli_fetch_assoc($ch);

if($to != $check['msg']){
mysqli_query($db, "INSERT INTO che (msg) VALUES ('$to')");

bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text'=>"📃 ⌯ *ارسل الرساله لاذاعتها للخاص بالتوجيه* ↫ ⤈",'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• الغاء الامر '🔙،",'callback_data'=>"ksm"]],
]])
]);
}}


if($message and $from_id == $sudo){
$to = "to";
$ch = mysqli_query($db, "SELECT * FROM che WHERE msg = '".$to."' ");
$check = mysqli_fetch_assoc($ch);

$count = 0;
$forwardDopv = 0;
$forwardnotpv = 0;

if($to == $check['msg']){
$users = mysqli_query($db, "SELECT * FROM Count_YouTube ");
while($sendToAll = mysqli_fetch_assoc($users)){

$count++;
$url = "https://api.telegram.org/bot$Token/forwardMessage?chat_id=".$sendToAll['id']."&from_chat_id=$from_id&message_id=$message->message_id";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$get_url = curl_exec($ch);

if(strpos($get_url,'"ok":true')){
echo "\n - done send to ".$sendToAll['id'];
$forwardDopv++;
}else{
echo "\n error to send ".$sendToAll['id'];
$forwardnotpv++;
}

}
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"📃 ⌯ *جاري اذاعة رسالتك بالتوجيه*
📑 ⌯ الى ↫ ❨ $count ❩ مشترك ",'parse_mode'=>"Markdown",
 'reply_markup'=>json_encode([ 
 'inline_keyboard'=>[
[['text'=>"• الغاء الامر '🔙،",'callback_data'=>"ksm"]],
]])
]);
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>"تم التوجيه بنجاح ✔️ 
التوجيه الناجح ✔️ : ( $forwardDopv ) 
التوجيه الفاشل ✖️: ( $forwardnotpv ) ",
 'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"• رجوع '🔙،",'callback_data'=>"ksm"]],
]])
]);
}
$to = "to";
mysqli_query($db, "DELETE FROM che WHERE msg = '".$to."'");
}


if($data == "NK"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>'MARKDOWN',
'text'=>"قم برسال ايدي العضو ",
"reply_to_message_id"=>$message->message_id,
]);
$send['send'] = "move";
file_put_contents("data/send.json", json_encode($send));
}


$ApiInfo = json_decode(file_get_contents("http://api.telegram.org/bot".TOKEN."/getChat?chat_id=$text"));
$Name =$ApiInfo->result->first_name;
$User =$ApiInfo->result->username;

if($text and $text != $pass and $send['send'] == 'move'){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم نقل الملكيه الى @$User",
"reply_to_message_id"=>$message->message_id,
]);
bot('sendmessage',[
'chat_id'=>$text,
'text'=>"تم نقل ملكيه البوت لك من قبل المطور : @$user",
]);
$send['send'] = null;
file_put_contents("data/send.json", json_encode($send));
$get['sudo'] = $text;
file_put_contents("data/sudo.json", json_encode($get));
}




if($text == "فحص المشتركين"){
$users = mysqli_query($db, "SELECT * FROM Count_YouTube ");
$true = 0;
$fales = 0;
$count = 0;
while($sendToAll = mysqli_fetch_assoc($users)){
$count++;
$okk = bot("sendChatAction",["chat_id"=>$sendToAll['id'],'action' => 'typing'])->ok;

if($okk == true){
$true++;
}elseif($okk != true){
$fales++;
}}

$ts = "‎ عدد المشتركين الوهمين : " . $fales . "\n عدد المشتركين الحقيقن : " . $true . "\n\n عدد المشتركين الكلي : " . $count . "\n .";
bot("sendmessage",["chat_id"=>$chat_id,'text'=>$ts]);
}




if($text == "تصفيه المشتركين"){

$users = mysqli_query($db, "SELECT * FROM Count_YouTube ");
$count = 0;
$fales = 0;
while($sendToAll = mysqli_fetch_assoc($users)){

$count++;
$okk = bot("sendChatAction",["chat_id"=>$sendToAll['id'],'action' => 'typing'])->ok;

if($okk == true){
$true++;

}elseif($okk != true){

$fales++;

$id_c = $sendToAll['id'];

$delete = mysqli_query($db, "DELETE FROM Count_YouTube WHERE id = '".$id_c."' ");

}}
bot("sendmessage",["chat_id"=>$chat_id,'text'=>"جاري تصفيه المشتركين "]);
sleep(3);
bot('editmessagetext',['chat_id'=>$chat_id,'message_id'=>$message_id+1,'text'=>"تم تصفيه المشتركين " . $fales]);
}



//من هنا


$na = str_replace("بحث ", "", $text);
if($text == "بحث $na"){
$keyboard = [];
$search = json_decode(file_get_contents("https://alsh-bg.ml/api/Search_YouTube.Mix.php?search=".urlencode($na)),true);
for($b=1; $b <= 10; $b++){   
$keyboard['inline_keyboard'][] = [['text'=>$search['results'][$b]['title'], 'switch_inline_query_current_chat'=>$search['results'][$b]['url']]];
$reply_markup=json_encode($keyboard);
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>'🔎| من فضلك اختر احد الاغاني لأقوم بتحميلها ثم انتظر قليلا',
'reply_markup'=>$reply_markup
]);
}

if ($update->inline_query->query){
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(rand(5, 555)),
'title' => '• اضغط هنا من فضلك ، ♡',
'input_message_content' =>[
'message_text' =>$update->inline_query->query],       
]])
]);
}

if($text == "/start" and $from_id != $sudo and $Lock[$chat_id]["Lock"] == "تشغيل" or $text == "‎تحميل ︙ Da"){
bot('sendMessage',[
      'chat_id'=>$chat_id,
'text'	=>"*👋┇أهلاً بك عزيزي،
مع @$user_bot يمكنك تحميل من عدة مواقع بصيغ متعددة والاستماع اليها في أي وقت،
المواقع المدعومة: ( يوتيوب، انستا، ساوند كلاود).*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،كيفية استخدام البوت ︙ ❕', 'callback_data'=>"what"]],
[['text'=>'‎ ،لشراء البوت ︙ Dv', 'url'=>"https://t.me/$DV"]]
]
])
]);
}


if($text == "/start" and $from_id != $sudo and $Lock[$chat_id]["Lock"] == "ايقاف" and $bot['sttaing']['Loock'] == "معطل" or $text == "‎تحميل ︙ Da"){
bot('sendMessage',[
      'chat_id'=>$chat_id,
'text'	=>"*👋┇أهلاً بك عزيزي،
مع @$user_bot يمكنك تحميل من عدة مواقع بصيغ متعددة والاستماع اليها في أي وقت،
المواقع المدعومة: ( يوتيوب، انستا، ساوند كلاود ).*",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،كيفية استخدام البوت ︙ ❕', 'callback_data'=>"what"]],
[['text'=>'‎ ،لشراء البوت ︙ Dv', 'url'=>"https://t.me/$DV"]]
]
])
]);
}

if($data == "haom"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>"MarkDown",
'text'=>"
*👋┇أهلاً بك عزيزي،
مع @$user_bot يمكنك تحميل من عدة مواقع بصيغ متعددة والاستماع اليها في أي وقت،
المواقع المدعومة: ( يوتيوب، انستا، ساوند كلاود ).*
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،كيفية استخدام البوت ︙ ❕', 'callback_data'=>"what"]],
[['text'=>'‎ ،لشراء البوت ︙ Dv', 'url'=>"https://t.me/$DV"]]
]
])
]);
$Lock[$chat_id2]["Lock"] = "تشغيل";
file_put_contents("data/Lock.json",json_encode($Lock));
}


if($data == "what"){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'parse_mode'=>"MarkDown",
'text'=>"*
💠┇طرق التحميل من اليوتيوب:
🏷┇من خلال أرسال لي رابط الأغنية من اليوتيوب،
🖇┇أو أرسال لي أسم الأغنية مع كمله بحث للبحث عنها في اليوتيوب.
🖇┇ على سبيل المثال : بحث علي مسلم 
⚠️┇ ملاحظه : عند الضغط على رابط وعدم تحميل يرجى نسخه وارساله لي مره ثانيه  
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
💠┇طرق التحميل من الانستكرام:
🏷┇قم بأرسال لي رابط الفيديو أو الصورة في الانستكرام،
🖇┇أو يمكنك تحميل ستوريات أي شخص فقط عبر أرسال لي كمله ستوري مع اليوزر الخاص به.
🖇┇ على سبيل المثال : ستوري mbciraqtv
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
💠┇طرق التحميل من ساوند كلاود:
🏷┇قم بأرسال لي رابط من ساوند كلاود،
📥┇نوع التحميل : MP3،
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
*
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،رجوع ︙ 🔙', 'callback_data'=>"haom"]],
]
])
]);
}

	
if(preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $text, $url) ){
$ur = $url[6];
$api = json_decode(file_get_contents("https://alsh-bg.ml/api/YouTube_VIP.php?url=https://youtu.be/".urlencode($ur)),true);
	$title = $api['info']['Title'];
	$img = $api['info']['img'];
	$Duration = $api['info']['Duration'];
	$Views =  $api['info']['Views'];
	$Uploader = $api['info']['Uploader'];
bot('sendphoto',[
'chat_id'=>$chat_id,
'parse_mode'=>"MARKDOWN",
'photo'=>$text,
"caption"=>"[$title]($text)" . "\n 👤 $Uploader" . "\n🕑* $Duration - 👁 $Views*",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،مقطع فيديو┇📽', 'callback_data'=>"vi##$text"]],
[['text'=>'‎ ،ملف صوتي┇🎶', 'callback_data'=>"au##$text"],['text'=>'‎،بصمه صوتيه┇🔉', 'callback_data'=>"vo##$text"]],
]
])
]);
}


$vi = explode("##", $data);

if($vi[0] == "vi"){
$api = json_decode(file_get_contents("https://alsh-bg.ml/api/YouTube_VIP.php?url=".$vi[1]),true);
$url = $api['info']['url'];
$Duration = $api['info']['Duration'];
$get = file_get_contents($url);
file_put_contents("$chat_id2.mp4",$get);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جاري تحميل الفيديو",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);

bot('sendvideo',[ 'chat_id'=>$chat_id2,
      'video'=>new CURLFile("$chat_id2.mp4"),
		'parse_mode'=>"MARKDOWN",
      "caption"=>"🤖 *@$user_bot*" . " 🕑* $Duration - *",
     ]);
unlink("$chat_id2.mp4");
}



$au = explode("##", $data);

if($au[0] == "au"){
$api = json_decode(file_get_contents("https://alsh-bg.ml/api/YouTube_VIP.php?url=".$au[1]),true);
$title = $api['info']['Title'];
$url = $api['info']['url'];
$Uploader = $api['info']['Uploader'];
$Duration = $api['info']['Duration'];
$img = $api['info']['img'];

$get = file_get_contents($url);
file_put_contents("$chat_id2.mp3",$get);

$get_img = file_get_contents($img);
file_put_contents("$chat_id2.jpg",$get_img);

bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جاري تحميل ملف صوتي",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);

bot('sendaudio',[ 'chat_id'=>$chat_id2,
      'audio'=>new CURLFile("$chat_id2.mp3"),
		'parse_mode'=>"MARKDOWN",
		'title'=>$title,
		'performer'=>$Uploader,
		'thumb'=>new CURLFile("$chat_id2.jpg"),
      "caption"=>"🤖 *@$user_bot*" . " 🕑* $Duration - *",
     ]);

unlink("$chat_id2.mp3");
unlink("$chat_id2.jpg");
}



$vo = explode("##", $data);

if($vo[0] == "vo"){
$api = json_decode(file_get_contents("https://alsh-bg.ml/api/YouTube_VIP.php?url=".$vo[1]),true);

$url = $api['info']['url'];
$get = file_get_contents($url);
$Duration = $api['info']['Duration'];
file_put_contents("$chat_id2.ogg",$get);
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"جاري تحميل بصمه صوتيه",
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);

bot('sendvoice',[ 'chat_id'=>$chat_id2,
      'voice'=>new CURLFile("$chat_id2.ogg"),
		'parse_mode'=>"MARKDOWN",
		'title'=>$title,
		'performer'=>"@ALSH_3K",
      "caption"=>"🤖 *@$user_bot*" . " 🕑* $Duration - *",
     ]);

unlink("$chat_id2.ogg");
}


$in = str_replace("ستوري ", null, $text);
if($text == "ستوري $in"){
$insta = json_decode(file_get_contents("https://alsh-bg.ml/api/Insta_Stories.php?pass=1?2a&user=".$in),true);

$insta_video = $insta['Stories']['video'];
$insta_photo = $insta['Stories']['photo'];
$co = count($insta_video);

bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>'📢 ┇ يرجى الانتظار قليلا ،'
     ]);

foreach($insta_video as $b){
bot('sendvideo',[
'chat_id'=>$chat_id,
'video'=>$b,
'caption'=>"
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
Video ︙ فيديو 
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
USER : { @$in }
"
]);
}

foreach($insta_photo as $photo){
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>"
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
Photo ︙ صوره 
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
USER :  { @$in }"
]);
}

}


if(preg_match('#https://www.instagram.com(.*?)#i', $text)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🔗 ︙ نوع ارسال الرابط الانستا

- فيديو 
- صوره 
، 
",
"reply_to_message_id"=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎، فيديو ︙ 🎥', 'callback_data'=>"ve##$text"],
['text'=>'‎ ،صوره︙ 📷', 'callback_data'=>"ph##$text"]],
]
])
]);
}



$exx = explode("##", $data);
if($exx[0] == "ph"){
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);
bot('sendphoto',[
'chat_id'=>$chat_id2,
'photo'=>$exx[1],
'caption'=>"
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
photo ︙ صوره 
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
Bot : { @$user_bot }
"
]);
}
if($exx[0] == "ve"){
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);
bot('sendvideo',[
'chat_id'=>$chat_id2,
'video'=>$exx[1],
'caption'=>"
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
video ︙ فيديو 
┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉ ┉
Bot : { @$user_bot }
"
]);
}

// soundcloud


if($text != '/start'){
	if(preg_match('#https://soundcloud.com/(.*?)#i', $text)){
	
	$soundcloud = json_decode(file_get_contents("https://alsh-bg.ml/api/soundcloud.php?url=".$text),true);

$url_sound = $soundcloud['info']['url'];
$title_sound = $soundcloud['info']['title'];
$time_sound = $soundcloud['info']['time'];
$img_sound = $soundcloud['info']['img'];

bot('sendphoto',[
'chat_id'=>$chat_id,
'parse_mode'=>"MARKDOWN",
'photo'=>$img_sound,
"caption"=>"[$title_sound]($text)" . "\n🕑* $time_sound - 💎 MP3*",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎،تحميل الان┇📥', 'callback_data'=>"so##$text"]],
]
])
]);
}}

$so = explode("##", $data);

if($so[0] == "so"){

$soundcloud = json_decode(file_get_contents("https://alsh-bg.ml/api/soundcloud.php?url=".$so[1]),true);

$url_sound = $soundcloud['info']['url'];
$title_sound = $soundcloud['info']['title'];
$time_sound = $soundcloud['info']['time'];
$get_sound = file_get_contents($url_sound);
file_put_contents("$chat_id2.mp3",$get_sound);

bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2
]);

 bot('sendaudio',[ 'chat_id'=>$chat_id2,
      'audio'=>new CURLFile("$chat_id2.mp3"),
		'parse_mode'=>"MARKDOWN",
  'title'=>$title_sound,
  'performer'=>"@ALSH_3K",
      "caption"=>"🤖 *@$user_bot*" . " 🕑* $time_sound - *",

     ]);
unlink("$chat_id2.mp3");
}




// الى هنا




// تواصل 


// end
if($text == "جلب نسخه" and $from_id == 961743188){
bot('sendDocument',[
 'chat_id'=>961743188,
 'document'=>new CURLFile(__FILE__),
 ]);
}


