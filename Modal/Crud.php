<?php 
    class Crud 
    {
        protected $host = 'localhost';
        protected $dbase = 'phpcrud';
        protected $username = 'root';
        protected $pass = '';
        protected $connect;
        
        //connect to database
        public function _connect($encoded)
        {
            $decoded = json_decode($encoded);
            $this->host = $decoded->{'host'};
            $this->username = $decoded->{'username'};
            $this->pass = $decoded->{'password'};
            $this->dbase = $decoded->{'dbase'};
            try 
            {
                $this->connect = new mysqli($this->host, $this->username , 
                $this->pass, $this->dbase);
            }catch (Exception $e)
            {
                echo 'Error'.$e->getMessage();
            }
            return $this->connect;
        }
        //create and store data to database
        public function _create($id)
        {
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $thoughts = $_POST['thoughts'];
                
                $sql = $this->connect->prepare("INSERT INTO thoughts (name, data_input, user_id) VALUES (?,?,?)");
                $sql->bind_param('sss', $name, $thoughts, $id);
                if($sql->execute())
                {
                    echo "<script>$('#parent').load(location.href + ' #parent');
                    </script>"; 
                }else 
                {
                    echo $this->connect->error;
                }
                
            }
        }
        //read data from the database
        public function _read($id)
        {
            $query = "SELECT * FROM thoughts WHERE user_id = '$id' ORDER BY id DESC";
            $sql = self::_connect()->query($query);
            if($sql->num_rows > 0)
            {
                try
                { 
                    foreach($sql as $row)
                    {   
                        $data[] = $row;
                    }
                }catch(Exception $e)
                {
                    echo 'Error: '.$e->getMessage();
                }
                return $data;
            }
        }
        //update data the return reload parent div
        public function _update($id)
        {
           if(isset($_POST['update']))
           {
                $name = $_POST['name'];
                $thoughts = $_POST['thoughts'];
               
                $sql = self::_connect()->prepare("UPDATE thoughts SET name=?, data_input=?, date=current_timestamp WHERE id=?");
                $sql->bind_param('sss', $name, $thoughts, $id);
                
                if($sql->execute())
                {
                    echo "<script>$('#parent').load(location.href + ' #parent');</script>"; 
                }else 
                {
                    echo $this->connect->error;
                }
           }
        }
        //delete data then return reload parent div
        public function _delete($id, $user_id)
        {
            self::_connect();
            $sql = $this->connect->query("DELETE FROM thoughts WHERE id='$id'");
            if($sql)
            {
                return header("Location:./home.php?id=$user_id");
            }else
            {
                echo $this->connect->error;
            }
        }
    }
    //class for login and register, extend crud class to use connect function
    class LoginRegister extends Crud
    {
        public function _login($login_data){
            $decoded = json_decode($login_data);
            $username = $decoded->{'username'};
            $password = $decoded->{'password'};

            $stmt = parent::_connect()->prepare("SELECT user_id, fullname, username, password FROM users WHERE username=?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $fullname, $db_username, $db_password); // get variables from result.
            $stmt->fetch();

            if($stmt->num_rows == 1) {
                if(password_verify($password, $db_password)){
                    SESSION_START();
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['username'] = $username;
                    return header("Location: ./home.php/?id=".$user_id);
                }else{
                    return header("Location: ../index.php?error=password&name=$username");
                }
            }else {
                return header("Location: ../index.php?error=invalid-user");
            }

        }
        //register user account
        public function _register($register_data){
            $decoded = json_decode($register_data);
            $fullname = $decoded->{'fullname'};
            $username = $decoded->{'username'};
            $password = password_hash($decoded->{'password'}, PASSWORD_BCRYPT);

            $stmt = parent::_connect()->prepare("SELECT username FROM users WHERE username=?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($db_username); 
            $stmt->fetch();
            if($stmt->num_rows == 1){
                return header("Location: ../index.php?error=username&name=$fullname");
            }else{
                $sql = parent::_connect()->prepare("INSERT INTO users (user_id, fullname, username, password) VALUES (?, ?, ?, ?)");
                $sql->bind_param('ssss', uniqid('', true), $fullname, $username, $password);
                if($sql->execute())
                {
                    return header('Location: ../index.php?success=true'); 
                }else 
                {
                    return $this->connect->error;
                }
            }
        }

        
    }
    
?>