<?php

$users = file_get_contents('Database/free.txt');
$freeusers = explode("\n", $users);

$videoURLStart = "https://t.me/bot_checkyousef/3";

if (preg_match('/^(\/start|\.start|!start)/', $text)) {
    if (in_array($userId, $freeusers)) {
        $caption = "<b>𝗛𝗲𝗹𝗹𝗼 𝗺𝘆 𝗻𝗮𝗺𝗲 𝗶𝘀 yousef 🌺
𝗔 𝗯𝗼𝘁 𝗽𝗿𝗼𝗴𝗿𝗮𝗺𝗺𝗲𝗱 𝘁𝗼 𝗰𝗵𝗲𝗰𝗸 𝘆𝗼𝘂𝗿 𝗰𝗮𝗿𝗱𝘀. 🍃
𝗖𝘂𝗿𝗿𝗲𝗻𝘁𝗹𝘆 𝗜 𝗵𝗮𝘃𝗲 𝗫 𝗴𝗮𝘁𝗲𝘀 𝗮𝘂𝘁𝗵 𝗮𝗻𝗱 𝗫 𝗴𝗮𝘁𝗲𝘀 𝗰𝗵𝗮𝗿𝗴𝗲𝗱, 𝗮𝘀 𝘄𝗲𝗹𝗹 𝗮𝘀 𝗫 𝗧𝗼𝗼𝗹𝘀. 🌷
𝗧𝗼 𝘀𝗵𝗼𝘄 𝘁𝗵𝗲 𝗰𝗼𝗺𝗺𝗮𝗻𝗱𝘀, 𝗰𝗹𝗶𝗰𝗸 /cmds 
𝗧𝗼 𝗼𝗯𝘁𝗮𝗶𝗻 𝗮𝘂𝘁𝗵𝗼𝗿𝗶𝘇𝗮𝘁𝗶𝗼𝗻 𝗰𝗼𝗻𝘁𝗮𝗰𝘁 𝗮𝗻 𝗮𝗱𝗺𝗶𝗻 @Y_1_M_1 🌸</b>";
        sendVideox($chatId, $videoURLStart, $caption, $keyboard);
    } else {
        reply_tox($chatId, $message_id, $keyboard, "<code>You are not registered, Register first with</code> /register <code> to use me</code>");
    }
}

//=========START END========//

if (preg_match('/^(\/cmds|\.cmds|!cmds)/', $text)) {
    $videoUrl = "https://t.me/bot_checkyousef/3";
    $keyboard2 = json_encode([
        'inline_keyboard' => [
            [
                ['text' => '𝗚𝗔𝗧𝗘𝗦', 'callback_data' => 'gates'],
                ['text' => '𝗧𝗼𝗼𝗹𝘀', 'callback_data' => 'herr'],
                ['text' => '𝗣𝗿𝗶𝗰𝗲', 'callback_data' => 'price'],
            ],
            [
            ],
            [
                ['text' => '𝗢𝗳𝗳𝗶𝗰𝗶𝗮𝗹 𝗚𝗿𝗼𝘂𝗽', 'callback_data' => 'channel'],
            ],
        ]
    ]);

    $caption = "<b>𝑾𝒆𝒍𝒄𝒐𝒎𝒆 𝒕𝒐 𝒎𝒚 𝒄𝒐𝒎𝒎𝒂𝒏𝒅 𝒔𝒆𝒄𝒕𝒊𝒐𝒏 
    
𝑬𝒙𝒑𝒍𝒐𝒓𝒆 𝒎𝒆 𝒎𝒐𝒓𝒆 𝒃𝒚 𝒄𝒍𝒊𝒄𝒌𝒊𝒏𝒈 𝒕𝒉𝒆 𝒃𝒖𝒕𝒕𝒐𝒏𝒔 𝒃𝒆𝒍𝒐𝒘 🌏</b>";

    file_get_contents("https://api.telegram.org/bot$botToken/deleteMessage?chat_id=$chatId&message_id=$messageId");

    // Using sendVideo endpoint instead of sendPhoto
    file_get_contents("https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoUrl&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard2");
}
