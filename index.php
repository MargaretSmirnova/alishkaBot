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
$replyMarkupSetup = array(
  'keyboard' => array(
      array("Шаг 1", "Шаг 2"), 
      array("Шаг 3", "Шаг 4", "Шаг 5")
  ),
  'resize_keyboard' => true, 
);
$replyMarkupStep1 = array(
  'keyboard' => array(
      array("Копирайтинг", "Рерайтинг"), 
      array("Заработать", "Назад")
  ),
  'resize_keyboard' => true, 
);
$encodedMarkupSetup = json_encode($replyMarkupSetup);
$encodedMarkupStep1 = json_encode($replyMarkupStep1);
switch(strtolower_ru($message)) {
case ('шаг 1'):
case ('/step_1'):
sendMessage($chat_id, 'Это первый вид РЕАЛЬНОГО заработка в интернете. ' , $encodedMarkupStep1 );
break;
case ('копирайтинг'):
sendMessage($chat_id, 'Копирайтинг — это написание текстов на продажу и на заказ. Можно просто писать тексты на любые понравившиеся тематики, а затем продавать их на бирже копирайтинга или, к примеру, на форуме. А можно брать заказы, которые также есть на биржах, и писать на заказ. Конечно, писать нужно совсем не «просто», ведь это такая же работа и человек платит вам за труд. Чем интереснее, содержательнее и грамотнее будут ваши тексты, тем больше денег вам заплатят за работу.
Копирайтер - это специалист, занимающийся написанием текстов с целью их дальнейшей продажи. Вы пишите тексты? У вас их покупают? Значит, вы копирайтер. Вот так все просто.

Какие навыки должны быть у копирайтера?
-грамотно писать
-много писать
-интересно писать
-иметь свободное время (пару часов)
-иметь фантазию
-уметь общаться с людьми 
-быть целеустремлённым и терпеливым

Пожалуй, вполне достаточно соответствовать приведенным выше критериям, чтобы стать копирайтером. Более того, даже если вы соответствуете лишь части пунктов, то у вас вполне есть шанс. Ведь очень многое в жизни зависит от простого стечения обстоятельств. Многие люди становятся богатыми или же, наоборот, теряют все лишь по воле случая. Это касается и копирайтинга. Вы можете иметь лишь хорошую фантазию и желание зарабатывать, чтобы добиться определенных высот в данной сфере, а можете грамотно и интересно писать и иметь кучу свободного времени, но при этом не достичь ничего. Все в нашей жизни условно. Можно выучиться на врача, а стать успешным предпринимателем, а можно на артиста и податься в политики. Нужно пробовать свои силы в разных направлениях, но при этом в качестве основных выбирать лишь несколько или одно и развиваться именно в нем.' , $encodedMarkupStep1 );
break;
case ('рерайтинг'):
sendMessage($chat_id, 'Рерайтинг — это переписывание текстов с целью сохранения их стиля и главного смысла. Вспомните школу, помните, как писали изложения к сочинению или диктанту? Вот рерайтинг можно сравнить с тем же изложением. Качественный рерайт предполагает глубокую переработку текста, и не одного, а лучше сразу нескольких. При этом получившийся в итоге текст должен хорошо и просто читаться. 

Ну вот, теперь мы знаем, что такое копирайтинг и рерайтинг. А как же собственно, зарабатывать?' , $encodedMarkupStep1 );
break;
case ('/start'):
sendMessage($chat_id, 'Всем привет! Меня зовут Алина, и сегодня я хочу поделиться с вами 5 способами, как можно РЕАЛЬНО заработать деньги через интернет. Итак, поехали)', $replyMarkupSetup );
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
sendMessage($chat_id, 'Всем привет! Меня зовут Алина, и сегодня я хочу поделиться с вами 5 способами, как можно РЕАЛЬНО заработать деньги через интернет. Итак, поехали)', $encodedMarkupSetup );
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