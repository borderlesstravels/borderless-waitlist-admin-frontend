let data = [];
let currentPage = 1;
const itemsPerPage = 5;

$(document).ready(function () {
  fetchData();

  $('#searchInput, #countryFilter').on('input change', function () {
    currentPage = 1;
    renderTable();
  });
});

function fetchData() {
  $.ajax({
    url: 'get-data.php',
    method: 'GET',
    dataType: 'json',
    success: function (response) {
      data = response;
      populateCountryDropdown();
      renderTable();
    }
  });
}

function populateCountryDropdown() {
  const countries = [...new Set(data.map(item => item.country))].sort();
  countries.forEach(country => {
    $('#countryFilter').append(`<option value="${country}">${country}</option>`);
  });
}

function renderTable() {
  let search = $('#searchInput').val().toLowerCase();
  let selectedCountry = $('#countryFilter').val();

  let filtered = data.filter(item => {
    return (
      (item.first_name.toLowerCase().includes(search) || item.city.toLowerCase().includes(search)) &&
      (!selectedCountry || item.country === selectedCountry)
    );
  });

  let start = (currentPage - 1) * itemsPerPage;
  let paginated = filtered.slice(start, start + itemsPerPage);

  $('#tableBody').html('');
  paginated.forEach((item, index) => {
    $('#tableBody').append(`
      <tr>
        <td>${start + index + 1}</td>
        <td>${item.first_name}</td>
        <td>${item.city}</td>
        <td>${item.country}</td>
        <td>${item.date_joined}</td>
      </tr>
    `);
  });

  renderPagination(filtered.length);
}

function renderPagination(totalItems) {
  const pageCount = Math.ceil(totalItems / itemsPerPage);
  let buttons = '';

  for (let i = 1; i <= pageCount; i++) {
    buttons += `<button class="${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
  }

  $('#pagination').html(buttons);
}

function goToPage(page) {
  currentPage = page;
  renderTable();
}
