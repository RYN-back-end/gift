import "./hoisted-DKwnRAIk.js";

let i = document.querySelector(".big-img img"), l = document.querySelectorAll(".allImg div img"), a = 0,
    n = document.querySelector(".detailsSection .more"), o = document.querySelector(".detailsSection .mins"),
    e = document.getElementById("quantiy"), c = t => {
        document.querySelector(".active")?.classList.remove("active"), t.classList.add("active"), i.style.opacity = "0", setTimeout(() => {
            i.style.opacity = "1", i.src = t.src
        }, 500)
    }, r = () => {
        l[0].classList.add("active"), l.forEach(t => {
            t.addEventListener("click", () => c(t))
        })
    }, s = () => {
        a = (a + 1) % l.length, c(l[a])
    };
setInterval(s, 5e3);
r();
let u = () => {
    e.value = (parseInt(e.value) + 1).toString()
}, d = () => {
    e.value === "1" ? (e.value = parseInt(e.value).toString(), console.log("stop")) : e.value = (parseInt(e.value) - 1).toString()
};
