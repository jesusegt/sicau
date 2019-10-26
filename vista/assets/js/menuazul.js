function mostrar(){

	var submenu = document.getElementById('submenu-usuario');

	if(submenu.style.display=='none'){
        submenu.style.display='block';
    }
    else{
        submenu.style.display='none';
    }

    return false;
}