<?php
    include_once ("classes/dbh.php");

    class Users extends Dbh
    {
        public function ShowUsers()
        {
            $query = $this->GetConnection()->prepare("SELECT id, username, email, role, reg_date FROM users");
            $query->bind_result($id, $username, $email, $role, $reg_date);
            $query->execute();

            echo "<table id='user_table'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Kasutajanimi</th>
                    <th>Email</th>
                    <th>Roll</th>
                    <th>Registreerimise kuupäev</th>
                </tr>";

            while ($query->fetch())
            {
                echo "<tr>";
                echo "<td>".$id."</td>";
                echo "<td>".$username."</td>";
                echo "<td>".$email."</td>";
                echo "<td>".$role."</td>";
                echo "<td>".$reg_date."</td>";
                echo "</tr>";
            }
            echo "</table>";


            $query->close();
        }
    }