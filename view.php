<!-- TRASH / MODAL -->
<?php
$table = 'tva';
$field = 'tvas_Id';
$who = 'Item';
$what = 'index';
?>

<!-- delete button -->
<button type="button" id="" class="openModalBtn text-gray-600 hover:text-red-700 transition duration-300 ease-in-out" data-id="<?= $object = (int)htmlspecialchars($tva->getId()) ?>">
  <i class="fa-regular fa-trash-can"></i>
</button>