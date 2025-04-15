// Функция отправки формы
async function submitForm(event) {
    event.preventDefault(); // отключаем перезагрузку/перенаправление страницы
    try {
        // Формируем запрос
        const response = await fetch(event.target.action, {
            method: "POST",
            body: new FormData(event.target),
        });
        // проверяем, что ответ есть
        if (!response.ok)
            throw `Ошибка при обращении к серверу: ${response.status}`;
        // проверяем, что ответ действительно JSON
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            throw "Ошибка обработки. Ответ не JSON";
        }
        // обрабатываем запрос
        const json = await response.json();
        if (json.result === "success") {
            // в случае успеха
            alert(json.info);
            console.log(json.info);
            location.reload(); // Перезагружаем страницу
        } else {
            // в случае ошибки
            console.log(json);
            throw json.info;
        }
    } catch (error) {
        // обработка ошибки
        alert(error);
        console.log(error);
    }
}

// Ждем, пока весь контент документа будет загружен
document.addEventListener("DOMContentLoaded", () => {

    // Находим поле с номером
    const phoneInput = document.querySelector(".offer__number");
    // Добавляем обработчики событий для ПК и мобильных устройств:
    phoneInput.addEventListener("focus", () => {
        phoneInput.classList.add('offer__number--is-visible');
    });
    phoneInput.addEventListener("input", (e) => {
        inputphone(e, phoneInput);
    });
    phoneInput.addEventListener("blur", () => {
        if (!phoneInput.value) {
            phoneInput.classList.remove('offer__number--is-visible');
        }
    });

    // ------------------------

    // Подключение к полю телефона
    document.querySelector("#phone").onkeydown = function (e) {
        inputphone(e, document.querySelector("#phone"));
    };

    // Функция маски формат +7 (
    function inputphone(e, phone) {
        function stop(evt) {
            evt.preventDefault();
        }
        let key = e.key,
            v = phone.value;
        not = key.replace(/([0-9])/, 1);

        if (not == 1 || "Backspace" === not) {
            if ("Backspace" != not) {
                if (v.length < 3 || v === "") {
                    phone.value = "+7(";
                }
                if (v.length === 6) {
                    phone.value = v + ")";
                }
                if (v.length === 10) {
                    phone.value = v + "-";
                }
                if (v.length === 13) {
                    phone.value = v + "-";
                }
            }
        } else {
            stop(e);
        }
    }
});
