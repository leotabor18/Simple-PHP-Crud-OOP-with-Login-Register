<?php 
    if(isset($_GET['error'])){
        switch ($_GET['error']){
            case 'username':
                $name = $_GET['name'];
                echo "<script>document.getElementById('Modal').style.display = 'block';
                document.getElementById('fullname').value = '".$name."';
                document.getElementById('username').classList.add('border-danger');
                document.getElementById('error-register').textContent = 'Username Already Exists!'</script>";
                break;
            case 'password':
                $name = $_GET['name'];
                echo "<script>document.getElementById('Modal-login').style.display = 'block';
                const name = document.getElementById('name');
                name.value = '".$name."';
                document.getElementById('login_password').classList.add('border-danger');
                document.getElementById('error-login').textContent = 'Invalid Password!'</script>";
                break;
            default:
                echo "<script>document.getElementById('Modal-login').style.display = 'block';
                document.getElementById('error-login').textContent = `Username doesn't exist!`</script>";
                break;
        }
        
    }
    if(isset($_GET['success'])){
        echo "<script>document.getElementById('Modal-login').style.display = 'block';
        const success = document.getElementById('success');
            success.style.color = 'blue';
            success.textContent = 'Successfully Registered!'</script>";
    }
    
    ?>