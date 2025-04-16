<script>
    function renderTable() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const selectedCountry = document.getElementById('countryFilter').value;

  const filtered = allData.filter(item => {
    const first = (item.first_name || '').toLowerCase();
    const last = (item.last_name || '').toLowerCase();
    const email = (item.email || '').toLowerCase();
    const phone = (item.phone || '').toLowerCase();
    const country = (item.country || '').toLowerCase();

    const matchesSearch = (
      first.includes(search) ||
      last.includes(search) ||
      email.includes(search) ||
      phone.includes(search) ||
      country.includes(search)
    );

    const matchesCountry = selectedCountry === '' || item.country === selectedCountry;

    return matchesSearch && matchesCountry;
  });

  const start = (currentPage - 1) * rowsPerPage;
  const paginated = filtered.slice(start, start + rowsPerPage);
  const tbody = document.getElementById('signupTableBody');
  tbody.innerHTML = '';

  if (paginated.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7">No records found.</td></tr>';
  } else {
    paginated.forEach((item, i) => {
      const tr = document.createElement('tr');
      if (item.country === selectedCountry && selectedCountry !== '') {
        tr.classList.add('highlight');
      }
      tr.innerHTML = `
        <td>${start + i + 1}</td>
        <td>${item.first_name}</td>
        <td>${item.last_name}</td>
        <td>${item.email}</td>
        <td>${item.phone}</td>
        <td>${formatDate(item.created_at)}</td>
      `;
      tbody.appendChild(tr);
    });
  }
}

function renderPagination() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const selectedCountry = document.getElementById('countryFilter').value;

  const filtered = allData.filter(item => {
    const first = (item.first_name || '').toLowerCase();
    const last = (item.last_name || '').toLowerCase();
    const email = (item.email || '').toLowerCase();
    const phone = (item.phone || '').toLowerCase();
    const country = (item.country || '').toLowerCase();

    const matchesSearch = (
      first.includes(search) ||
      last.includes(search) ||
      email.includes(search) ||
      phone.includes(search) ||
      country.includes(search)
    );

    const matchesCountry = selectedCountry === '' || item.country === selectedCountry;

    return matchesSearch && matchesCountry;
  });

  const totalPages = Math.ceil(filtered.length / rowsPerPage);
  const paginationDiv = document.getElementById('pagination');
  paginationDiv.innerHTML = '';

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement('button');
    btn.textContent = i;
    if (i === currentPage) btn.classList.add('active');
    btn.addEventListener('click', () => goToPage(i));
    paginationDiv.appendChild(btn);
  }
}

</script>