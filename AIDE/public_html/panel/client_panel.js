function decrypt(data, key, iv) {
    try {
        const encryptedData = CryptoJS.enc.Base64.parse(data);
        const decrypted = CryptoJS.AES.decrypt({ ciphertext: encryptedData }, CryptoJS.enc.Base64.parse(key), {
            iv: CryptoJS.enc.Base64.parse(iv),
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });
        return decrypted.toString(CryptoJS.enc.Utf8);
    } catch (e) {
        console.error("Erreur de décryptage:", e);
        return "Erreur de décryptage";
    }
}

let currentSection = null;

function loadReservations() {
    console.log("Chargement des réservations...");
    fetch('get_client_reservations.php')
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            console.log("Réservations reçues:", data);
            const reservationsTable = document.getElementById('reservations-table');
            reservationsTable.innerHTML = '';

            if (data.length === 0) {
                reservationsTable.innerHTML = '<tr><td colspan="8">Aucune réservation trouvée</td></tr>';
                return;
            }

            data.forEach(reservation => {
                try {
                    const key = reservation.key;
                    const iv = reservation.iv;

                    const decryptedName = decrypt(reservation.name, key, iv);
                    const decryptedSurname = decrypt(reservation.surname, key, iv);
                    const decryptedAddress = decrypt(reservation.address, key, iv);
                    const decryptedPhone = decrypt(reservation.phone, key, iv);
                    const decryptedEmail = decrypt(reservation.email, key, iv);

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${decryptedName} ${decryptedSurname}</td>
                        <td>${decryptedEmail}</td>
                        <td>${reservation.reservation_date}</td>
                        <td>${reservation.start_time} - ${reservation.end_time}</td>
                        <td>${reservation.categorie}</td>
                        <td>${reservation.fabric_type}</td>
                        <td>
                            <div class="status-indicator ${reservation.status === 'done' ? 'status-green' : 'status-red'}"></div>
                            ${reservation.status === 'done' ? 'Terminé' : 'En attente'}
                        </td>
                        <td>
                            <button class="details-btn" onclick="showReservationDetails(${JSON.stringify(reservation).replace(/"/g, '&quot;')})">Détails</button>
                            <button class="cancel-btn" onclick="cancelReservation(${reservation.id}, event)">Annuler</button>
                        </td>
                    `;
                    reservationsTable.appendChild(row);
                } catch (e) {
                    console.error("Erreur avec la réservation:", reservation, e);
                }
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('reservations-table').innerHTML =
                '<tr><td colspan="8">Erreur lors du chargement des réservations</td></tr>';
        });
}

window.showReservationDetails = function(reservation) {
    try {
        const key = reservation.key;
        const iv = reservation.iv;

        const decryptedName = decrypt(reservation.name, key, iv);
        const decryptedSurname = decrypt(reservation.surname, key, iv);
        const decryptedAddress = decrypt(reservation.address, key, iv);
        const decryptedPhone = decrypt(reservation.phone, key, iv);
        const decryptedEmail = decrypt(reservation.email, key, iv);

        const popup = document.getElementById('reservation-details-popup');
        const popupContent = popup.querySelector('.popup-content');

        popupContent.innerHTML = `
            <h2>Détails de la Réservation</h2>
            <p><strong>Nom:</strong> ${decryptedName} ${decryptedSurname}</p>
            <p><strong>Adresse:</strong> ${decryptedAddress}</p>
            <p><strong>Téléphone:</strong> ${decryptedPhone}</p>
            <p><strong>Email:</strong> ${decryptedEmail}</p>
            <p><strong>Date:</strong> ${reservation.reservation_date}</p>
            <p><strong>Heure:</strong> ${reservation.start_time} - ${reservation.end_time}</p>
            <p><strong>Service:</strong> ${reservation.categorie}</p>
            <p><strong>Type de tissu:</strong> ${reservation.fabric_type}</p>
            <p><strong>Statut:</strong> ${reservation.status === 'done' ? 'Terminé' : 'En attente'}</p>
            <button class="close-btn" id="close-popup-btn">Fermer</button>
        `;

        popup.classList.remove('hidden');

        document.getElementById('close-popup-btn').addEventListener('click', () => {
            popup.classList.add('hidden');
        });
    } catch (e) {
        console.error("Erreur dans showReservationDetails:", e);
        alert("Erreur lors de l'affichage des détails");
    }
};

window.cancelReservation = function(reservationId, event) {
    event.stopPropagation();
    if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
        fetch('cancel_reservation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${reservationId}`
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Réservation annulée avec succès');
                loadReservations();
            } else {
                alert(data.error || 'Erreur lors de l\'annulation');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'annulation');
        });
    }
};

