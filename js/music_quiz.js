let viga = false;

function onMusicQuizLoad()
{
    $(".viga").hide();

    $("#saada").click(() =>
    {
        $("#kokkuvote").hide();
        viga = false;

        if (musicianChoice === "")
        {
            $("#viga_muusika").show();
            viga = true;
        }
        else
        {
            $("#viga_muusika").hide();
        }

        if (opinionText.length < 10)
        {
            $("#viga_arvamus").show();
            viga = true;
        }

        if (musicDays === "")
        {
            $("#viga_tundi").show();
            viga = true;
        }

        if (listeningRadio === "")
        {
            $("#viga_radio").show();
            viga = true;
        }

        if(radioStations === "")
        {
            $("#viga_raadiojaam").show();
            viga = true;
        }

        if (favMusic === "")
        {
            $("#viga_fav").show();
            viga = true;
        }

        send();
    });
}

let musicianChoice = "";
let opinionText = "";
let musicDays = "";
let listeningRadio = "";
let radioStations = "";
let favMusic = "";

function onMusician()
{
    let muusik1 = document.getElementById("muusik1");
    let muusik2 = document.getElementById("muusik2");
    let muusik3 = document.getElementById("muusik3");
    let muusik4 = document.getElementById("muusik4");
    let muusik5 = document.getElementById("muusik5");
    let v1 = document.getElementById("vastus1");

    musicianChoice = "";
    if (muusik1.checked)
        musicianChoice += muusik1.value + ", ";

    if (muusik2.checked)
        musicianChoice += muusik2.value + ", ";

    if (muusik3.checked)
        musicianChoice += muusik3.value + ", ";

    if (muusik4.checked)
        musicianChoice += muusik4.value + ", ";

    if (muusik5.checked)
        musicianChoice += muusik5.value;

    if (musicianChoice !== "")
        v1.innerText = "Sinu valitud muusikud: " + musicianChoice;
    else
        v1.innerText = "";

    $("#viga_muusika").hide();
}

function onMusicOpinion()
{
    let opinion = document.getElementById("arvamus");
    let v2 = document.getElementById("vastus2");
    opinionText = opinion.value;

    if (opinionText !== "")
        v2.innerText = "Sinu arvamus: " + opinionText;
    else
        v2.innerText = "";

    if (opinionText.length >= 10)
        $("#viga_arvamus").hide();
}

function onMusicRange()
{
    let range = document.getElementById("range");
    let v3 = document.getElementById("vastus3");
    musicDays = range.value;

    if (musicDays !== "")
        v3.innerText = "Sa kuulad umbes " + musicDays + " tundi päevas.";
    else
        v3.innerText = "";

    $("#viga_tundi").hide();
}

function onRadioListening()
{
    let rv1 = document.getElementById("radiok-vastus1");
    let rv2 = document.getElementById("radiok-vastus2");
    let v4 = document.getElementById("vastus4");
    listeningRadio = "";

    if (rv1.checked)
        listeningRadio = "Jah";
    else if (rv2.checked)
        listeningRadio = "Ei";

    v4.innerText = "Kas sa kuulad raadiot: " + listeningRadio;
    $("#viga_radio").hide();
}

function onRadioStation()
{
    let radioStation = document.getElementById("raadiojaam");
    let v5 = document.getElementById("vastus5");
    radioStations = radioStation.value

    if (radioStations !== "")
        v5.innerText = "Sinu nimetatud jaamad: " + radioStations;
    else
        v5.innerText = "";

    $("#viga_raadiojaam").hide();
}

function onFavouriteMusicStyle()
{
    let v6 = document.getElementById("vastus6");
    let music = document.getElementById("muusikat");
    favMusic = music.value;

    if(music.selectedIndex !== 0)
        v6.innerText = "Sinu vastus: " + favMusic;
    else
        v6.innerText = "Tee ripploendi lahti ja vali";

    $("#viga_fav").hide();
}

function clean()
{
    let form = document.getElementById("vorm");
    form.reset();

    document.getElementById("kmuusik").innerText = "";
    document.getElementById("karvamus").innerText = "";
    document.getElementById("krange").innerText = "";
    document.getElementById("kradiok").innerText = "";
    document.getElementById("kraadiojaam").innerText = "";
    document.getElementById("kmuusikat").innerText = "";
    document.getElementById("kokkuvote").style.display = "none";

    document.getElementById("vastus1").innerText = "";
    document.getElementById("vastus2").innerText = "";
    document.getElementById("vastus3").innerText = "";
    document.getElementById("vastus4").innerText = "";
    document.getElementById("vastus5").innerText = "";
    document.getElementById("vastus6").innerText = "";

    musicianChoice = "";
    opinionText = "";
    musicDays = "";
    listeningRadio = "";
    radioStations = "";
    favMusic = "";

    $("#viga_raadiojaam").hide();
    $("#viga_tundi").hide();
    $("#viga_arvamus").hide();
    $("#viga_fav").hide();
    $("#viga_muusika").hide();
    $("#viga_radio").hide();
}

function send()
{
    if (viga)
        return;

    document.getElementById("kokkuvote").style.display = "flex";
    document.getElementById("kmuusik").innerText = "Muusikud: " + musicianChoice;
    document.getElementById("karvamus").innerText = "Arvamus koolimuusikast: " + opinionText;
    document.getElementById("krange").innerText = "Kuulamise aeg päevas: " + musicDays;
    document.getElementById("kradiok").innerText = "Kuulad raadiot: " + listeningRadio;
    document.getElementById("kraadiojaam").innerText = "Raadiojaamad: " + radioStations;
    document.getElementById("kmuusikat").innerText = "Muusikat on kõige rohkem kuulab: " +  favMusic;

    $("#viga_raadiojaam").hide();
    $("#viga_tundi").hide();
    $("#viga_arvamus").hide();
    $("#viga_fav").hide();
    $("#viga_muusika").hide();
    $("#viga_radio").hide();
}