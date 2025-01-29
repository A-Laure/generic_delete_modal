<?php

require_once 'models/DataModel.php';
require_once 'models/CoreModel.php';


class DataController extends CoreModel
{
         
/**
 * element delet and redirection
 *
 * @param string $_POST['id'] element id
 * @param string $_POST['table'] element database table
 * @param string $_POST['field'] element database field
 * @param string $_POST['who'] element controller for redirection
 * @param string $_POST['what'] element action for redirection
 *
 * @throws Exception if element table not valid
 */

    public function confirmDelete() : void
    {
        isNotConnected();
        isNotAdmin();
        isNotPost();
            
        
        if (isset($_POST['id'], $_POST['table'], $_POST['field'])) {
            $id = $_POST['id'];
            $table = $_POST['table'];
            $field = $_POST['field'];
            $who = $_POST['who'];
            $what = $_POST['what'];

            
            $id = intval($id);
            $table = htmlspecialchars($table);
           
            // Valid database table list
            $validTables = ['item', 'role', 'site', 'stock', 'supplier', 'tva', 'user', 'address'];

              if (!in_array($table, $validTables)) {
                throw new Exception('Table n\'existe pas');
            }

           
            try {
                $query = "DELETE FROM $table WHERE $field = :id";
                $stmt = $this->getDb()->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

              
                header('Location: index.php?ctrl=' . $who . '&action=' . $what . '&_color=success&_err=La suppression a été effectuée avec succès.');
                exit;
            } catch (PDOException $e) {

                error_log('Erreur PDO: ' . $e->getMessage());

                header('Location: index.php?ctrl=' . $who . '&action=' . $what . '&_error=Erreur lors de la suppression');
                exit;
            }
        } else {
            
            header('Location: index.php?ctrl=Dashboard&action=index&_err=Id ou table non définie.');
            exit;
        }
    }
}
