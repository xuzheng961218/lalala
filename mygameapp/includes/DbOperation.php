<?php

class DbOperation
{
    private $conn;
 
    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/constants.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        
        // connect database
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 

    // check if the user exist in database
  public function userLogin($username, $pass)
    {
        $password = md5($pass);
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
 
   
    //return user information in an array
    public function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT id, username, email, age FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $uname, $email, $age);
        $stmt->fetch();
        $user = array();
        $user['id'] = $id;
        $user['username'] = $uname;
        $user['email'] = $email;
        $user['age'] = $age;
        return $user;
    }
    
    
    //create a new user
    public function createUser($username, $pass, $email, $age)
    {
        if (!$this->userExist($username, $email)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO user (username, password, email, age) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $password, $email, $age);
            if ($stmt->execute()) {
                return USER_CREATED;
            } else {
                return USER_NOT_CREATED;
            }
        } else {
            return USER_ALREADY_EXIST;
        }
    }

    //save answer for question
    public function saveAnswerForQuestion($qID, $uID, $questionContext, $answer_q)
    {
    	 $stmt = $this->conn->prepare("INSERT INTO answerForQuestion (qID, uID, questionContext, answer_q) VALUES (?, ?, ?, ?)");
    	 $stmt->bind_param("iiss", $qID, $uID, $questionContext, $answer_q);
    	 $stmt->execute();
    }

    public function saveStatement($username, $remain, $newsletter){
        $stmt = $this->conn->prepare("INSERT INTO statement (username, remain, newsletter) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$username, $remain, $newsletter );
        $stmt->execute();
    }


    public function saveNominate($name, $age, $relation, $contact)
    {
        $stmt = $this->conn->prepare("INSERT INTO Nomination (name, age, relation, contact) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $name, $age, $relation, $contact);
        $stmt->execute();
    }


    public function saveDetail($username, $parentName, $childName, $childGender, $dateOfBirth, $postcode, $phoneNumber, $mumAge, $mumEducation, $dadAge, $dadEducation, $childEthnic){
          $stmt = $this->conn->prepare("INSERT INTO detail (username, parentName, childName, childGender, dateOfBirth, postcode, phoneNumber, mumAge, mumEducation, dadAge, dadEducation, childEthnic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssssssssss", $username, $parentName, $childName, $childGender, $dateOfBirth, $postcode, $phoneNumber, $mumAge, $mumEducation, $dadAge, $dadEducation, $childEthnic);
          $stmt->execute();
    }


    public function saveLanguage($username, $otherLanguage, $languageType, $time, $familyDifficulty, $difficultyDetail, $disability, $difficultyDetail, $concer, $concerDetail){
        $stmt = $this->conn->prepare("INSERT INTO languageQuestion (username, otherLanguage, languageType, times, familyDifficulty, difficultyDetail, disability, disabilityDetail, concer, concerDetail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $username, $otherLanguage, $languageType, $time, $familyDifficulty, $difficultyDetail, $disability, $difficultyDetail, $concer, $concerDetail);
        $stmt->execute();
    }

    public function saveAnswerForFeedback($answer1, $answer2, $answer3)
    {
        $stmt = $this->conn->prepare("INSERT INTO feedbackAnswer (Q1, Q2, Q3) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$answer1, $answer2, $answer3 );
        $stmt->execute();
    }
 
 
    // check if the information entered already in the database
    private function userExist($username, $email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }


    public function getImage($id)
    {
        $stmt = $this->conn->prepare("SELECT id, question1, question2, question3, question4, photo1, photo2, photo3, photo4 FROM question Where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $q1, $q2, $q3, $q4, $p1, $p2, $p3, $p4);
        $stmt->fetch();
        $image = array();
        $image['id'] = $id;
        $image['question1'] = $q1;
        $image['question2'] = $q2;
        $image['question3'] = $q3;
        $image['question4'] = $q4;
        $image['photo1'] = $p1;
        $image['photo2'] = $p2;
        $image['photo3'] = $p3;
        $image['photo4'] = $p4;
        return $image;

    }
    
}

