<?php
    class User {
        private $id;
        private $username;
        private $password;
        private $firstname;
        private $lastname;
        private $emailAddress;
        private $streetAddress;
        private $city;
        
        public function __construct() {
            $this->id = "";
            $this->username = "";
            $this->password = "";
            $this->firstname = "";
            $this->lastname = "";
            $this->emailAddress = "";
            $this->streetAddress = "";
            $this->city = "";
        }

        // login

        public function login($database, $username, $password) {
            $this->username = validateString($username);
            $this->password = validateString($password);

            $database->login($this->username, $this->password);
        }

        // check if user exist

        public function checkIfUserExists($database, $username) {
            $this->username = $username;

            $database->checkIfUserExists($this->username);
        }

	    // addNewUser

        public function addNewUser($database, $username, $password) {
            $this->username = validateString($username);
            $this->password = validateString($password);

            $database->addNewUser($this->username, $this->password);
        }

        // update password

        public function updateUserPassword($database, $id, $password) {
            $this->id = validateINT($id);
            $this->password = validateString($password);
            
            $database->updateUserPassword($this->id, $this->password);
        }

        // remove user

        public function removeUser($database, $id) {
            $this->id = validateINT($id);

            $database->removeUser($this->id);
        }

        // get profile details

        public function getProfileDetails($database, $id) {
            $this->id = validateINT($id);

            $database->getProfileDetails($this->id);
        }

        // for testing purposes

        public function viewCredentials() {

        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getUsername() {
            return $this->username;
        }
    }

    $user = new User();

    

?>