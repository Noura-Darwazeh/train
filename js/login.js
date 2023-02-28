const pass_field = document.querySelector('.pass-key');
const showBtn = document.querySelector('.show');
showBtn.addEventListener('click', function(){
if(pass_field.type === "password")
{
    pass_field.type= "text";
    showBtn.textContent = "hide";
    showBtn.style.color = "#A9A9A9";
}else{
    pass_field.type="password";
    showBtn.textContent = "show";
    showBtn.style.color = "black";
}



}



);