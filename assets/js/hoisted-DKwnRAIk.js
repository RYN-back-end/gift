document.addEventListener('click', function(event) {
    if (event.target.classList.contains('openDropDown')) {
        var dropId = event.target.getAttribute('data-drop');
        var elm = document.getElementById(dropId);
        console.log(dropId)
        console.log(elm.innerHTML)
        if (elm.classList.contains('open')) {
            elm.classList.remove('open');
        } else {
            elm.classList.add('open');
        }
    }
});
