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
     * Worst student
     */
    public $worstStudent;

    /**
     * Best student
     */
    public $bestStudent;

    /**
     * Average age of students
     */
    public $ageAverage;

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

        $studentsSpecialitiesPercentage = array();
        for ($i = 0; $i < count($this->studentsSpecialitiesNumber); $i++) {
            $studentsSpecialitiesPercentage[$specialitiesIndexes[$i]] = $this->studentsSpecialitiesNumber[$specialitiesIndexes[$i]]/$this->numberOfStudents*100;
        }

        $this->studentsSpecialitiesPercentage = $studentsSpecialitiesPercentage;
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

    /**
     * Method which returns the worst student
     *
     * @return void
     */
    public function worstStudent(): void
    {
        $worstAverage = min($this->getStudentsAverages());
        $worstStudent = $this->students[array_search($worstAverage,$this->getStudentsAverages())];
        
        $this->worstStudent = $worstStudent;
    }
    
    /**
     * Method which returns the best student
     *
     * @return void
     */
    public function bestStudent(): void
    {
        $bestAverage = max($this->getStudentsAverages());
        $bestStudent = $this->students[array_search($bestAverage,$this->getStudentsAverages())];
        
        $this->bestStudent = $bestStudent;
    }
    
    /**
     * Method which returns all students ages
     *
     * @return Array
     */
    private function studentsAges(): Array
    {
        $studentsAges = array();
        foreach ($this->students as $student) {
            $studentsAges[] = $student->getAge();
        }

        return $studentsAges;
    }

    /**
     * Method which returns the average age of students
     *
     * @return void
     */
    public function ageAverage(): void
    {
        $ageAverage = array_sum($this->studentsAges()) / $this->numberOfStudents;

        $this->ageAverage = $ageAverage;
    }
    
    /**
     * Method which returns the minimum age
     *
     * @return void
     */
    public function minAge(): void
    {
        $minAge = min($this->studentsAges());
        
        $this->minAge = $minAge;
    }
    
    /**
     * Method which returns the maximum age
     *
     * @return void
     */
    public function maxAge(): void
    {
        $maxAge = max($this->studentsAges());
        
        $this->maxAge = $maxAge;
    }
    
    // classer les élèves par ordre alphabétique
    public function alphabeticalOrder(): void
    {
        $studentsSorted = array();
        var_dump($this->students);
        foreach ($this->students as $student) {
            var_dump($student);
        }
        echo '<hr/>';

        $studentsNames = array();
        foreach ($this->students as $student) {
            $studentsNames[] = $student->lastName;
        }
        sort($studentsNames);
        var_dump($studentsNames);
        echo '<hr/>';
        

        
        
    }
    
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
$promo->worstStudent();
$promo->bestStudent();
$promo->ageAverage();
$promo->minAge();
$promo->maxAge();
$promo->alphabeticalOrder();

var_dump($promo);

?>