<?php
/**
* URL-адрес бота и его маркер.
*/
$access_token = '669376617:AAFaTx1wGDdWP6i82iq1hx_CdKSRhD1xpeM';
$api = 'https://api.telegram.org/bot' . $access_token;
/**
* Зададим основные переменные.
*/
$output = json_decode(file_get_contents('php://input'), TRUE); // Получим то, что передано скрипту ботом в POST-сообщении и распарсим
$chat_id = $output['message']['chat']['id']; // Выделим идентификатор чата
$first_name = $output['message']['chat']['first_name']; // Выделим имя собеседника
$message = $output['message']['text']; // Выделим сообщение собеседника
/**
* Получим команды от пользователя.
* Переведём их для удобства в нижний регистр
*/
$replyMarkup = array(
  'keyboard' => array(
      array("Шаг 1".unichr('\uD83D\uDD27'), "Шаг 2", "Шаг 3", "Шаг 4", "Шаг 5")
  )
);
$encodedMarkup = json_encode($replyMarkup);
switch(strtolower_ru($message)) {
case ('шаг 1'):
case ('/step_1'):
sendMessage($chat_id, 'Привет, '. $first_name . '! Вы выбрали первый шаг ' , $encodedMarkup );
break;
case ('/start'):
sendMessage($chat_id, 'Всем привет! Меня зовут Алина, и сегодня я хочу поделиться с вами 5 способами, как можно РЕАЛЬНО заработать деньги через интернет. Итак, поехали)', $encodedMarkup );
break;
case ('шаг 2'):
case ('/step_2'):
sendMessage($chat_id, 'Добрый день, '. $first_name . '! Вы выбрали шаг 2', $encodedMarkup );
break;
case ('шаг 3'):
case ('/step_3'):
sendMessage($chat_id, 'И снова привет, '. $first_name . '! Вы выбрали шаг 3', $encodedMarkup );
break;
case ('шаг 4'):
case ('/step_4'):
sendMessage($chat_id, ''. $first_name . ', Вы выбрали шаг 4', $encodedMarkup );
break;
case ('шаг 5'):
case ('/step_5'):
sendMessage($chat_id, ''. $first_name . ', Вы выбрали шаг 5!!! Это конец', $encodedMarkup );
break;
case ('exit'):
sendMessage($chat_id, ''. $first_name . ', этот бот покинуть невозможно', $encodedMarkup );
break;
default:
sendMessage($chat_id, 'Всем привет! Меня зовут Алина, и сегодня я хочу поделиться с вами 5 способами, как можно РЕАЛЬНО заработать деньги через интернет. Итак, поехали)', $encodedMarkup );
break;
}
/**
* Функция отправки сообщения в чат sendMessage().
*/
function sendMessage($chat_id, $message, $reply_markup) {
file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . "&reply_markup=" . $reply_markup);
}
/**
* Функция перевода символов в нижний регистр, учитывающая кириллицу
*/
function strtolower_ru($text) {
  $alfavitlover = array('ё','й','ц','у','к','е','н','г', 'ш','щ','з','х','ъ','ф','ы','в', 'а','п','р','о','л','д','ж','э', 'я','ч','с','м','и','т','ь','б','ю');
    $alfavitupper = array('Ё','Й','Ц','У','К','Е','Н','Г', 'Ш','Щ','З','Х','Ъ','Ф','Ы','В', 'А','П','Р','О','Л','Д','Ж','Э', 'Я','Ч','С','М','И','Т','Ь','Б','Ю');
return str_replace($alfavitupper,$alfavitlover,strtolower($text));
}
function unichr($i) {
    return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
}