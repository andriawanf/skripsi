import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Tampilkan loading spinner saat halaman dimuat
    showLoadingSpinner();

    // Sembunyikan loading spinner setelah waktu tertentu (misalnya 3 detik)
    setTimeout(function () {
        hideLoadingSpinner();
    }, 2500);
});

function showLoadingSpinner() {
    document.getElementById("loading-spinner").style.display = "block";
}

function hideLoadingSpinner() {
    document.getElementById("loading-spinner").style.display = "none";
    document.getElementById("content").style.display = "block"; // Menampilkan elemen view
}
