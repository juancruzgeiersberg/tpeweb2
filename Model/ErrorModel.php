<?php

class ErrorModel{

    public function errorRegister(){
        return "You must complete all fields.";
    }

    public function errorLoginIncorrect(){
        return "User or Password Incorrect.";
    }

    public function errorLoginVoid(){
        return "You must enter User and Password.";
    }

    public function errorUserExists(){
        return "User already exists";
    }
}
