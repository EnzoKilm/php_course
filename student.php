<?php

// Créationg student class
Class Student
{

    /**
     * Student first name
     */
    public $firstName;

    /**
     * Student last name
     */
    public $lastName;
    
    /**
     * Student birth date
     */
    public $birthDate;
    
    /**
     * Student sex
     */
    public $sex;
    
    /**
     * Student specialty
     */
    public $speciality;

    /**
     * Student marks
     */
    public $marks;

    /**
     * Students marks average
     */
    public $marksAverage;

    /**
	 * Student age
	 */
	public $age;

    /**
     * Constructor
     *
     * @param String $firstName
     * @param String $lastName
     * @param String $birthDate
     * @param String $sex
     * @param String $speciality
     * @param Array $marks
     */
    public function __construct(
        String $firstName,
        String $lastName,
        String $birthDate,
        String $sex,
        String $speciality,
        Array $marks
    ) {
        // On demande d'affecter la valeur "firstName" passée
        // en paramètre, à l'attribut "firstName" de la classe. Le "$this" permet
        // de faire référence à la classe courante (et donc un élément qui
        // s'y trouve)
        $this->firstName = $firstName;
        // On fait la même pour tous les paramètres
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->sex = $sex;
        $this->speciality = $speciality;
        $this->marks = $marks;
        // On calcule ici la moyenne de l'étudiant et on l'affiche à
        // l'attribut "marksAverage" pour ne pas avoir à refaire le calcul
        // de la moyenne plusieurs fois
        $this->average();
        // On définit l'âge de l'étudiant grâce à sa date de naissance
        $this->age = $this->getAge();
    }

    /**
     * Method which returns the average of the Student Marks
     * based on the "marks" attribute and set it to the marksAverage
     * attribute
     *
     * @return void
     */
    public function average(): void
    {
        $this->marksAverage = array_sum($this->marks) / count($this->marks);
    }

    /**
     * Method which add a mark to the "marks" attribute array
     *
     * @param Int $markToAdd
     * @return void
     */
    public function addMark(Int $markToAdd): void
    {
        // Adding the new mark to the array
        $this->marks[] = $markToAdd;
        // Updating the marksAverage
        $this->average();
    }

    /**
     * Method which returns whether an index exists in the marks array
     *
     * @param Int $indexToCheck
     * @return Bool
     */
    private function checkIndex(Int $indexToCheck): Bool
    {
        if (isset($this->marks[$indexToCheck])) {
            return True;
        }
        return False;
    }

    /**
     * Method which remove a mark to the "marks" attribute array
     *
     * @param Int $indexMarkToRemove
     * @return void
     */
    public function removeMark(Int $indexMarkToRemove): void
    {
        // Checking if the index exists
        if ($this->checkIndex($indexMarkToRemove)) {
            // Removing the mark with its index
            unset($this->marks[$indexMarkToRemove]);
            // Resetting the array's index
            $this->marks = array_values($this->marks);
            // Updating the marksAverage
            $this->average();
        }
    }

    /**
     * Method which updates a mark in the "marks" attribute array
     *
     * @param Int $indexMarkToUpdate
     * @param Float $newMark
     * @return void
     */
    public function updateMark(Int $indexMarkToUpdate, Float $newMark): void
    {
        // Checking if the index exists
        if ($this->checkIndex($indexMarkToUpdate)) {
            // Updating the mark with its index
            $this->marks[$indexMarkToUpdate] = $newMark;
            // Updating the marksAverage
            $this->average();
        }
    }


    // @TODO
    // Méthode qui renvoie l'âge de l'étudiant
    public function getAge()
    {
        // birthDate
        $currentDate =  new DateTime();
        $dateOfBirth = date_create_from_format("d/m/Y", $this->birthDate);
        $age = $dateOfBirth->diff($currentDate)->y;

        return $age;
    }

}

// // On fait nos tests ici
$st1 = new Student("Enzo", "Beauchamp", "03/09/2001", "H", "DEV", [15, 10, 18, 20]);
$st2 = new Student("Maxime", "Barbereau", "15/05/1998", "F", "DEV", [10, 13, 7, 9]);
$st3 = new Student("Germain", "Robard", "04/02/2001", "H", "DEV", [12, 8, 11, 14]);
$st4 = new Student("Quentin", "Camilleri", "13/03/2002", "H", "OPS", [18, 16, 13, 14]);
// echo '<pre><code>';
// var_dump($st1);
// echo '</code></pre><hr/>';

// // Afficher uniquement le prénom de l'étudiant
// // echo $st1->firstName;

// // // Afficher la moyenne des notes
// // echo '<br/>';
// // echo $st1->average();

// // Ajout d'une note et affichage du tableau de notes
// $st1->addMark(16);
// var_dump($st1->marks);
// echo '<pre><code>';
// var_dump($st1);
// echo '</code></pre><hr/>';

// // // Suppression d'une note et affichage du tableau de notes
// $st1->removeMark(2);
// var_dump($st1->marks);
// echo '<pre><code>';
// var_dump($st1);
// echo '</code></pre><hr/>';

// // // Modification d'une note et affichage du tableau de notes
// $st1->updateMark(1, 20);
// var_dump($st1->marks);
// echo '<pre><code>';
// var_dump($st1);
// echo '</code></pre><hr/>';

// var_dump($st1);
?>