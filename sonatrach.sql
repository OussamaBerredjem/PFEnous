DROP TRIGGER `update_employee_date`;

DELIMITER $$
CREATE TRIGGER `update_employee_date` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN


    DECLARE total_duration INT;
    DECLARE date_recrutement DATE;
    DECLARE new_year INT;
    DECLARE dayse INT;
    DECLARE months INT;
    
    
    DECLARE new_date DATE;
    DECLARE argent_date DATE;
    DECLARE or_date DATE;
    DECLARE vermeil_date DATE;
    DECLARE platine_date DATE;
    DECLARE couronne_date DATE;
    DECLARE sp TEXT;

    
    SET date_recrutement = NEW.date_recrutement;
    SET new_year = YEAR(date_recrutement);
    SET months = MONTH(date_recrutement);
    SET dayse = DAY(date_recrutement);
    
    
    
        -- Determine the nearest next date for the "date_remise" field
    IF months < 2 OR (months = 2 AND dayse <= 24) THEN
        SET new_date = CONCAT(new_year, '-02-24');
       
    ELSEIF months < 5 OR (months = 5 AND dayse <= 1) THEN
        SET new_date = CONCAT(new_year, '-05-01');
       
    ELSEIF months < 7 OR (months = 7 AND dayse <= 5) THEN
        SET new_date = CONCAT(new_year, '-07-05');
       
    ELSEIF months < 11 OR (months = 11 AND dayse <= 1) THEN
        SET new_date = CONCAT(new_year, '-11-01');
        
    ELSE
        SET new_date = CONCAT(new_year, '-12-31');
      
    END IF;
    
        SET new_date = DATE_ADD(new_date,INTERVAL 15 YEAR);
        SET argent_date = DATE_ADD(new_date,INTERVAL 5 YEAR);
        SET or_date = DATE_ADD(new_date,INTERVAL 10 YEAR);
        SET vermeil_date = DATE_ADD(new_date,INTERVAL 15 YEAR);
        SET platine_date = DATE_ADD(new_date,INTERVAL 20 YEAR);
        SET couronne_date = DATE_ADD(new_date,INTERVAL 25 YEAR);
    
    UPDATE medailles 
    SET date_remise = new_date 
    WHERE id_employee = NEW.emp_id AND type = 'bronze';
    
    UPDATE medailles 
    SET date_remise = argent_date
    WHERE id_employee = NEW.emp_id AND type = 'argent';
    
    UPDATE medailles 
    SET date_remise = or_date
    WHERE id_employee = NEW.emp_id AND type = 'or';
    
    UPDATE medailles 
    SET date_remise = vermeil_date
    WHERE id_employee = NEW.emp_id AND type = 'vermeil';
    
    UPDATE medailles 
    SET date_remise = platine_date
    WHERE id_employee = NEW.emp_id AND type = 'platine';
    
    UPDATE medailles 
    SET date_remise = couronne_date
    WHERE id_employee = NEW.emp_id AND type = 'couronne';
    
   
   
END $$;
DELIMITER ;


 DROP TRIGGER `update_employee_date_prevu`;
DELIMITER $$
CREATE TRIGGER `update_employee_date_prevu` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN
    DECLARE total_duration INT;
    DECLARE date_recrutement DATE;
    DECLARE new_year INT;
    DECLARE dayse INT;
    DECLARE months INT;
    
    
    DECLARE new_date DATE;
    DECLARE argent_date DATE;
    DECLARE or_date DATE;
    DECLARE vermeil_date DATE;
    DECLARE platine_date DATE;
    DECLARE couronne_date DATE;
    DECLARE sp TEXT;

    DECLARE fo TEXT;

    SELECT SUM(DATEDIFF(date_fin, date_debut)) INTO total_duration
    FROM conges
    WHERE id_emp = NEW.emp_id AND validable = false;

    IF total_duration IS NULL THEN
    SET total_duration = 0;
    END IF;
    
    SET date_recrutement = DATE_ADD(NEW.date_recrutement,INTERVAL total_duration DAY);
    SET new_year = YEAR(date_recrutement);
    SET months = MONTH(date_recrutement);
    SET dayse = DAY(date_recrutement);
            
    IF months < 2 OR (months = 2 AND dayse <= 24) THEN
        SET sp =  '-02-24';
       
    ELSEIF months < 5 OR (months = 5 AND dayse <= 1) THEN
        SET sp =  '-05-01';
      
    ELSEIF months < 7 OR (months = 7 AND dayse <= 5) THEN
        SET sp = '-07-05';

    
       
    ELSEIF months < 11 OR (months = 11 AND dayse <= 1) THEN
        SET sp = '-11-01';

       
    ELSE
        SET sp = '-12-31';

       
    END IF;

        SET fo =  CONCAT((new_year+15), sp);
        
        SET argent_date =  CONCAT((new_year+20),sp);

        SET or_date = CONCAT((new_year+25), sp);
        
        SET vermeil_date =  CONCAT((new_year+30), sp);
        
        SET platine_date =  CONCAT((new_year+35), sp);
        
        SET couronne_date = CONCAT((new_year+40), sp);

    
    
    -- Add duration to date_recrutement
    UPDATE medailles 
    SET date_prevu = fo
    WHERE id_employee = NEW.emp_id AND type = 'bronze';
    
    UPDATE medailles 
    SET date_prevu = argent_date
    WHERE id_employee = NEW.emp_id AND type = 'argent';
    
    UPDATE medailles 
    SET date_prevu = or_date
    WHERE id_employee = NEW.emp_id AND type = 'or';
    
    UPDATE medailles 
    SET date_prevu = vermeil_date
    WHERE id_employee = NEW.emp_id AND type = 'vermeil';
    
    UPDATE medailles 
    SET date_prevu = platine_date
    WHERE id_employee = NEW.emp_id AND type = 'platine';
    
    UPDATE medailles 
    SET date_prevu = couronne_date
    WHERE id_employee = NEW.emp_id AND type = 'couronne';
    
   
   
END $$;
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `add_medaille_after_conges` AFTER INSERT ON `conges` FOR EACH ROW BEGIN
    DECLARE conges_duration INT;
    DECLARE is_valid BOOLEAN;
    DECLARE id INT;
    DECLARE total_conges INT;
    DECLARE po DATE;
    DECLARE emp DATE;
     DECLARE date_recrutement DATE;
    DECLARE new_year INT;
    DECLARE dayse INT;
    DECLARE months INT;
    
    
    DECLARE new_date DATE;
    DECLARE argent_date DATE;
    DECLARE or_date DATE;
    DECLARE vermeil_date DATE;
    DECLARE platine_date DATE;
    DECLARE couronne_date DATE;
    DECLARE sp TEXT;

    DECLARE nome TEXT;


    SET id = NEW.id_emp;
    SET emp = NEW.id_emp;

    SELECT SUM(DATEDIFF(date_fin, date_debut)) INTO total_conges  
    FROM conges 
    WHERE id_emp = id AND validable = false;

    SELECT nom INTO nome FROM employee WHERE emp_id = NEW.id_emp;

    -- Calculate the duration of the leave
	SET conges_duration = TIMESTAMPDIFF(DAY, NEW.date_debut, NEW.date_fin);
    
    -- Check if the leave is valid based on the validable column
    SET is_valid = NOT NEW.validable;
    
    IF is_valid THEN
        -- Update Medailles table

    UPDATE employee SET nom = nome WHERE emp_id = NEW.id_emp;

        
    END IF;
END
$$
DELIMITER ;