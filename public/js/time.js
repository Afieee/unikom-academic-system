function updateClock() {
    const now = new Date();
    const year = now.getFullYear();
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const month = monthNames[now.getMonth()]; // Ambil nama bulan berdasarkan indeks
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    const currentTime = `Tanggal: ${day} ${month} ${year} Waktu: ${hours}:${minutes}:${seconds}`;
    document.getElementById('currentTime').textContent = currentTime;
}

setInterval(updateClock, 1000);
updateClock();
