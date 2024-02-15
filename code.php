<?php

function clean($message) {
    return htmlspecialchars(trim($message));
}

function random_strings($length_of_string) {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str_shuffled = str_shuffle($str_result);
    return substr($str_shuffled, 0, $length_of_string);
}

if ((strpos($message, "/code") === 0) || (strpos($message, "!code") === 0) || (strpos($message, ".code") === 0)) {
    $owners = file_get_contents('Database/owner.txt');
    $admins = explode("\n", $owners);
    if (!in_array($userId, $admins)) {
        sendMessage($chatId, "You are Not ADMIN ! ", $messageId);
    } else {
        $command = substr($message, 6);
        $command = clean($command);

        if ($command == ' ' || $command == '') {
            $expiryDays = 1;
            $amountOfCodes = 1;
        } else {
            $cmdExplode = explode('-', $command); // assuming the format is {expiry_days}-{amount_of_codes}
            $expiryDays = (int)$cmdExplode[0];
            $amountOfCodes = (int)$cmdExplode[1];
        }

        $expiryDate = date('d M Y', strtotime("+$expiryDays days")); // setting the key expiry date as provided by the owner

        $credt = array();
        while ($amountOfCodes > 0) {
            $rnds = 'TurkeyCHK-' . random_strings(4) . '-' . random_strings(4) . '-' . random_strings(4);
            $credt[] = $rnds;
            $amountOfCodes = $amountOfCodes - 1;
        }

        foreach ($credt as $code) {
            $credtf = fopen('Database/codes.txt', 'a');
            fwrite($credtf, "[$code|$expiryDays],\n");
            fclose($credtf);
            $formattedCode = "<code>$code</code>";
            $messageToSend = urlencode(
                "𝑲𝒆𝒚 𝑪𝒓𝒆𝒂𝒕𝒆𝒅 🔑\n" .
                "🌟├𝑼𝒔𝒂𝒈𝒆 /redeem\n" .
                "🌟├𝑲𝒆𝒚: $formattedCode\n" .
                "🌟├𝑫𝒂𝒚𝒔: $expiryDays\n" .
                "🌟├𝑻𝒉𝒆 𝒌𝒆𝒚 𝒆𝒙𝒑𝒊𝒓𝒆𝒔: $expiryDate\n" .
                "🌟├𝑹𝒂𝒏𝒌: PREMIUM"
            );
            sendMessage($chatId, $messageToSend, $messageId); // using $messageId instead of $message_id_1
        }
    }
}
?>
