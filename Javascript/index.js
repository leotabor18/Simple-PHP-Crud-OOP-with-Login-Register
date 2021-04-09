//this is for index.php javascript

const form_register = document.querySelector('.form-register');
const form_login = document.querySelector('.form-login');
const btn_register = document.querySelector('#register');
const btn_login = document.querySelector('#login');
const btn_close = document.getElementsByClassName('btn-close');
const error_reg =  document.querySelector('#error-register');
const error_log =  document.querySelector('#error-login');
const input_class = document.getElementsByClassName('form-control');
const success_tag = document.getElementById('success');
const modal = document.getElementsByClassName('modal');
const btn_change = document.getElementsByClassName('btn-change');

close_modal(btn_close);
close_modal(btn_change);

//reset all form when close button from modal is click
function close_modal(btn_click){
  for(let i = 0; i < btn_click.length; i++){
    btn_click[i].addEventListener('click', () =>{
      modal[i].style.display = 'none';
      for(let i = 0; i < input_class.length; i++ ){
        input_class[i].classList.remove('border-danger');
        error_reg.textContent = '';
        error_log.textContent = '';
        form_login.reset();
        form_register.reset();
      }
    });
  }
}
//remove red border function
function remove_border(){
  for(let i = 0; i < input_class.length; i++ ){
    input_class[i].classList.remove('border-danger','shadow-none');
  }
  success_tag.style.display='none';
}
//validation for register form if success, add action link to form-register
btn_register.addEventListener('click', event =>{
  const fullname_id = document.querySelector('#fullname');
  const username_id = document.querySelector('#username');
  const password_id = document.querySelector('#password');
  const cpassword_id = document.querySelector('#confirm_password');
  
  if(fullname_id.value == '' || fullname_id.value == null){
    remove_border('');
    fullname_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Fullname is required!';
    event.preventDefault();

    return ;
  }
  if(username_id.value == '' || username_id.value == null){
    remove_border();
    username_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Username is required!';
    event.preventDefault();

    return ;
  }
  if(password_id.value == '' || password_id.value == null){
    remove_border();
    password_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Password is required!';
    event.preventDefault();

    return ;
  }
  if(password_id.value.length < 8){
    remove_border();
    password_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Password must be 8 characters and above!';
    event.preventDefault();

    return ;
  }
  if(cpassword_id.value == '' || cpassword_id.value == null){
    remove_border();
    cpassword_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Password is required!';
    event.preventDefault();

    return;
  }

  if(cpassword_id.value != password_id.value ){
    remove_border();
    password_id.classList.add('shadow-none','border-danger');
    cpassword_id.classList.add('shadow-none','border-danger');
    error_reg.textContent = 'Password does not match!';
    event.preventDefault();

    return;
  }

  form_register.action = './modal/register.php';
  
});

//validation for login form if success, add action link to login-register
btn_login.addEventListener('click', event =>{
    modal[0].style.display = 'none';
    const username = document.querySelector('#name');
    const pass = document.querySelector('#login_password');

    const name = username.value;
    const password = pass.value;
    
    if(name == '' || name == null){
      remove_border();
      username.classList.add('border-danger');
      error_log.textContent = 'Username is required!';
      event.preventDefault();
      return;
    }
    if(password == '' || password == null){
      remove_border();
      pass.classList.add('border-danger');
      error_log.textContent = 'Password is required!';
      event.preventDefault();
      return;
    }
    form_login.action = './modal/login.php';

});
//
