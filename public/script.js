alert("👋 Welcome to HERNANDEZ website! Enjoy your stay 😊");

/* 🌙 Dark Mode Toggle */
function toggleTheme() {
    document.body.classList.toggle("dark");
    localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
}

/* Pagination settings */
let rowsPerPage = 5;
let currentPage = 1;

window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark");
    }
    // guard for missing elements
    if (!document.getElementById('userTable') || !document.getElementById('searchInput')) return;

    // wire search input
    document.getElementById("searchInput").addEventListener("input", () => {
        currentPage = 1; // reset page when searching
        loadPagination();
    });

    // initial load
    loadPagination();
});

/* Promise-based paginateTable: computes visible rows and returns pageRows + totalPages */
function paginateTable() {
    return new Promise((resolve, reject) => {
        const table = document.getElementById("userTable");
        const allRows = Array.from(table.querySelectorAll("tbody tr"));
        const filter = document.getElementById("searchInput").value.trim().toLowerCase();

        // Build visibleRows by applying search filter (but don't set display yet)
        const visibleRows = allRows.filter(r => {
            const name = (r.cells[1]?.textContent || '').toLowerCase();
            const email = (r.cells[2]?.textContent || '').toLowerCase();
            return (name.includes(filter) || email.includes(filter));
        });

        if (visibleRows.length === 0) {
            // hide all rows to be safe
            allRows.forEach(r => {
                r.style.display = 'none';
                r.classList.remove('row-fade', 'show');
            });
            reject("⚠ No matching records found.");
            return;
        }

        const totalPages = Math.max(1, Math.ceil(visibleRows.length / rowsPerPage));

        // ensure currentPage is within bounds
        if (currentPage > totalPages) currentPage = 1;
        if (currentPage < 1) currentPage = 1;

        const start = (currentPage - 1) * rowsPerPage;
        const pageRows = visibleRows.slice(start, start + rowsPerPage);

        // hide all rows first (we will show only pageRows)
        allRows.forEach(r => {
            r.style.display = 'none';
            r.classList.remove('row-fade', 'show');
        });

        resolve({ totalPages, pageRows });
    });
}

/* Render pagination controls (Prev / pages / Next) */
function renderPagination(totalPages) {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";

    // Prev
    const makeBtn = (text, cb, extraClass = '') => {
        const btn = document.createElement('button');
        btn.textContent = text;
        if (extraClass) btn.classList.add(extraClass);
        btn.addEventListener('click', cb);
        return btn;
    };

    if (currentPage > 1) {
        pagination.appendChild(makeBtn('« Prev', () => { currentPage--; loadPagination(); }));
    }

    // show pages (for large number of pages you may want to limit visible numbers)
    for (let i = 1; i <= totalPages; i++) {
        const btn = makeBtn(String(i), () => { currentPage = i; loadPagination(); }, i === currentPage ? 'active' : '');
        if (i === currentPage) btn.classList.add('active');
        pagination.appendChild(btn);
    }

    if (currentPage < totalPages) {
        pagination.appendChild(makeBtn('Next »', () => { currentPage++; loadPagination(); }));
    }
}

/* Animate rows: show pageRows with fade-in/slide */
function animateRows(rows) {
    // rows is an array of <tr> elements that should be visible this page
    // apply initial hidden + row-fade class then force reflow and add 'show'
    rows.forEach((r, index) => {
        r.classList.add('row-fade');
        r.style.display = ''; // make visible for user but still opacity 0
    });

    // Force reflow so transition will run
    // eslint-disable-next-line no-unused-expressions
    document.body.offsetHeight;

    // Stagger slightly for nicer effect
    rows.forEach((r, index) => {
        window.setTimeout(() => {
            r.classList.add('show');
        }, index * 60); // 60ms stagger per row
    });
}

/* Main loader */
function loadPagination() {
    paginateTable()
        .then(({ totalPages, pageRows }) => {
            renderPagination(totalPages);
            animateRows(pageRows);
        })
        .catch(err => {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = `<p style="color:red; text-align:center;">${err}</p>`;
        });
}
