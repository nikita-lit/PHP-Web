function showDate()
{
    let now = new Date();
    let date = now.getDate() + "." + (now.getMonth() + 1) + "." + now.getFullYear();
    let mins = now.getMinutes();
    if (mins < 10)
        mins = "0" + mins

    let time = now.getHours() + ":" + mins;
    let result = document.getElementById("result");
    result.innerHTML = "Kuupäev: " + date + "<br>Kellaaeg: " + time + "<br>Kuupäev ja kellaaeg: " + date + " " + time;
}

function daysToBirthday()
{
    const now = new Date();
    let birthday = new Date(now.getFullYear(), 6, 4);

    if (birthday < now)
        birthday = new Date(now.getFullYear() + 1, 6, 4);

    const ms = birthday.getTime() - now.getTime();
    const days = ms / (1000 * 60 * 60 * 24);

    const result = document.getElementById("result");
    result.innerHTML = "Sünnipäevani: " + days.toFixed(0) + " päeva"
    + "<br> Minu sünnipäeva kuupäev on: 04.06";
}