<?php
    require ("config.php");

    // +1 punkt
    function LisaPunkt($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid + 1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    // -1 punkt
    function KustutaPunkt($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid - 1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    function NaitaTabel()
    {
        global $connect;
        $query = $connect->prepare("SELECT id, president, pilt, punktid, lisamisaeg, kommentaarid, avalik FROM valimised");
        $query->bind_result($id, $president, $pilt, $punktid, $lisamisaeg, $kommentaarid, $avalik);
        $query->execute();

        while($query->fetch())
        {
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$president}</td>";
            echo "<td><img src=$pilt' alt='President pilt'></td>";
            echo "<td>$punktid - <a href='?punktid_nulliks=$id'>Nulliks</a></td>";
            echo "<td>{$lisamisaeg}</td>";
            echo "<td><a href='?lisa1punkt={$id}'>+1 punkt</a></td>";
            echo "<td><a href='?lisa-1punkt={$id}'>-1 punkt</a></td>";
            echo "<td><a href='?kustuta={$id}'>Kustuta</a></td>";
            echo "<td>".nl2br(htmlspecialchars($kommentaarid))."</td>";
            echo '<td>
                <form action="?" method="post">
                    <input type="hidden" name="uue_komment_id" value="'.$id.'">

                    <label>
                        <input type="text" name="uus_kommentaar" id="uus_kommentaar">
                    </label>

                    <input type="submit" value="ok">
                </form>
            </td>';
            $tekst = "Näita";
            $seisund = "naita";
            $tekstLehel = "Peidatud";

            if ($avalik == 1)
            {
                $tekstLehel = "Näidatud";
                $seisund = "peida";
                $tekst = "Peida";
            }

            echo "<td class='$seisund'>$tekstLehel - <a href='?$seisund=$id'>$tekst</a></td>";
            echo '</tr>';
        }

        $connect->close();
    }

    function LisaPresident($president, $pilt, $punktid, $avalik)
    {
        global $connect;
        $query = $connect->prepare("INSERT INTO valimised (president, pilt, punktid, avalik, lisamisaeg) VALUES (?, ?, ?, ?, NOW())");
        $query->bind_param("ssii", $president, $pilt, $punktid, $avalik);
        $query->execute();
        $connect->close();
    }

    function KustutaPresident($id)
    {
        global $connect;
        $query = $connect->prepare("DELETE FROM valimised WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    function LisaKommentaar($uus_kommentaar_id, $uus_kommentaar)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET kommentaarid = CONCAT(kommentaarid, ?) WHERE id = ?");
        $komment2 = $uus_kommentaar."\n";
        $query->bind_param("si", $komment2, $uus_kommentaar_id);
        $query->execute();
        $connect->close();
    }

    function NaitaPresident($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET avalik=1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    function PeidaPresident($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET avalik=0 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    function PunktidNulliks($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = 0 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }