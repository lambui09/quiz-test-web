{
    let time = 900;
    let round = (time) => {
        if (time < 10) {
            return '0' + time;
        }
        return time;
    };
    let getTime = (time) => {
        return round(Math.floor(time / 60)) + ":" + round(Math.floor(time % 60));
    };
    let inter = setInterval(count, 1000);

    function count() {
        document.getElementById('timer').innerHTML = getTime(time);
        time--;
        if (time <= 0) {
            clearInterval(inter);
            document.forms.test.submit();
        }
    }
}