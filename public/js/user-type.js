const type1 = document.getElementById("type1");
const type2 = document.getElementById("type2");
const type3 = document.getElementById("type3");

const council = document.getElementById("council");

type1.addEventListener("click", function () {
    council.style.display = "none";
});
type2.addEventListener("click", function () {
    council.style.display = "block";
});
type3.addEventListener("click", function () {
    council.style.display = "none";
});
