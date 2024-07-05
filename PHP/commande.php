<?php
class Commande{

    // Requêtes pour la gestion des employés
    static $ajouter_employee = "INSERT INTO employee (nom, prenom, matricule, code_structure, date_naissance, date_recrutement, numero_compte,fonction,email,direction) VALUES (:nom, :prenom, :matricule, :codeS, :dateN, :dateR, :numero,:fonction,:email,:direction)";
    static $get_employee = "SELECT * FROM employee";
    static $employee_info = "SELECT * FROM employee WHERE emp_id = :emp_id";
    static $update_employee = "UPDATE employee SET 
    nom = :nom, 
    prenom = :prenom, 
    matricule = :matricule, 
    code_structure = :codeS, 
    date_naissance = :dateN, 
    date_recrutement = :dateR, 
    numero_compte = :numero, 
    fonction = :fonction, 
    direction = :direction,
    email = :email 
    WHERE emp_id = :emp_id";
    static $filtre_nom = "SELECT * FROM employee WHERE LOWER(nom) LIKE LOWER(:nom)";
    static $filtre_prenom = "SELECT * FROM employee WHERE LOWER(prenom) LIKE LOWER(:prenom)";
    static $filtre_matricule = "SELECT * FROM employee WHERE LOWER(matricule) LIKE LOWER(:matricule)";

    static $modifier_employee = "UPDATE employee SET nom = :nom,prenom=:prenom,matricule=:matricule,code_structure=:code_structure,date_naissance=:date_naissance,date_recrutement=:date_recrutement,numero_compte=:numero_compte,fonction=:fonction WHERE emp_id=:emp_id";
    static $medaille_info = "SELECT * FROM medailles where id_employee = :emp_id";
    static $conges_info = "SELECT types,date_debut,validable,date_fin,DATEDIFF(date_fin,date_debut) as duration FROM conges where id_emp = :emp_id";

    static $delete_employee = "START TRANSACTION;DELETE FROM medailles WHERE id_employee = :id;DELETE FROM conges WHERE id_emp = :id;DELETE FROM employee WHERE emp_id = :id;COMMIT;";

    static $get_employee_id_by_matricule  = "SELECT emp_id FROM employee WHERE matricule = :matricule;";

    static $add_conges = "INSERT INTO conges(id_emp,validable,types,date_debut,date_fin) VALUES(:id_emp,:validable,:types,:date_debut,:date_fin);";

    static $get_conges_all = "SELECT e.nom,e.prenom,e.matricule,c.types,c.date_debut,c.date_fin,DATEDIFF(c.date_fin,CURDATE()) as duration,DATEDIFF(c.date_fin,c.date_debut) as duree from conges c JOIN employee e ON e.emp_id = c.id_emp where c.date_fin > CURDATE(); SORT BY id ASC";

    static $get_list = "SELECT e.*,m.* FROM (SELECT * FROM employee) e LEFT JOIN (SELECT * FROM medailles WHERE date_prevu >= CURRENT_DATE ORDER BY date_prevu ASC) m ON e.emp_id =m.id_employee;";

    static $get_list_conges = "SELECT DATEDIFF(date_fin,date_debut) as duration,id_emp FROM conges WHERE date_debut > CURRENT_DATE;";

    static $get_occasion = "SELECT e.*, m.*
    FROM employee e
    INNER JOIN medailles m ON m.id_employee = e.emp_id
    WHERE YEAR(m.date_prevu) = YEAR(CURRENT_DATE) AND DAY(m.date_prevu) = DAY(CONCAT(YEAR(CURRENT_DATE),:date)) AND MONTH(m.date_prevu) = MONTH(CONCAT(YEAR(CURRENT_DATE),:date));";


    static $get_medailles = "SELECT e.*, m.*
    FROM employee e
    INNER JOIN medailles m ON m.id_employee = e.emp_id
    WHERE YEAR(m.date_prevu) <= YEAR(CURRENT_DATE) AND DAY(m.date_prevu) <= DAY(CURRENT_DATE) AND MONTH(m.date_prevu) <= MONTH(CURRENT_DATE) AND m.type=:typeo ORDER BY m.date_prevu;";

    static $archiver = "UPDATE employee SET archive = 1 WHERE emp_id = :id";
    static $disarchiver = "UPDATE employee SET archive = 0 WHERE emp_id = :id";

    static $get_admin_by_email = "select * from login where email=:id;";

    static $update_password = "update login set password=:password where id=:id;";

    static $logg = "SELECT * FROM login WHERE email=:email AND password=:password LIMIT 1;";

    static $last_medaille = "SELECT * FROM employee e INNER JOIN medailles m ON m.id_employee = e.emp_id AND  e.emp_id=:id WHERE m.date_prevu >= CURRENT_DATE AND YEAR(CURRENT_DATE) = YEAR(m.date_prevu) ORDER BY m.date_prevu DESC;";

    static $to_get_medailles = "SELECT * FROM employee e INNER JOIN medailles m ON m.id_employee = e.emp_id WHERE m.date_prevu >= CURRENT_DATE AND YEAR(CURRENT_DATE) = YEAR(m.date_prevu) ORDER BY m.date_prevu DESC;";

    static $get_email = "SELECT e.email,m.type FROM employee e INNER JOIN medailles m ON m.id_employee = e.emp_id WHERE m.date_prevu = :d;";
}
