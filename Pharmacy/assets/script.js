// Search function
document.getElementById("searchInput")?.addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll(".medicine-card");

    cards.forEach(card => {
        let text = card.querySelector(".card-title").textContent.toLowerCase();
        card.style.display = text.includes(filter) ? "block" : "none";
    });
});

// Category filter
function filterCategory(category) {
    let cards = document.querySelectorAll(".medicine-card");

    cards.forEach(card => {
        if (category === "all" || card.getAttribute("data-category") === category) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}
