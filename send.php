<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Устанавливаем значение данных по умолчанию
$data = [];
// Получаем адрес хоста
$url = $_SERVER['HTTP_HOST'];

# проверка, что ошибки нет
if (!error_get_last()) {

    // Переменные, которые отправляет пользователь
    $phone = $_POST['phone'];

    // Формирование самого письма
    $title = "Заявка с формы обратной связи [$url]";
    $body = "
    <h2>Отправлен номер телефона для консультации:</h2>
    <a href='tel:$phone' style='font-size: 1rem'>$phone</a><br>
    <p style='color: gray; font-size: 0.9rem; font-weight: 600; margin-top: 30px; '>Письмо отправлено с сайта <strong>$url</strong></p>
    ";

    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2; // Debug
    $mail->Debugoutput = function ($str, $level) {
        $GLOBALS['data']['debug'][] = $str;
    };

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'jkenixx@gmail.com'; // Логин на почте
    $mail->Password   = 'mevolvsd ogve doec'; // Пароль приложения: https://myaccount.google.com/u/2/apppasswords?roistat_visit=1659506&rapt=AEjHL4P7U_5-hsFqwJGbXV0QObfu-VHNLBbTtR0Xc0gsisxPVokSdz7V5IfWLSNxDEwoYxlCrPf_YAAqmTyCQf3bSo3bYbagDdHo0KYPgkTofddztyrK-N8
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('jkenixx@gmail.com', 'Dmitriy'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('jkenixx@gmail.com');
    // $mail->addAddress('noname@gmail.com'); // Ещё один, если нужен

    // Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($i = 0; $i < count($file['tmp_name']); $i++) {
            if ($file['error'][$i] === 0)
                $mail->addAttachment($file['tmp_name'][$i], $file['name'][$i]);
        }
    }
    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отправленность сообщения
    if ($mail->send()) {
        $data['result'] = "success";
        $data['info'] = "Сообщение успешно отправлено!";
    } else {
        $data['result'] = "error";
        $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
        $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }
} else {
    $data['result'] = "error";
    $data['info'] = "В коде присутствует ошибка";
    $data['desc'] = error_get_last();
}

// Отправка результата
header('Content-Type: application/json');
echo json_encode($data);
