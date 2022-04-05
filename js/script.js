let menu = document.querySelector('#menu');
let side_navigation = document.querySelector('#side-navigation');
let open_menu = false;

addEventListener("load",()=>{
    sessionStorage.setItem("previous-page", location.href);
});

menu.addEventListener('click',()=>{
    if(open_menu === false){
        open_menu = true;
        side_navigation.style.left='0';
    }else{
         open_menu = false;
         side_navigation.style.left='-15em';
    }
});
