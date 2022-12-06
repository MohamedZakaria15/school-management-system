<?php


namespace App\Repository;
interface TeacherRepositoryInterface{
    //get all Teachers
    public function getAllTeachers();


      //CreateTeacher

    //GetSpecialization
    public function GetSpecialization();

    //GetGender

    public function GetGender();

    //store
    public function StoreTeachers($request);

    //Edit
    public function editTeachers($id);

    //update
    public function UpdateTeachers($request);

    //destroy
    public function deleteTeachers($request);

}
