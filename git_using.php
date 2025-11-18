<?php
    echo "<h1>Repo loomine</h1>";
    echo "<ol>";
    echo "<li><pre>git init</pre></li>";?>
<li>
    Konfigureerimine
    <pre>
        git config --global user.name "nikita-lit"
        git config --global user.email "nikitalitvinenko28@gmail.com"
        git config --global --list
    </pre>
</li>
<li>
    SSH võti loomine
    <pre>
        ssh-keygen -o -t rsa -C "nikitalitvinenko28@gmail.com"

        * id_rsa.pub võti kopeeritatakse githubi nagu deploy key
    </pre>
</li>
<li>
    Jälgimise lisamine ja commit'i tegemine
    <pre>
        git status
        git add .
        git commit -a -m "commiti tekst"
    </pre>
</li>
<li>
    GITHUB projektiga sidumine
    <pre>
        git remote add origin git@github.com:nikita-lit/PHP-Web.git
        git branch -M main
        git push -u origin main
    </pre>
</li>
<li>
    Projekti kloonimine desktopile
    <pre>
        * Kontroll et id_rsa võti on olemas .ssh kaustas
        * GIT CMD on lahti
        git clone git@github.com:nikita-lit/PHP-Web.git;
    </pre>
</li>