<?php
    include_once ("classes/dbh.php");

    class Authorization extends DBH
    {
        public function RegisterUser($username, $email, $password)
        {
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
            {
                echo "<script>alert('Kasutajanimi võib sisaldada ainult tähti ja numbreid!');</script>";
                return false;
            }

            if ($this->IsUserExist($username, $email))
            {
                echo "<script>alert('Kasutajanimi või e-post on juba kasutusel!');</script>";
                return false;
            }

            $connect = $this->GetConnection();
            $query = $connect->prepare("INSERT INTO users (username, email, password, reg_date) VALUES (?, ?, ?, NOW())");
            $query->bind_param("sss", $username, $email, $password);
            $query->execute();

            $this->SetUser($username, $password);
            $query->close();

            return true;
        }

        public function IsUserExist($username, $email)
        {
            $connect = $this->GetConnection();
            $query = $connect->prepare("SELECT 1 FROM users WHERE username = ? OR email = ? LIMIT 1");
            $query->bind_param("ss", $username, $email);

            $query->execute();
            $result = $query->get_result();

            $exists = ($result && $result->num_rows > 0);
            $query->close();

            return $exists;
        }

        public function SetUser($username, $password)
        {
            $connect = $this->GetConnection();
            $query = $connect->prepare("SELECT id, role FROM users WHERE username = ? AND password = ? LIMIT 1");
            $query->bind_param("ss", $username, $password);
            $query->bind_result($id, $role);
            $query->execute();

            $found = false;

            if ($query->fetch())
            {
                $_SESSION["userid"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["userrole"] = $role;
                $found = true;
            }

            $query->close();
            return $found;
        }

        public function LogoutUser()
        {
            $_SESSION = [];
            session_unset();
            session_destroy();
        }

        public function IsUserLoggedIn()
        {
            return isset($_SESSION["username"]);
        }

        public function IsUserAdmin()
        {
            return $this->IsUser("admin");
        }

        public function IsUser($role)
        {
            if (!isset($_SESSION["userrole"]) || $_SESSION["userrole"] != $role)
                return false;
            
            return true;
        }
    }