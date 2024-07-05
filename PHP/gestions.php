<?php
include_once("commande.php");
include_once("pdf.php");

class Gestion {

    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouter_employee($nom, $prenom, $matricule, $codeS, $dateN, $dateR, $numero,$fonct,$email,$direction) {
        try {
            $stmt = $this->pdo->prepare(Commande::$ajouter_employee);
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":matricule", $matricule);
            $stmt->bindParam(":codeS", $codeS);
            $stmt->bindParam(":dateN", $dateN);
            $stmt->bindParam(":dateR", $dateR);
            $stmt->bindParam(":numero", $numero);
            $stmt->bindParam(":fonction", $fonct);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":direction", $direction);

            $stmt->execute();
            echo "Add success";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout des données : " . $e->getMessage();
        }
    }

    public function get_employee() { 
        try {
            $stmt = $this->pdo->prepare(Commande::$get_employee);
            $stmt->execute();
            $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des employés : " . $e->getMessage();
        }
    }

    public function loginn($email,$password){
        try {
            $stmt = $this->pdo->prepare(Commande::$logg);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des employés : " . $e->getMessage();
        }
    }
 
  
    public function delete_employee($emp_id) {
        try {
           
            $stmt = $this->pdo->prepare(Commande::$delete_employee);	
            $stmt->bindParam(":id", $emp_id);
            $stmt->execute();
    
            echo "Suppression réussie";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'employé : " . $e->getMessage();
        }
    }

    public function getLoginIdByEmail($email){
        try {
           
            $stmt = $this->pdo->prepare(Commande::$get_admin_by_email);	
            $stmt->bindParam(":id", $email);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'employé : " . $e->getMessage();
            return [];
        }
    }

    public function updatePassword($id,$password){
        try {
            $stmt = $this->pdo->prepare(Commande::$update_password);	
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            echo "success";
    
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'employé : " . $e->getMessage();
        }
    }


    public function modifier_employee($nom, $prenom, $code_structure, $numero_compte, $date_naissance, $date_recrutement, $matricule, $emp_id, $fonct, $email, $direction) {
        try {
            $stmt = $this->pdo->prepare(Commande::$update_employee);
            $stmt->bindParam(":emp_id", $emp_id);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":codeS", $code_structure); // Correct placeholder name
            $stmt->bindParam(":numero", $numero_compte); // Correct placeholder name
            $stmt->bindParam(":dateN", $date_naissance); // Correct placeholder name
            $stmt->bindParam(":dateR", $date_recrutement); // Correct placeholder name
            $stmt->bindParam(":matricule", $matricule);
            $stmt->bindParam(":fonction", $fonct);
            $stmt->bindParam(":direction", $direction);
            $stmt->bindParam(":email", $email);
    
            $stmt->execute();
    
            echo "success";
    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function get_profile($emp_id)
    {
        $stmt = $this->pdo->prepare(Commande::$employee_info);
        $stmt->bindParam(":emp_id",$emp_id);
        $stmt->execute();
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->pdo->prepare(Commande::$medaille_info);
        $stmt->bindParam(":emp_id",$emp_id);
        $stmt->execute();
        $medailles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->pdo->prepare(Commande::$conges_info);
        $stmt->bindParam(":emp_id",$emp_id);
        $stmt->execute();
        $conges = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($conges)){
            $conges = false;
        }
        if(empty($medailles)){
            $medailles = false;
        }
        $array = array('profile' => $profile,'medailles'=>$medailles,'conges'=>$conges );

        return $array;
    }
    // Autres méthodes de la classe Gestion...
    public function ajouter_conges($matricule,$types,$validabe,$date_debut,$date_fin){
        $stmt = $this->pdo->prepare(Commande::$get_employee_id_by_matricule);
        $stmt->bindParam(':matricule',$matricule);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = $result[0]['emp_id'];

        $stmt = $this->pdo->prepare(Commande::$add_conges);
        $stmt->bindParam(':id_emp',$id);
        $stmt->bindParam(':types',$types);
        $stmt->bindParam(':validable',$validabe);
        $stmt->bindParam(':date_debut',$date_debut);
        $stmt->bindParam(':date_fin',$date_fin);

        $stmt->execute();

        echo "success $id";
    }

    public function get_conges_all(){
        $stmt = $this->pdo->prepare(Commande::$get_conges_all);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_list(){
        $stmt = $this->pdo->prepare(Commande::$get_list);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $reduce = array();
        $conges = array("duration"=>0);
        $id = 0;
        $index = 0;

        foreach($result as $row){
            if($id != $row['emp_id']){ // Change condition
                $reduce[] = $row; // Push entire row to reduce
                $reduce[$index]['duration'] = 0;
                $index = $index + 1;
            }
            $id = $row['emp_id'];
           
        }
    
        $stmt = $this->pdo->prepare(Commande::$get_list_conges);
        $stmt->execute();
        $result_conges = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach($result_conges as $row){
            $index = array_search($row['id_emp'], array_column($reduce, 'emp_id'));
            if ($index !== false) { // Check if index exists
               
                $reduce[$index]['duration'] =  $row['duration'];
            }
        }
        return $reduce;
    }
    
    public function getOccasion($date){
        
        $stmt= $this->pdo->prepare(Commande::$get_occasion);
        $stmt->bindParam(':date',$date);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getMedailles($typeo){

        $stmt= $this->pdo->prepare(Commande::$get_medailles);
        $stmt->bindParam(':typeo',$typeo);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function Archiver($id){
        $stmt= $this->pdo->prepare(Commande::$archiver);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return "success";
    }

    public function Disarchiver($id) {
        $stmt= $this->pdo->prepare(Commande::$disarchiver);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return "success";
    }

    public function generatePDF($id){

        $stmt= $this->pdo->prepare(Commande::$last_medaille);
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $result = $result[0];

        $nom = $result['nom'];
        $prenom = $result['prenom'];
        $direction = $result['direction'];
        $date = $result['date_prevu'];
        $type = $result['type'];

        try {
            convertPdfToHtml($type,$nom,$prenom,$date,$direction);
        } catch (\Throwable $th) {
            echo "error";
        }

        
        
    }

    public function togetMedialles(){
        $stmt= $this->pdo->prepare(Commande::$to_get_medailles);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function togetEmail($date){
        $stmt= $this->pdo->prepare(Commande::$get_email);
        $stmt->bindParam(':d',$date);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}






