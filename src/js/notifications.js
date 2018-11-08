var d = document.getElementById("bulma-notification-box");
d.className += " is-"+modalConfig.type;

document.getElementById("bulma-notify-title").innerHTML = modalConfig.title;
document.getElementById("bulma-notify-title").innerHTML = modalConfig.title;
document.getElementById("bulma-notify-content").innerHTML = modalConfig.text;

window.addEventListener('load', () => {
    let closeBulmaNotify = function() {
        document.getElementById("bulma-notifications").style.display = "none";
    }

    setTimeout(function() {
        closeBulmaNotify();
    }, modalConfig.timer);

    document.getElementById('bulma-notify-close').onclick = closeBulmaNotify;
})