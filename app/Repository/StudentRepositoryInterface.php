<?php


namespace App\Repository;
interface StudentRepositoryInterface{
   //Get Add Form Student
   public function Create_Students();


   //Get_Students
    public function Get_Students();
  //Edit_Add_form
    public function Edit_Students($id);
   //get_classRooms
    public function Get_classrooms($id);

    //get Sections
    public function Get_sections($id);
    //store Students
    public function Store_Students($request);
    //Update
    public function Update_Students($request);

    //DEstroy
    public function Delete_Student($request);



}
