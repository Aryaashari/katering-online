function bayar() {
    const pesananId = document.getElementById("pesananId");

    // URL endpoint di Laravel
    const url = "/pesan/bayar";

    // Data yang ingin dikirimkan ke server
    const data = {
        pesanan_id: pesananId.value,
    };

    // Mengirim permintaan POST dengan fetch
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (response.status === 200) {
                return response.json();
            } else if (response.status === 404) {
                throw new Error("Pesanan tidak ditemukan");
            }  else if (response.status === 500) {
                throw new Error("Server error");
            } else {
                throw new Error(`Unexpected error: ${response.text}`);
            }
        })
        .then((result) => {
            // console.log(result.data.token)
            window.snap.pay(result.data.token);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
