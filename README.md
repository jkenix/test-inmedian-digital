# Тестовое задание на должность "Веб-программист" для компании "Inmedian Digital". ⚡   

Цель: Сверстать макет по ТЗ. Макеты лежат в директории **Web**.   

[Главный макет здесь](https://github.com/jkenix/test-inmedian-digital/blob/main/web/test_01.psd) 🔗   

[ТЗ здесь](https://github.com/jkenix/test-inmedian-digital/blob/main/web/%D0%9E%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5.txt) 🔗   

## Порядок запуска проекта:   
1. Открыть текущую директорию в редакторе.
2. Запустить локальный сервер. Например через расширение PHP Server в VS Code. Либо через XAMPP, разместив директорию по пути ***xampp/htdocs/***.
3. По пути сервера открыть файл **index.html** (например: https://localhost:4433/test-inmedian-digital/index.html) Либо запустить файл на через расширения для локального сервера.

---

Механизм отправки настраивается в файле **send.php**.   
Пароль почты берется из "Пароля приложения" Google аккаунта. [Можно задать здесь](https://myaccount.google.com/u/2/apppasswords?roistat_visit=1659506&rapt=AEjHL4P7U_5-hsFqwJGbXV0QObfu-VHNLBbTtR0Xc0gsisxPVokSdz7V5IfWLSNxDEwoYxlCrPf_YAAqmTyCQf3bSo3bYbagDdHo0KYPgkTofddztyrK-N8).   
По умолчанию стоит пароль приложения для моей почты.   

Например:   

![password mail](/web/password_email.png)   

Получатель письма указывается в виде: ***$mail->addAddress('jkenixx@gmail.com');***   
Можно выбрать несколько получателей.   

Приходящее письмо:   

![password mail](/web/email.png)   