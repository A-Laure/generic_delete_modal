
<!-- Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 hidden">
  <div class="flex justify-center items-center h-full px-4 sm:px-0">
    <div class="bg-white p-4 rounded-lg shadow-lg max-w-xs w-full sm:max-w-sm">
      <h3 class="text-base font-semibold text-gray-800 mb-3 text-center sm:text-left">
        Confirmer la suppression
      </h3>
      <p class="text-xs text-gray-600 mb-3 text-center sm:text-left">
        Êtes-vous sûr de vouloir supprimer cet article ?
      </p>

    
      <form action="index.php?ctrl=Data&action=confirmDelete" method="post" id="deleteConfirmForm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($object) ?>">
        <input type="hidden" name="table" value="<?=$table?>">
        <input type="hidden" name="field" value="<?=$field?>">
        <input type="hidden" name="who" value="<?= $who ?>">
        <input type="hidden" name="what" value="<?= $what ?>">

        <div class="flex flex-col sm:flex-row justify-center sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3">
         
          <button type="button" id="cancelDeleteBtn" class="text-gray-500 hover:text-blue-600 text-sm">
            Annuler
          </button>
          <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-md text-sm" >
            Supprimer
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {  
  const deleteButtons = document.querySelectorAll('.openModalBtn');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) { 
      const itemId = button.getAttribute('data-id');
      openDeleteModal(itemId);
    });
  });
});

// Open modal function
function openDeleteModal(itemId) {
  const modal = document.getElementById('deleteModal');
  modal.classList.remove('hidden'); 

  console.log("Modal ouvert pour l'élément ID:", itemId); // id verify

 
  const modalForm = document.getElementById('deleteConfirmForm');
  const idInput = modalForm.querySelector('input[name="id"]');
  idInput.value = itemId; 

  // Close modal if cancel
  const cancelBtn = document.getElementById('cancelDeleteBtn');
  cancelBtn.onclick = function() {
    modal.classList.add('hidden'); 
  };
}
</script>








