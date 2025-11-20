<h1>Random pilti näitamine</h1>

<table>
    <tr>
        <td>
            <img id="pilt" alt="Juhuslik Pilt" src=".">
            <br>
            <input type="button" value="Juhuslik pilt" onclick="juhuslikPilt()">
        </td>
        <td id="vastus">
            Vastus:
        </td>
        <td>
            <label for="valikud">Vali mida sa näed pildil</label>
            <br>
            <select name="valikud" id="valikud" onchange="teeOmaValik()">
                <option value="">...</option>
                <option value="images/1.png">Nagu</option>
                <option value="images/2.png">Auto</option>
                <option value="images/3.png">Puu</option>
                <option value="images/4.png">Täht</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label for="kogus">Mitu tk soovid osta?</label>
            <input type="number" id="kogus" min="1" max="100" value="10" oninput="arvutaPildiHind()">
        </td>

        <td>Summa:</td>
        <td id="summa"></td>
    </tr>
</table>

<br>

<h2>Leivakalkulaator</h2>

<table>
    <tr>
        <td>
            <div>
                <input type="radio" id="pilt1" name="kpildid" value="" onchange="onImageChange()" checked>
                <label for="pilt1">Valge leib</label>
            </div>

            <div>
                <input type="radio" id="pilt2" name="kpildid" value="" onchange="onImageChange()">
                <label for="pilt2">Must leib</label>
            </div>

            <div>
                <input type="radio" id="pilt3" name="kpildid" value="" onchange="onImageChange()">
                <label for="pilt3">Täisteraleib</label>
            </div>

            <div>
                <input type="radio" id="pilt4" name="kpildid" value="" onchange="onImageChange()">
                <label for="pilt4">Rukkileib</label>
            </div>


            <div>
                <input type="radio" id="pilt5" name="kpildid" value="" onchange="onImageChange()">
                <label for="pilt5">Pikk sai</label>
            </div>
        </td>

        <td>
            <img id="kpilt" alt="Leib pilt" src="." style="width: 130px; height: 130px">
        </td>
    </tr>
    <tr>
        <td>
            <label for="kkogus">Mitu tk soovid osta?</label>
            <br>
            <input type="number" id="kkogus" min="1" max="100" value="1" oninput="onImageChange()">
        </td>

        <td id="ksumma">Summa:</td>
    </tr>
</table>

<script src="../js/random_images.js" onload="juhuslikPilt(); onImageChange()"></script>