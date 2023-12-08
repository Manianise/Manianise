<?php

?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success bg-gradient">
				<h5 class="modal-title fs-2 text-white" id="exampleModalLabel">Date de réservation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			    <div class="container-fluid bg-secondary bg-gradient text-white">
                    <div class="row align-items-center">
                        <p id="read_more_reservation_form" class="col-md-5 bigger_font">Lire la suite</p>
                        <h2 class="col-md-7 fs-3 fw-bold ">-20% sur la carte !</h2>
                    </div>
                    <div class="row hidden">
                        <p class="col-md-12 fs-5">
                À propos de cette offre : <br>
                
                Hors menu, hors boisson. Valable pour le créneau horaire réservé.
                        </p>
                
                    </div>
                </div>
				<?= do_shortcode( '[booking]' ) ?>
			</div>
			<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {let btnToggle = document.querySelector('#read_more_reservation_form');btnToggle.onclick = () => document.querySelector('.hidden').classList.toggle("active");});
</script>