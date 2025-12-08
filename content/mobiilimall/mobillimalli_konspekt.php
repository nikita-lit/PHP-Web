<h1>Mobiilisõbraliku veebilehe loomise konspekt</h1>

<h2>Sissejuhatus</h2>

Ülesanne: Luua mobiilisõbralik veebileht anekdootidega, mis kohandub automaatselt iga seadme ekraaniga (telefon või arvuti).
Ma kasutasin HTML, CSS ja PHP: HTML abil määratlesin lehe struktuuri, CSS abil kujunduse, ning PHP kasutades eraldasin anekdoodid erinevatesse failidesse.

<div>
    <h2>1. Meta Tag</h2>
    <pre>
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    </pre>
    <code>&lt;meta&gt;</code> - lehe seadistusi määrav tag, ei kuvata sisule.<br>
    <code>name="viewport"</code> - ütleb brauserile, et leht kohandub ekraani laiusega.<br>
    <code>content="width=device-width, initial-scale=1.0"</code> - määrab, et lehe laius vastab seadme ekraanile ja algne suurendus on 1.<br>

    <br>
    Tagab, et leht on mobiilil õigesti kuvatud ja CSS media queries töötavad.
</div>

<div>
    <h2>2. CSS - @media</h2>
    <pre>
@media (max-width: 600px) {
    nav {
        padding: 5px;
        text-align: center;
    }
    
    nav a {
        display: block;
        margin: 5px 0;
        padding: 5px;
        background-color: rgb(77, 87, 98);
    }

    .content {
        margin: 5px;
        padding: 10px;
    }

    .footer {
        margin-top: 10px;
    }
}
    </pre>
    <code>@media (max-width: 600px)</code> - stiilid kehtivad ekraanile kuni 600px.

    <br><br>
    Meediapäring võimaldab lehe kujundust kohandada. Kitsastel ekraanidel vähendatakse paddingut ja marginaale, menüü muutub vertikaalseks ning tekst on loetav. See tagab, et kõik elemendid mahuvad ekraanile ja on kasutajasõbralikud.
</div>

<div>
    <h2>Mobiilivaade</h2>
    <p>Telefonis näeb leht välja järgmiselt:</p>
    <ul>
        <li>Menüü muutub vertikaalseks, et säästa ruumi.</li>
        <li>Pildid ja tekst vähenevad või joondatakse ümber.</li>
        <li>Padding ja marginaalid on väiksemad, et kõik elemendid mahuksid ekraanile.</li>
        <li>Anekdoodid kuvatakse loetavalt ühe veeruna.</li>
    </ul>

    <img src="mobiilimall.jpg" alt="Mobiilivaade" style="width: 400px">
</div>