function setupStarRating() {
    const stars = document.querySelectorAll('.star-rating i');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('selected');
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('selected');
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        });

        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(s => s.classList.remove('hover'));
        });
    });
}

function loadUserReviews() {
    fetch('get_user_reviews.php')
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(reviews => {
            const container = document.getElementById('reviews-list');
            container.innerHTML = '';

            if (reviews.length === 0) {
                container.innerHTML = '<p class="no-reviews">Vous n\'avez pas encore posté d\'avis.</p>';
                return;
            }

            reviews.forEach(review => {
                const reviewElement = document.createElement('div');
                reviewElement.className = 'review-item';
                reviewElement.innerHTML = `
                    <div class="review-header">
                        <span class="service">${review.service_type}</span>
                        <span class="date">${new Date(review.created_at).toLocaleDateString('fr-FR')}</span>
                    </div>
                    <div class="stars">
                        ${'<i class="fas fa-star"></i>'.repeat(review.rating)}
                        ${'<i class="far fa-star"></i>'.repeat(5 - review.rating)}
                    </div>
                    <p class="review-text">${review.review_text}</p>
                `;
                container.appendChild(reviewElement);
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('reviews-list').innerHTML =
                '<p class="error">Erreur lors du chargement des avis</p>';
        });
}

function setupReviewForm() {
    const reviewForm = document.getElementById('review-form');
    if (!reviewForm) return;

    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const reviewText = document.getElementById('review-text').value;
        const rating = document.getElementById('rating').value;
        const serviceType = document.getElementById('service-type').value;

        if (!rating || rating < 1 || rating > 5) {
            alert('Veuillez donner une note valide entre 1 et 5');
            return;
        }

        if (!reviewText.trim()) {
            alert('Veuillez écrire un avis');
            return;
        }

        if (!serviceType) {
            alert('Veuillez sélectionner un service');
            return;
        }

        const submitBtn = reviewForm.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Envoi en cours...';

        fetch('add_review.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                review: reviewText,
                rating: rating,
                service_type: serviceType
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error || 'Erreur serveur');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Avis envoyé avec succès!');
                reviewForm.reset();
                document.querySelectorAll('.star-rating i').forEach(star => {
                    star.classList.remove('selected', 'fas');
                    star.classList.add('far');
                });
                loadUserReviews();
            } else {
                throw new Error(data.error || 'Erreur inconnue');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur: ' + error.message);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        });
    });
}

function setupNavigation() {
    document.getElementById('reservations-link').addEventListener('click', (e) => {
        e.preventDefault();
        if (currentSection !== 'reservations') {
            document.getElementById('reservations-section').classList.remove('hidden');
            document.getElementById('reviews-section').classList.add('hidden');
            loadReservations();
            currentSection = 'reservations';
        }
    });

    document.getElementById('reviews-link').addEventListener('click', (e) => {
        e.preventDefault();
        if (currentSection !== 'reviews') {
            document.getElementById('reviews-section').classList.remove('hidden');
            document.getElementById('reservations-section').classList.add('hidden');
            loadUserReviews();
            currentSection = 'reviews';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupStarRating();
    setupReviewForm();
    setupNavigation();

    document.getElementById('reservations-link').click();
});
