function playGuess() {
    var answer = parseInt(Math.random() * 100);

    while (true) {
        var userAnswer = prompt(' Введите число от 0 до 100. Для выхода нажмите q');
        if (userAnswer == 'q') {
            break;
        }
        userAnswer = parseInt(userAnswer);

        if (userAnswer > answer) {
            alert('Ваш ответ слишком большой');
        } else if (userAnswer < answer) {
            alert('Ваш ответ слишком маленький');
        } else if (userAnswer == answer) {
            alert('Вы угадали! Выиграл игрок: ');
            break;
        } else {
            alert('Необходимо ввести число!');
        }
    }
}
