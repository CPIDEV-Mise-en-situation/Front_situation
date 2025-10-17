document.addEventListener('DOMContentLoaded', function() {
    const daysContainer = document.getElementById('calendar-days');
    const weekDatesElement = document.getElementById('week-dates');
    const prevWeekButton = document.getElementById('prev-week');
    const nextWeekButton = document.getElementById('next-week');
    const reservationFormContainer = document.getElementById('reservation-form-container');
    const reservationForm = document.getElementById('reservation-form');
    const reservationDetails = document.getElementById('reservation-details');
    const cancelButton = document.getElementById('cancel-reservation');
    const closeDetailsButton = document.getElementById('close-details');

    let currentDate = moment();
    let selectedSlot = null;
    let selectedReservation = null;

    // Générer le calendrier pour la semaine actuelle
    function generateCalendar() {
        const weekStart = currentDate.clone().startOf('week');
        const weekEnd = currentDate.clone().endOf('week');

        // Afficher la plage de dates
        weekDatesElement.textContent =
            weekStart.format('DD/MM/YYYY') + ' - ' + weekEnd.format('DD/MM/YYYY');

        // Récupérer les réservations pour cette semaine
        fetch(`fetch_slots.php?week_start=${weekStart.format('YYYY-MM-DD')}`)
            .then(response => response.json())
            .then(reservations => {
                daysContainer.innerHTML = '';

                // Générer les jours de la semaine
                for (let i = 0; i < 7; i++) {
                    const day = weekStart.clone().add(i, 'days');
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day';

                    // En-tête du jour
                    const dayHeader = document.createElement('div');
                    dayHeader.className = 'day-header';
                    dayHeader.textContent = day.format('ddd DD/MM');
                    dayElement.appendChild(dayHeader);

                    // Créer les slots horaires (7h à 20h)
                    for (let hour = 7; hour <= 20; hour++) {
                        const slotTime = day.clone().hour(hour).minute(0);
                        const slotElement = document.createElement('div');
                        slotElement.className = 'slot available';
                        slotElement.dataset.date = day.format('YYYY-MM-DD');
                        slotElement.dataset.time = slotTime.format('HH:mm');

                        // Vérifier si ce slot est réservé
                        const isReserved = reservations.some(reservation => {
                            const resStart = moment(reservation.start_time);
                            return resStart.format('YYYY-MM-DD HH:mm') === slotTime.format('YYYY-MM-DD HH:mm');
                        });

                        if (isReserved) {
                            const reservation = reservations.find(reservation => {
                                const resStart = moment(reservation.start_time);
                                return resStart.format('YYYY-MM-DD HH:mm') === slotTime.format('YYYY-MM-DD HH:mm');
                            });

                            slotElement.className = 'slot reserved';
                            const infoElement = document.createElement('div');
                            infoElement.className = 'reservation-info';
                            infoElement.textContent = reservation.title;
                            infoElement.dataset.id = reservation.id;
                            slotElement.appendChild(infoElement);
                        }

                        slotElement.addEventListener('click', function() {
                            if (isReserved) {
                                // Afficher les détails de la réservation
                                showReservationDetails(reservation);
                            } else {
                                // Ouvrir le formulaire pour une nouvelle réservation
                                openReservationForm(day.format('YYYY-MM-DD'), slotTime.format('HH:mm'));
                            }
                        });

                        dayElement.appendChild(slotElement);
                    }

                    daysContainer.appendChild(dayElement);
                }
            });
    }

    // Afficher les détails d'une réservation
    function showReservationDetails(reservation) {
        selectedReservation = reservation;
        document.getElementById('detail-title').querySelector('span').textContent = reservation.title;
        document.getElementById('detail-time').querySelector('span').textContent =
            moment(reservation.start_time).format('DD/MM/YYYY HH:mm');
        document.getElementById('detail-price').querySelector('span').textContent = reservation.price + ' €';
        document.getElementById('detail-customer').querySelector('span').textContent = reservation.customer_name;
        document.getElementById('detail-phone').querySelector('span').textContent = reservation.customer_phone;
        document.getElementById('detail-email').querySelector('span').textContent = reservation.customer_email || 'Non renseigné';
        document.getElementById('detail-vehicle').querySelector('span').textContent = reservation.vehicle_type;
        document.getElementById('detail-service').querySelector('span').textContent = reservation.service_type;
        document.getElementById('detail-notes').querySelector('span').textContent = reservation.notes || 'Aucune';

        reservationDetails.classList.remove('hidden');
    }

    // Ouvrir le formulaire de réservation
    function openReservationForm(date, time) {
        selectedSlot = { date, time };
        document.getElementById('selected-date').value = date;
        document.getElementById('selected-time').value = time;
        reservationForm.reset();
        reservationFormContainer.classList.remove('hidden');
    }

    // Soumettre le formulaire de réservation
    reservationForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = {
            title: document.getElementById('title').value,
            date: selectedSlot.date,
            time: selectedSlot.time,
            price: document.getElementById('price').value,
            customer_name: document.getElementById('customer_name').value,
            customer_phone: document.getElementById('customer_phone').value,
            customer_email: document.getElementById('customer_email').value,
            vehicle_type: document.getElementById('vehicle_type').value,
            service_type: document.getElementById('service_type').value,
            notes: document.getElementById('notes').value
        };

        // Ajouter ou modifier une réservation
        const url = selectedReservation
            ? 'edit_reservation.php'
            : 'add_reservation.php';

        if (selectedReservation) {
            formData.id = selectedReservation.id;
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                reservationFormContainer.classList.add('hidden');
                generateCalendar(); // Rafraîchir le calendrier
            }
        });
    });

    // Bouton Annuler
    cancelButton.addEventListener('click', function() {
        reservationFormContainer.classList.add('hidden');
        selectedSlot = null;
        selectedReservation = null;
    });

    // Bouton Fermer les détails
    closeDetailsButton.addEventListener('click', function() {
        reservationDetails.classList.add('hidden');
        selectedReservation = null;
    });

    // Bouton Modifier
    document.getElementById('edit-reservation').addEventListener('click', function() {
        if (selectedReservation) {
            document.getElementById('selected-date').value =
                moment(selectedReservation.start_time).format('YYYY-MM-DD');
            document.getElementById('selected-time').value =
                moment(selectedReservation.start_time).format('HH:mm');
            document.getElementById('title').value = selectedReservation.title;
            document.getElementById('price').value = selectedReservation.price;
            document.getElementById('customer_name').value = selectedReservation.customer_name;
            document.getElementById('customer_phone').value = selectedReservation.customer_phone;
            document.getElementById('customer_email').value = selectedReservation.customer_email;
            document.getElementById('vehicle_type').value = selectedReservation.vehicle_type;
            document.getElementById('service_type').value = selectedReservation.service_type;
            document.getElementById('notes').value = selectedReservation.notes;

            reservationDetails.classList.add('hidden');
            reservationFormContainer.classList.remove('hidden');
        }
    });

    // Bouton Supprimer
    document.getElementById('delete-reservation').addEventListener('click', function() {
        if (selectedReservation && confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
            fetch('delete_reservation.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: selectedReservation.id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    reservationDetails.classList.add('hidden');
                    generateCalendar(); // Rafraîchir le calendrier
                }
            });
        }
    });

    // Navigation entre les semaines
    prevWeekButton.addEventListener('click', function() {
        currentDate.subtract(1, 'week');
        generateCalendar();
    });

    nextWeekButton.addEventListener('click', function() {
        currentDate.add(1, 'week');
        generateCalendar();
    });

    // Générer le calendrier au chargement
    generateCalendar();
});
