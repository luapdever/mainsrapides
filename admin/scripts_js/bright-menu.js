var all_menus = document.querySelectorAll('.treeview');
for(let i=0; i<all_menus.length; i++) {
    if(window.location.href.includes(all_menus[i].id)) {
        all_menus[i].classList.add('active');
        break;
    }
}