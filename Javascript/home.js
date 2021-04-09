const form_main = document.querySelector('.form-main');
const btn_submit = document.getElementById('btn-submit');
const btn_update = document.getElementById('btn-update');

btn_submit.addEventListener('click', event =>{ 
   const name = document.getElementById('name');
   const thoughts = document.getElementById('thoughts');
   const error = document.getElementsByClassName('error');
   
    if(name.value == '' || name.value == null){
        thoughts.classList.remove('border-danger','shadow-none');
        name.classList.add('border-danger','shadow-none');
        error[0].textContent = "Name is required!"
        event.preventDefault();
        return;
    }
    if(thoughts.value == '' || thoughts.value == null){
        name.classList.remove('border-danger','shadow-none');
        thoughts.classList.add('border-danger','shadow-none');
        error[0].textContent = "This field is required!"
        event.preventDefault();
        return;
    }
    
});
if(btn_update != null){
    btn_update.addEventListener('click', event=>{
        
        event.preventDefault();
        const name_input = document.getElementById('name-input');
        const thoughts_input = document.getElementById('thoughts-input');
        const error = document.getElementById('error');
        if(name_input.value == '' || name_input.value == null){
            thoughts_input.classList.remove('border-danger','shadow-none');
            name_input.classList.add('border-danger','shadow-none');
            error.textContent = "Name is required!"
            event.preventDefault();
            return;
        }
        if(thoughts_input.value == '' || thoughts_input.value == null){
            name_input.classList.remove('border-danger','shadow-none');
            thoughts_input.classList.add('border-danger','shadow-none');
            error.textContent = "This field is required!"
            event.preventDefault();
            return;
        }
    });
}
const btn_delete = document.getElementsByClassName('btn-delete');

for(let i = 0; i < btn_delete.length; i++){
  btn_delete[i].addEventListener('click', event =>{
  event.preventDefault();
  const form_delete = document.getElementById('form-delete');
  form_delete.action = '/php crud/delete.php?id='+btn_delete[i].value;
});
}

$(function () {
    $(document).scroll(function () {
        var $nav = $(".navbar");
        var $float = $(".float-form");
        $nav_scrolled = $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        if($(this).scrollTop() > 240){
            $float.removeClass('form-floating');
        }else{
            $float.addClass('form-floating');
        }
      });
  });
