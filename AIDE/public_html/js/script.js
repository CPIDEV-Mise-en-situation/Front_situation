let reservedDates = [];
let currentMonth = new Date().getMonth() + 1;
let currentYear = new Date().getFullYear();
let selectedDateCell = null;

async function fetchReservedDates() {
    try {
        const response = await fetch('./php/reservations.php');
        const dates = await response.json();
        reservedDates = dates;
    } catch (error) {
        console.error('Erreur lors du chargement des dates réservées :', error);
    }
}

function generateCalendar(month, year) {
    const tbody = document.querySelector('#reservation-calendar tbody');
    const monthYear = document.querySelector('#month-year');
    tbody.innerHTML = '';
    monthYear.textContent = new Date(year, month - 1).toLocaleString('fr', { month: 'long', year: 'numeric' });

    const firstDay = new Date(year, month - 1, 1).getDay();
    const daysInMonth = new Date(year, month, 0).getDate();

    let row = document.createElement('tr');
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement('td');
        emptyCell.classList.add('disabled');
        row.appendChild(emptyCell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement('td');
        cell.textContent = day;
        const dateString = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        cell.setAttribute('data-date', dateString);

        const date = new Date(year, month - 1, day);
        const dayOfWeek = date.getDay();
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            cell.classList.add('disabled');
        } else if (reservedDates.includes(dateString)) {
            cell.classList.add('reserved');
        } else {
            cell.classList.add('available');
            cell.addEventListener('click', () => selectDate(cell, dateString));
        }
        row.appendChild(cell);

        if ((firstDay + day) % 7 === 0) {
            tbody.appendChild(row);
            row = document.createElement('tr');
        }
    }

    if (row.children.length > 0) tbody.appendChild(row);
}

function selectDate(cell, dateString) {
    if (selectedDateCell) {
        selectedDateCell.classList.remove('selected');
    }

    selectedDateCell = cell;
    cell.classList.add('selected');
    document.getElementById('date').value = dateString;

    if (reservedDates.includes(dateString)) {
        document.getElementById('time-slot').innerHTML = '<option value="">Aucun créneau disponible</option>';
    } else {
        fetchAvailableTimeSlots(dateString);
    }
}

async function fetchAvailableTimeSlots(date) {
    const categorie = document.getElementById('categorie').value;
    try {
        const response = await fetch(`./php/get_time_slots.php?date=${date}&categorie=${categorie}`);
        const timeSlots = await response.json();

        const timeSlotSelect = document.getElementById('time-slot');
        timeSlotSelect.innerHTML = '<option value="">Sélectionnez un créneau</option>';

        const availableSlots = timeSlots.filter(slot => slot.status === 'available');

        if (availableSlots.length === 0) {
            timeSlotSelect.innerHTML = '<option value="">Aucun créneau disponible</option>';

            const allReserved = timeSlots.every(slot => slot.status === 'reserved');
            if (allReserved && !reservedDates.includes(date)) {
                reservedDates.push(date);
                const cell = document.querySelector(`td[data-date="${date}"]`);
                if (cell) {
                    cell.classList.add('reserved');
                    cell.classList.remove('available', 'selected');
                    cell.removeEventListener('click', selectDate);
                }
            }
        } else {
            availableSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.start_time;
                option.textContent = `${slot.start_time} - ${slot.end_time}`;
                timeSlotSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de la récupération des créneaux horaires. Veuillez réessayer.');
    }
}

document.getElementById('prev-month').addEventListener('click', () => {
    if (currentMonth > 1) {
        currentMonth--;
    } else {
        currentMonth = 12;
        currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
});

document.getElementById('next-month').addEventListener('click', () => {
    if (currentMonth < 12) {
        currentMonth++;
    } else {
        currentMonth = 1;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
});

document.getElementById('reservation-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    try {
        const response = await fetch('./php/reservations.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });

        const result = await response.json();

        if (result.success) {
            alert('Réservation enregistrée avec succès !');
            await fetchReservedDates();
            generateCalendar(currentMonth, currentYear);
            document.getElementById('reservation-popup').classList.add('hidden');

            const date = document.getElementById('date').value;
            await fetchAvailableTimeSlots(date);
        } else {
            alert('Erreur : ' + (result.error || 'Impossible de traiter la requête.'));
        }
    } catch (error) {
        console.error('Erreur :', error);
        alert('Impossible d\'envoyer les données. Vérifiez votre connexion.');
    }
});


document.addEventListener('DOMContentLoaded', async () => {
    await fetchReservedDates();
    generateCalendar(currentMonth, currentYear);

    document.querySelectorAll('.reservation-btn').forEach(button => {
        button.addEventListener('click', () => {
            if (!isLoggedIn) {
                window.location.href = './connexion/login.php';
                return;
            }

            const categorie = button.getAttribute("data-category");
            document.getElementById("categorie").value = categorie;
            document.getElementById('reservation-popup').classList.remove('hidden');
        });
    });

    document.querySelector('.close-popup').addEventListener('click', () => {
        document.getElementById('reservation-popup').classList.add('hidden');
    });
});
