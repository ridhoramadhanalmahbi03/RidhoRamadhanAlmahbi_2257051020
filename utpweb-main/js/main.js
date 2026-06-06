window.addEventListener("load", function () {
  document.body.classList.add("siap");
});

var formKontak = document.querySelector("form.formulir");
if (formKontak) {
  formKontak.addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Pesan Berhasil dikirim kace nya");
  });
}
