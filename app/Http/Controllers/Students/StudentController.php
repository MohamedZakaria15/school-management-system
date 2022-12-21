<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use League\CommonMark\Block\Element\ThematicBreak;
use Monolog\Handler\RedisHandler;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;

    }

    public function index()
    {
       return $this->Student->Get_Students();

    }


    public function create()
    {
    return   $this->Student->Create_Students();
    }


    public function store(Request $request)
    {
        return $this->Student->Store_Students($request);
    }


    public function show($id)
    {
   return  $this->Student->Show_Students($id);
    }


    public function edit($id)
    {
        return $this->Student->Edit_Students($id);

    }

    public function update(Request $request)
    {
        return $this->Student->Update_Students($request);

    }


    public function destroy(Request $request)
    {
    return    $this->Student->Delete_Student($request);
    }
    public function Get_classrooms($id){

        return  $this->Student->Get_classrooms($id);

    }
    public function  Get_sections($id){

        return  $this->Student->Get_sections($id);

    }
    public function Upload_attachment(Request $request){
        return $this->Student->Upload_attachment($request);
    }
    public function Download_attachment($studentsname,$filename){
        return $this->Student->Download_attachment($studentsname,$filename);
    }
    public function Delete_attachment(Request $request){
        return $this->Student->Delete_attachment($request);
    }

}
