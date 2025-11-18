<h1>MUUSIKA KÜSITLUS</h1>

<div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    <form id="vorm">
        <table>
            <tr>
                <th>Küsimused</th>
                <th>Vastused</th>
            </tr>

            <tr>
                <td>Milliseid muusikuid/ansambleid sa tead?</td>
                <td>
                    <input type="checkbox" id="muusik1" name="muusik" value="Ludwig van Beethoven" onchange="onMusician()">
                    <label for="muusik1">Ludwig van Beethoven</label>
                    <br>

                    <input type="checkbox" id="muusik2" name="muusik" value="Eminem" onchange="onMusician()">
                    <label for="muusik2">Eminem</label>
                    <br>

                    <input type="checkbox" id="muusik3" name="muusik" value="The Weeknd" onchange="onMusician()">
                    <label for="muusik3">The Weeknd</label>
                    <br>

                    <input type="checkbox" id="muusik4" name="muusik" value="Wolfgang Amadeus Mozart" onchange="onMusician()">
                    <label for="muusik4">Wolfgang Amadeus Mozart</label>
                    <br>

                    <input type="checkbox" id="muusik5" name="muusik" value="Linkin Park" onchange="onMusician()">
                    <label for="muusik5">Linkin Park</label>
                    <br>
                    <br>

                    <div id="vastus1"></div>
                    <span class="viga" id="viga_muusika">*Valige vähemalt üks muusik!</span>
                </td>
            </tr>

            <tr>
                <td>Mida arvad muusika kuulamisest koolis?</td>
                <td>
                    <textarea id="arvamus" name="arvamus" rows="3" oninput="onMusicOpinion()"></textarea>
                    <div id="vastus2"></div>
                    <span class="viga" id="viga_arvamus">*Sisestage vähemalt 10 tähemärki!</span>
                </td>
            </tr>

            <tr>
                <td>Mitu tundi päevas sa kuulad muusikat?</td>
                <td>
                    0
                    <input type="range" id="range" min="0" max="10" step="1" oninput="onMusicRange()">
                    10
                    <div id="vastus3"></div>
                    <span class="viga" id="viga_tundi">*Valige tundi!</span>
                </td>
            </tr>

            <tr>
                <td>Kas sa kuulad raadiot?</td>
                <td>
                    <div>
                        <input type="radio" name="radiok" id="radiok-vastus1" value="Jah" onchange="onRadioListening()">
                        <label for="radiok-vastus1">Jah</label>
                    </div>

                    <div>
                        <input type="radio" name="radiok" id="radiok-vastus2" value="Ei" onchange="onRadioListening()">
                        <label for="radiok-vastus2">Ei</label>
                    </div>

                    <div id="vastus4"></div>
                    <span class="viga" id="viga_radio">*Valige kahe valiku vahel!</span>
                </td>
            </tr>

            <tr>
                <td>Milliseid raadiojaamu oskad nimetada?</td>
                <td>
                    <input type="text" id="raadiojaam" name="raadiojaam" oninput="onRadioStation()">
                    <div id="vastus5"></div>
                    <span class="viga" id="viga_raadiojaam">*Kirjutage midagi!</span>
                </td>
            </tr>

            <tr>
                <td>Millist muusikat sa kõige rohkem kuulad?</td>
                <td>
                    <select name="muusikat" id="muusikat" onchange="onFavouriteMusicStyle()">
                        <option value="">vali...</option>
                        <option value="Räpp">Räpp</option>
                        <option value="Pop">Pop</option>
                        <option value="Retro">Retro</option>
                        <option value="Country">Country</option>
                        <option value="Rock">Rock</option>
                    </select>
                    <div id="vastus6"></div>
                    <span class="viga" id="viga_fav">*Valige!</span>
                </td>
            </tr>
        </table>

        <div style="margin-top: 5px">
            <input type="button" class="button" id="saada" value="Saada">
            <input type="button" class="button" id="puhasta" value="Puhasta" onclick="clean()">
        </div>
    </form>

    <fieldset id="kokkuvote" style="display: none;">
        <legend>Kokkuvõte</legend>
        <div id="kmuusik"></div>
        <div id="karvamus"></div>
        <div id="krange"></div>
        <div id="kradiok"></div>
        <div id="kraadiojaam"></div>
        <div id="kmuusikat"></div>
    </fieldset>
</div>

<script src="../js/music_quiz.js" onload="onMusicQuizLoad()"></script>