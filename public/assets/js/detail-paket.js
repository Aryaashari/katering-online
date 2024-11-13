function changeQuantity() {
    // Get the input element that triggered the event
    const input = event.target;
    let value = parseInt(input.value);

    // Check if the value is less than 1
    if (value < 1 || isNaN(value)) {
        input.value = 1; // Reset to 1 if value is less than 1 or invalid
        value = 1;
    }

    let inputKuantitas = document.getElementsByClassName("inputKuantitas");
    let inputKuantitasOrang = document.getElementsByClassName(
        "inputKuantitasOrang"
    );
    let priceDisplay = document.getElementsByClassName("price");

    for (let index = 0; index < inputKuantitas.length; index++) {
        const itemInputKuantitas = inputKuantitas[index];
        const itemInputKuantitasOrang = inputKuantitasOrang[index];
        const itemPriceDisplay = priceDisplay[index];

        // Calculate the total dynamically (assuming the price per week is Rp 20,000)
        const price =
            parseInt(itemInputKuantitas.getAttribute("data-price")) || 0;
        const total =
            price *
            parseInt(itemInputKuantitas.value) *
            parseInt(itemInputKuantitasOrang.value);

        // Update the total amount displayed in the correct modal footer
        itemPriceDisplay.innerHTML = `Rp ${total.toLocaleString("id-ID")}`;
    }
}

function closeModal() {
    // Get the button that triggered the event
    const button = event.target;

    // Find the closest modal container relative to the clicked button
    const modal = button.closest(".modal");

    // Reset all order-related input fields (e.g., weekly or monthly) within this specific modal
    if (modal) {
        const orderInputs = modal.querySelectorAll("input[data-price]"); // Select all inputs with a data-price attribute
        orderInputs.forEach((input) => {
            input.value = 1; // Reset the value to 1

            // Update the total display for each input if applicable
            const totalElement = modal.querySelector(".modal-footer h4");
            if (totalElement) {
                const price = parseInt(input.getAttribute("data-price")) || 0;
                totalElement.innerHTML = `Rp ${price.toLocaleString("id-ID")}`;
            }
        });

        // Reset the date input field within the modal
        const dateInput = modal.querySelector('input[name="tanggal"]');
        if (dateInput) {
            dateInput.value = ""; // Clear the date selection
        }
    }

    // Close the modal (assuming you are using Bootstrap's modal functionality)
    $(modal).modal("hide");
}

document.addEventListener("DOMContentLoaded", function () {
    // Select the date input field
    const dateInputs = document.querySelectorAll('input[name="tanggal"]');

    if (dateInputs) {
        dateInputs.forEach((input) => {
            // Ambil waktu saat ini di zona waktu Jakarta
            const today = new Date();
            const jakartaTimeString = today.toLocaleString("en-US", {
                timeZone: "Asia/Jakarta",
            });
            const jakartaDate = new Date(jakartaTimeString);

            // Tambahkan 3 hari dari tanggal saat ini di Jakarta
            jakartaDate.setDate(jakartaDate.getDate() + 2);

            // Format tanggal sebagai YYYY-MM-DD
            const minDate = jakartaDate.toISOString().split("T")[0];

            // Setel atribut min pada input tanggal
            input.setAttribute("min", minDate);
            input.value = minDate;
        });
    }

    // Image preview
    const mainImg = document.getElementById("mainImg");
    const thumbnails = document.querySelectorAll(".thumb");
    const showMore = document.getElementById("showMore");
    const slides = document.querySelector(".slides");
    const slide = document.querySelectorAll(".slide");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");
    const closeButton = document.querySelector(".close");
    let currentIndex = 0;

    mainImg.addEventListener("click", function () {
        const slider = document.querySelector("#img-preview .slider");
        slider.classList.remove("hide");
        slider.classList.add("show");
    },
    true);

    thumbnails.forEach((thumb) => {
        thumb.addEventListener("click", () => {
            mainImg.src = thumb.src;
            showSlide(thumb.dataset.index);
        });
    });

    closeButton.addEventListener(
        "click",
        function () {
            const slider = document.querySelector("#img-preview .slider");
            slider.classList.remove("show");
            slider.classList.add("hide");
            currentIndex = 0;
            showSlide(currentIndex);
        },
        true
    );

    showMore.addEventListener(
        "click",
        function () {
            const slider = document.querySelector("#img-preview .slider");
            slider.classList.remove("hide");
            slider.classList.add("show");
            showSlide(2);
        },
        true
    );

    prevButton.addEventListener("click", function () {
        showSlide(currentIndex - 1);
    });

    nextButton.addEventListener("click", function () {
        showSlide(currentIndex + 1);
    });

    function showSlide(index) {
        const totalSlides = slide.length;
        if (index >= totalSlides) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = totalSlides - 1;
        } else {
            currentIndex = index;
        }
        const offset = -currentIndex * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }
});
