<?php
    include_once "classes/dbh.php";

    class Authorization extends DBH
    {
        public function RegisterUser($username, $email, $password)
        {
            if ($this->IsUserExist($username, $email))
                return false;

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
            $query = $connect->prepare("SELECT id FROM users WHERE username = ? AND password = ? LIMIT 1");
            $query->bind_param("ss", $username, $password);
            $query->bind_result($id);
            $query->execute();

            if ($query->fetch())
            {
                $_SESSION["userid"] = $id;
                $_SESSION["username"] = $username;
                return true;
            }

            $query->close();
            return false;
        }

        public function LogoutUser()
        {
            $_SESSION = [];
            session_unset();
            session_destroy();
        }
    }