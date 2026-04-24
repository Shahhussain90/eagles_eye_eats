const data = [
  // north nazimabad
  { name: "Burger Lab ", area: "North Nazimabad", cuisine: "Fast Food", url: "files/northnazimabad/burgerlab.php" },
  { name: "ginsoy", area: "North Nazimabad", cuisine: "Chinese", url: "files/northnazimabad/ginsoy.php" },
  { name: "Nando ", area: "North Nazimabad", cuisine: "BBQ", url: "files/northnazimabad/Nando.php" },
  { name: "Gul shinwari ", area: "Desi", cuisine: "Restaurant", url: "files/northnazimabad/gulshinwari.php" },

  // clifton
  { name: "Café Aylanto", area: "clifton", cuisine: "Italian/Continental/Mediterranean", url: "files/clifton/Aylanto.php" },
  { name: "Xander", area: "clifton", cuisine: "Continental", url: "files/clifton/xanders.php" },

  
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