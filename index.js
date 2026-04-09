const data = [
  { name: "Cafe Aroma", area: "Gulshan", cuisine: "Cafe", url: "/restaurants/cafe-aroma.html" },
  { name: "Spice Harbor", area: "DHA", cuisine: "Pakistani", url: "/restaurants/spice-harbor.html" },
  { name: "BBQ Tonight", area: "Clifton", cuisine: "BBQ", url: "/restaurants/bbq-tonight.html" },
  { name: "Burger Lab", area: "Bahadurabad", cuisine: "Fast Food", url: "/restaurants/burger-lab.html" }
];

const input = document.getElementById("searchInput");
const resultsBox = document.getElementById("searchResults");

// Debounce for performance
let timeout;

input.addEventListener("input", () => {
  clearTimeout(timeout);

  timeout = setTimeout(() => {
    const query = input.value.toLowerCase().trim();

    if (!query) {
      resultsBox.style.display = "none";
      return;
    }

    const filtered = data.filter(item =>
      item.name.toLowerCase().includes(query) ||
      item.area.toLowerCase().includes(query) ||
      item.cuisine.toLowerCase().includes(query)
    );

    showResults(filtered);
  }, 250);
});

function showResults(results) {
  resultsBox.innerHTML = "";

  if (results.length === 0) {
    resultsBox.innerHTML = "<div class='search-item'>No results found</div>";
    resultsBox.style.display = "block";
    return;
  }

  results.forEach(item => {
    const div = document.createElement("div");
    div.classList.add("search-item");

    div.innerHTML = `
      <strong>${item.name}</strong>
      <span>${item.cuisine} • ${item.area}</span>
    `;

    div.addEventListener("click", () => {
      window.location.href = item.url;
    });

    resultsBox.appendChild(div);
  });

  resultsBox.style.display = "block";
}

// Hide on click outside
document.addEventListener("click", (e) => {
  if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
    resultsBox.style.display = "none";
  }
});