function juhuslikPilt()
{
    const pildid = [
        '../../images/1.png', // https://nikitalitvinenko24.thkit.ee/wp/wp-content/uploads/2025/10/1.png
        '../../images/2.png', // https://nikitalitvinenko24.thkit.ee/wp/wp-content/uploads/2025/10/2.png
        '../../images/3.png', // https://nikitalitvinenko24.thkit.ee/wp/wp-content/uploads/2025/10/3.png
        '../../images/4.png', // https://nikitalitvinenko24.thkit.ee/wp/wp-content/uploads/2025/10/4.png
    ];

    // html failis määratud pilt kus id = pilt
    const pilt = document.getElementById('pilt');

    // Math.floor - ümardamine
    // Math.random - juhuslik arv
    // pildid.length - elementide arv piltide massiivis
    const randPilt = Math.floor(Math.random() * pildid.length);

    pilt.src = pildid[randPilt];
    arvutaPildiHind();
}

function teeOmaValik()
{
    const pilt = document.getElementById('pilt');
    const vastus = document.getElementById('vastus');
    const valikud = document.getElementsByName('valikud'); // mitu elemendi ühe nimega valikud

    // Tsükl for
    for (let i = 0; i < valikud.length; i++)
    {
        if (valikud[i].value && pilt.getAttribute('src') === valikud[i].value)
        {
            vastus.innerHTML = 'Sinu vastus on õige';
            vastus.style.color = 'green';
        }
        else
        {
            vastus.innerHTML = 'Mõtle veel, sa vastasid valesti!';
            vastus.style.color = 'red';
        }
    }
}

const NAGU_PILT = 2.3;
const AUTO_PILT = 2.2;
const PUU_PILT = 0;
const TAHT_PILT = 1;

function arvuta(hind, kogus)
{
    // .toFixed(2) - võtab 2 numbre peale koma
    return (kogus * hind).toFixed(2);
}

function arvutaPildiHind()
{
    const summa = document.getElementById('summa');
    const kogus = document.getElementById('kogus').value;
    const pilt = document.getElementById('pilt');
    const src = pilt.getAttribute('src');

    if (src === '../../images/1.png')
        summa.innerHTML = arvuta(NAGU_PILT, kogus) + ' €';
    else if (src === '../../images/2.png')
        summa.innerHTML = arvuta(AUTO_PILT, kogus) + ' €';
    else if (src === '../../images/3.png')
        summa.innerHTML = arvuta(PUU_PILT, kogus) + ' €';
    else if (src === '../../images/4.png')
        summa.innerHTML = arvuta(TAHT_PILT, kogus) + ' €';
}

/* Ülesanne. Veebikalkulaator.
1. Radio-nupude (5tk) valikust vahetub pilt.
2. Küsitakse kogus ja näitakse lõpphind mis sõltub pildist ja kogusest
3. Lisa veel oma tingumus.
4. Kui JS töötab, lisa CSS kujundust ja lisa WP uus leht ja pane JS koodi
*/

const BREAD_IMG = 'https://png.pngtree.com/png-clipart/20240312/original/pngtree-bakery-bread-milky-plain-white-bread-png-image_14566757.png';
const BLACK_BREAD_IMG = 'https://static.vecteezy.com/system/resources/previews/054/402/543/non_2x/brown-rye-bread-slices-free-png.png';
const WHEAT_BREAD_IMG = 'https://cdn.s-cloud.fi/v1/w750_h750_q75/assets/dam-id/CeuIRuTW4qSBcZnoVi6ndC.jpg';
const RYE_BREAD_IMG = 'https://cdn.barbora.ee/products/e28dcaaf-7c0c-4c75-8c85-406b1ee67699_m.png';
const BAGUETTE_BREAD_IMG = 'https://cdn.barbora.ee/products/c7ae5ef8-90af-487c-b68e-c1bcf67ae0ff_m.png';

const BREAD_PRICE = 1.5;
const BLACK_BREAD_PRICE = 1.4;
const WHEAT_BREAD_PRICE = 3;
const RYE_BREAD_PRICE = 2.1;
const BAGUETTE_BREAD_PRICE = 4;

let selectedImg = '';

function onImageChange()
{
    const img = document.getElementById('kpilt');
    const rv1 = document.getElementById('pilt1');
    const rv2 = document.getElementById('pilt2');
    const rv3 = document.getElementById('pilt3');
    const rv4 = document.getElementById('pilt4');
    const rv5 = document.getElementById('pilt5');
    const summa = document.getElementById('ksumma');
    let num = document.getElementById('kkogus').value;

    if (num < 0)
        num = 0;

    if (rv1.checked)
    {
        selectedImg = BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(BREAD_PRICE, num) + ' €';
    }
    else if (rv2.checked)
    {
        selectedImg = BLACK_BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(BLACK_BREAD_PRICE, num) + ' €';
    }
    else if (rv3.checked)
    {
        selectedImg = WHEAT_BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(WHEAT_BREAD_PRICE, num) + ' €';
    }
    else if (rv4.checked)
    {
        selectedImg = RYE_BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(RYE_BREAD_PRICE, num) + ' €';
    }
    else if (rv5.checked)
    {
        selectedImg = BAGUETTE_BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(BAGUETTE_BREAD_PRICE, num) + ' €';
    }
    else
    {
        selectedImg = BREAD_IMG;
        summa.innerHTML = 'Summa: ' + calcPrice(BREAD_PRICE, num) + ' €';
    }

    img.src = selectedImg;
}

const TAX = 5; // %

function calcPrice(price, num)
{
    let tax = price * (TAX / 100);
    let priceT = price + tax;
    return (priceT * num).toFixed(2);
}