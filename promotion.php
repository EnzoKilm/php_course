<?php

// We include the file "student.php" which contains the Student class
include 'student.php';

class Promotion
{
    /**
     * Array with all students
     */
    public $students;

    /**
     * Number of students
     */
    public $numberOfStudents;

    /**
     * Number of students with the specified gender
     */
    public $sexNumber;

    /**
     * Percentage of students with the specified gender
     */
    public $sexPercentage;

    /**
     * Array with specialities and the number students who choosed it
     */
    public $studentsSpecialitiesNumber;

    /**
     * Array with the percentage of students in each speciality
     */
    public $studentsSpecialitiesPercentage;

    /**
     * Class average marks
     */
    public $classAverage;

    /**
     * Constructor
     *
     * @param Array $students
     */
    public function __construct(
        Array $students
    ) {
        $this->students = $students;
        $this->numberOfStudents = $this->getStudentsNumber();
    }

    /**
     * Method which gets the number of students based on the array "students"
     *
     * @return void
     */
    public function getStudentsNumber()
    {
        $numberOfStudents = count($this->students);

        return $numberOfStudents;
    }

    /**
     * Method which returns the number of students with
     * the gender choosen
     *
     * @param String $gender
     * @return void
     */
    public function getSexNumber(String $gender): void
    {
        $sexNumber = 0;
        foreach ($this->students as $student) {
            if ($student->sex == $gender) {
                $sexNumber += 1;
            }
        }

        $this->sexNumber = $sexNumber;
    }
    
    /**
     * Method which returns the percentage of the gender choosen
     *
     * @param String $gender
     * @return void
     */
    public function getSexPercentage(String $gender): void
    {
        if (!isset($this->sexNumber)) {
            $this->getSexNumber($gender);
        }
        $sexPercentage = $this->sexNumber/$this->numberOfStudents*100;

        $this->sexPercentage = $sexPercentage;
    }
    
    /**
     * Method which returns an array containing specialities choosen by students
     * and the number of students who choosed them
     *
     * @return void
     */
    public function getStudentSpecialityNumber(): void
    {
        $studentsSpecialitiesNumber = array();
        foreach ($this->students as $student) {
            if (!isset($studentsSpecialitiesNumber[$student->speciality])) {
                $studentsSpecialitiesNumber[$student->speciality] = 1;
            }
            else {
                $studentsSpecialitiesNumber[$student->speciality] += 1;
            }
        }

        $this->studentsSpecialitiesNumber = $studentsSpecialitiesNumber;
    }
    
    /**
     * Method which returns an array containing specialities choosen by students
     * and the percentage of students who choosed them
     *
     * @return void
     */
    public function getStudentSpecialityPercentage(): void
    {
        if (!isset($this->studentsSpecialitiesNumber)) {
            $this->getStudentSpecialityNumber();
        }

        $specialitiesIndexes = array_keys($this->studentsSpecialitiesNumber);

        $specialitiesPercentage = array();
        for ($i = 0; $i < count($this->studentsSpecialitiesNumber); $i++) {
            $specialitiesPercentage[$specialitiesIndexes[$i]] = $this->studentsSpecialitiesNumber[$specialitiesIndexes[$i]]/$this->numberOfStudents*100;
        }

        $this->specialitiesPercentage = $specialitiesPercentage;
    }
    
    /**
     * Method which returns an array containing marks of all students
     *
     * @return Array
     */
    private function getStudentsAverages(): Array
    {
        $studentsAverages = array();
        foreach ($this->students as $student) {
            $studentsAverages[] = $student->marksAverage;
        }

        return $studentsAverages;
    }

    /**
     * Method which returns the marks average of the class
     *
     * @return void
     */
    public function getClassAverage(): void
    {
        $classAverage = array_sum($this->getStudentsAverages()) / $this->numberOfStudents;
        
        $this->classAverage = $classAverage;
    }
    
    // plus mauvais élève
    public function worstStudent(): void
    {
        $worstAverage = array();

        
    }
    
    // meilleur élève
    
    // moyenne d'âge
    
    // âge minimum
    
    // âge maximum
    
    // classer les élèves par ordre alphabétique
    
    // nombre d'élèves ayant un nom OU un prénom contenant la lettre "a"
    
    // nombre d'élèves ayant uniquement le prénom contenant la lettre "u"
    
    // nombre d'élèves nés avant 1999

    // nombre d'élèves nés après 2001
    
}

$promo = new Promotion([$st1, $st2, $st3, $st4]);

$promo->getSexNumber('H');
$promo->getSexPercentage('H');
$promo->getStudentSpecialityNumber();
$promo->getStudentSpecialityPercentage();
$promo->getClassAverage();

var_dump($promo);

?>