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
     *  Number of students with the letter 'a' in their first or last name
     */
    public $studentsAInName;

    /**
     * Number of students with the letter 'u' in their first name
     */
    public $studentsUInFirstName;

    /**
     * Number of students born before 19999
     */
    public $studentBornBefore1999;

    /**
     * Number of students born after 2001
     */
    public $studentBornAfter2001;

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
        return count($this->students);
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
    
    /**
     * Method which sort students last names by alphabetical order
     *
     * @return void
     */
    public function alphabeticalOrder(): void
    {
        $studentsSorted = array();
        foreach ($this->students as $student) {
            $studentsSorted[] = $student->lastName;
            sort($studentsSorted);
        }
        
        $this->studentsSorted = $studentsSorted;
    }
    
    /**
     * Method which returns the number of students with the letter 'a' in their
     * first or last name
     *
     * @return void
     */
    public function AInName(): void
    {
        $studentsAInName = 0;
        foreach ($this->students as $student) {
            if (strpos(strtolower($student->firstName), 'a') == true) {
                $studentsAInName += 1;
            } else if (strpos(strtolower($student->lastName), 'a') == true) {
                $studentsAInName += 1;
            }
        }

        $this->studentsAInName = $studentsAInName;
    }
    
    /**
     * Method which returns the number of students with the letter 'u' in their
     * first name
     *
     * @return void
     */
    public function UInFirstName(): void
    {
        $studentsUInFirstName = 0;
        foreach ($this->students as $student) {
            if (strpos(strtolower($student->firstName), 'u') == true) {
                $studentsUInFirstName += 1;
            }
        }

        $this->studentsUInFirstName = $studentsUInFirstName;
    }
    
    /**
     * Method which returns the number of students born before 1999
     *
     * @return void
     */
    public function bornBefore1999(): void
    {
        $studentBornBefore1999 = 0;
        foreach ($this->students as $student) {
            $dateOfBirth = date_create_from_format("d/m/Y", $student->birthDate);
            if ($dateOfBirth->format('Y') < 1999) {
                $studentBornBefore1999 += 1;
            }
        }

        $this->studentBornBefore1999 = $studentBornBefore1999;
    }

    /**
     * Method which returns the number of students born before 1999
     *
     * @return void
     */
    public function bornAfter2001(): void
    {
        $studentBornAfter2001 = 0;
        foreach ($this->students as $student) {
            $dateOfBirth = date_create_from_format("d/m/Y", $student->birthDate);
            if ($dateOfBirth->format('Y') > 2001) {
                $studentBornAfter2001 += 1;
            }
        }

        $this->studentBornAfter2001 = $studentBornAfter2001;
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
$promo->AInName();
$promo->UInFirstName();
$promo->bornBefore1999();
$promo->bornAfter2001();

var_dump($promo);

?>