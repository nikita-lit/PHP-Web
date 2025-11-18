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
    </pre>
    id_rsa.pub võti kopeeritatakse githubi nagu deploy key
</li>
<li>
    Jälgimise lisamine ja commit'i tegemine
    <pre>
        git status
        git add .
        git commit -a -m "commiti tekst"
    </pre>
</li>
<?php
    echo "<li> GITHUB projektiga sidumine";