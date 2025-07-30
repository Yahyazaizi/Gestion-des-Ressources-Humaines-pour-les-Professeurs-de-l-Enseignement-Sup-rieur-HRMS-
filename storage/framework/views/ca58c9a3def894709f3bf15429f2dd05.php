<?php echo $__env->make('components.private.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.private.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">🔍 Rechercher des promotions prévues</h2>

    
    <form id="formRecherche" method="GET" action="<?php echo e(route('promotions.recherche')); ?>" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="date_effet">Date de promotion prévue</label>
            <input type="date" id="date_effet" name="date_effet" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="cadre">Cadre</label>
            <select name="cadre" id="cadre" class="form-select">
                <option value="">-- Tous les cadres --</option>
                <option value="MC">MC</option>
                <option value="MCH">MCH</option>
                <option value="PES">PES</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="NOM_ET_PRENOM" class="form-label">Enseignant</label>
            <select name="NOM_ET_PRENOM" id="NOM_ET_PRENOM" class="form-control select2">
                <option value="">-- Tous les enseignants --</option>
            </select>
        </div>
    </form>

    <div id="infosProf" class="alert alert-info mt-2"></div>

    

</div>

<style>
    /* Style général */
    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 50px;
        text-align: center;
        width:100%;
        margin-right: 30px


    }

    h2 {
        color: #2c3e50;
        font-weight: 600;
    }

    /* Style du formulaire */
    .form-control, .form-select {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 10px;
        transition: border-color 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    label {
        font-weight: 500;
        color: #34495e;
        margin-bottom: 5px;
    }

    /* Style des résultats */
    .table {
        margin-top: 20px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th {
        background-color: #3498db;
        color: white;
        font-weight: 500;
    }

    .table td, .table th {
        padding: 12px;
        vertical-align: middle;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }

    /* Style des alertes */
    .alert {
        border-radius: 4px;
        padding: 15px;
    }

    .alert-info {
        background-color: #e7f5ff;
        border-color: #d0ebff;
        color: #1864ab;
    }

    .alert-warning {
        background-color: #fff3bf;
        border-color: #ffec99;
        color: #e67700;
    }

    /* Style pour les promotions futures */
    .promotion-futur {
        background: #e6f7ff;
        border-left: 4px solid #1890ff;
        padding: 12px 16px;
        margin-top: 15px;
        font-weight: bold;
        color: #0a2a43;
        border-radius: 4px;
    }

    .promotion-futur b {
        color: #0056b3;
    }

    /* Style pour Select2 */
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>

<script>
    const professeursData = <?php echo json_encode($professeursData, 15, 512) ?>;
    const professeursAll = Object.values(professeursData); // <-- Ajout important ici

    const select = document.getElementById('NOM_ET_PRENOM');

//     function calculerPromotion(cadre, ech, dateEffet1, dateSaisie) {
//     const palier = { 'MC': 3, 'MCH': 4, 'PES': 6 };
//     const ordreGrades = ['MC', 'MCH', 'PES'];
//     let newCadre = cadre;
//     let newEch = parseInt(ech, 10);
//     let newDateEffet = dateEffet1;
//     let newDateEffet2 = null;

//     if (!dateEffet1 || !dateSaisie) {
//         return { newCadre, newEch, newDateEffet, newDateEffet2 };
//     }

//     let refDate = new Date(dateEffet1);
//     let saisieDate = new Date(dateSaisie);

//     let diffYears = saisieDate.getFullYear() - refDate.getFullYear();
//     let diffMonths = saisieDate.getMonth() - refDate.getMonth();
//     let diffDays = saisieDate.getDate() - refDate.getDate();
//     let totalMonths = diffYears * 12 + diffMonths + (diffDays >= 0 ? 0 : -1);
//     let steps = Math.floor(totalMonths / 24); // 2 ans = 24 mois

//     let gradeIndex = ordreGrades.indexOf(newCadre);
//     let currentDate = new Date(refDate);
//     let cadreChanged = false;

//     while (steps > 0 && gradeIndex < ordreGrades.length) {
//         let maxEch = palier[newCadre];
//         let reste = maxEch - newEch;

//         if (newCadre === 'PES' && newEch === 6) {
//             // Déjà au maximum
//             steps = 0;
//             break;
//         }

//         if (steps <= reste) {
//             newEch += steps;
//             if (newCadre === 'PES' && newEch > 6) {
//                 newEch = 6;
//             }
//             currentDate.setFullYear(currentDate.getFullYear() + steps * 2);
//             steps = 0;
//         } else {
//             if (newCadre !== 'PES') {
//                 currentDate.setFullYear(currentDate.getFullYear() + (reste + 1) * 2);
//                 gradeIndex++;
//                 newCadre = ordreGrades[gradeIndex] || newCadre;
//                 newEch = 1;
//                 if (!cadreChanged) {
//                     newDateEffet2 = currentDate.toISOString().slice(0, 10);
//                     cadreChanged = true;
//                 }
//                 steps -= (reste + 1);
//             } else {
//                 newEch = 6;
//                 currentDate.setFullYear(currentDate.getFullYear() + (reste) * 2);
//                 steps = 0;
//             }
//         }
//     }

//     newDateEffet = currentDate.toISOString().slice(0, 10);

//     if (!cadreChanged) {
//         newDateEffet2 = null;
//     }

//     return { newCadre, newEch, newDateEffet, newDateEffet2 };
// }
function calculerPromotion(cadre, ech, dateEffet1, dateSaisie) {
    const palier = { 'MC': 3, 'MCH': 4, 'PES': 6 };
    const ordreGrades = ['MC', 'MCH', 'PES'];
    let newCadre = cadre;
    let newEch = parseInt(ech, 10);
    let newDateEffet = dateEffet1;
    let newDateEffet2 = null;

    if (!dateEffet1 || !dateSaisie) {
        return { newCadre, newEch, newDateEffet, newDateEffet2 };
    }

    let refDate = new Date(dateEffet1);
    let saisieDate = new Date(dateSaisie);

    let diffYears = saisieDate.getFullYear() - refDate.getFullYear();
    let diffMonths = saisieDate.getMonth() - refDate.getMonth();
    let diffDays = saisieDate.getDate() - refDate.getDate();
    let totalMonths = diffYears * 12 + diffMonths + (diffDays >= 0 ? 0 : -1);
    let steps = Math.floor(totalMonths / 24); // 2 ans = 24 mois

    let gradeIndex = ordreGrades.indexOf(newCadre);
    let currentDate = new Date(refDate);

    while (steps > 0 && gradeIndex < ordreGrades.length) {
        let maxEch = palier[newCadre];
        let reste = maxEch - newEch;

        if (newCadre === 'PES' && newEch === 6) {
            steps = 0;
            break;
        }

        if (steps <= reste) {
            newEch += steps;
            if (newCadre === 'PES' && newEch > 6) {
                newEch = 6;
            }
            currentDate.setFullYear(currentDate.getFullYear() + steps * 2);
            steps = 0;
        } else {
            if (newCadre !== 'PES') {
                currentDate.setFullYear(currentDate.getFullYear() + (reste + 1) * 2);
                gradeIndex++;
                newCadre = ordreGrades[gradeIndex] || newCadre;
                newEch = 1;
                // A CHAQUE changement de cadre, on met à jour newDateEffet2
                newDateEffet2 = currentDate.toISOString().slice(0, 10);
                steps -= (reste + 1);
            } else {
                newEch = 6;
                currentDate.setFullYear(currentDate.getFullYear() + (reste) * 2);
                steps = 0;
            }
        }
    }

    newDateEffet = currentDate.toISOString().slice(0, 10);

    return { newCadre, newEch, newDateEffet, newDateEffet2 };
}


    function afficherInfos() {
    const profId = document.getElementById('NOM_ET_PRENOM').value;
    const dateSaisie = document.getElementById('date_effet').value;
    const infosDiv = document.getElementById('infosProf');
    infosDiv.innerHTML = '';

    if (profId && professeursData[profId]) {
        const prof = professeursData[profId];
        let html = `<b>Date Effet Échelon actuelle :</b> ${prof.date_effet1 || '-'}<br>
                    <b>Date Effet Cadre actuelle :</b> ${prof.date_effet2 || '-'}<br>
                    <b>Cadre actuel :</b> ${prof.cadre || '-'}<br>
                    <b>Échelon actuel :</b> ${prof.ech || '-'}<br>`;

        if (dateSaisie) {
            const res = calculerPromotion(prof.cadre, prof.ech, prof.date_effet1, dateSaisie);
            html += `<div class="promotion-futur">
                        <b>Nouvelle Date Effet Échelon :</b> ${res.newDateEffet}<br>
                        ${res.newDateEffet2 ? `<b>Date Effet Cadre:</b> ${res.newDateEffet2}<br>` : ''}
                        <b>Cadre futur :</b> ${res.newCadre}<br>
                        <b>Échelon futur :</b> ${res.newEch}<br>
                    </div>`;
        }
        infosDiv.innerHTML = html;
    }
}

    function updateProfesseursList() {
        const cadre = document.getElementById('cadre').value;
        const select = document.getElementById('NOM_ET_PRENOM');

        // Sauvegarder la sélection actuelle
        const currentSelection = select.value;

        // Vider et réinitialiser les options
        select.innerHTML = '<option value="">-- Tous les enseignants --</option>';

        professeursAll.forEach(prof => {
            const matchCadre = !cadre || prof.cadre === cadre;

            if (matchCadre) {
                const opt = document.createElement('option');
                opt.value = prof.id;
                opt.textContent = prof.NOM_ET_PRENOM ||
                                 [prof.first_name || prof.prenom,
                                  prof.last_name || prof.nom].filter(Boolean).join(' ');
                select.appendChild(opt);
            }
        });

        // Restaurer la sélection si possible
        if (currentSelection && select.querySelector(`option[value="${currentSelection}"]`)) {
            select.value = currentSelection;
        }

        // Rafraîchir Select2 si utilisé
        if (window.jQuery && $.fn.select2) {
            $('#NOM_ET_PRENOM').trigger('change.select2');
        }

        afficherInfos();
    }

    // Garder les autres fonctions (calculerPromotion, afficherInfos) inchangées...

    // Écouteurs d'événements simplifiés
    document.getElementById('NOM_ET_PRENOM').addEventListener('change', afficherInfos);
    document.getElementById('date_effet').addEventListener('change', afficherInfos);
    document.getElementById('cadre').addEventListener('change', updateProfesseursList);

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser Select2 si disponible
        if (window.jQuery && $.fn.select2) {
            $('#NOM_ET_PRENOM').select2({
                placeholder: "-- Tous les enseignants --",
                allowClear: true
            });
        }

        updateProfesseursList();
    });



    // Initialisation de la liste des professeurs
    updateProfesseursList();

    // Exécuté au chargement de la page
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Page chargée");
        // Initialisation de la liste des professeurs
        updateProfesseursList();

        // Si vous utilisez select2, ajoutez ceci après l'initialisation
        if (window.jQuery && $.fn.select2) {
            $('#NOM_ET_PRENOM').select2({
                placeholder: "-- Tous les enseignants --",
                allowClear: true
            });

            // Mettre à jour select2 après avoir rempli les options
            $('#NOM_ET_PRENOM').on('select2:select', function (e) {
                afficherInfos();
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.private.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\laravel\hrms\resources\views/promotions-prevues.blade.php ENDPATH**/ ?>