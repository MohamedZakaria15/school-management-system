<?php


namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreGrade;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index()
  {
      $My_Classes = Classroom::all();
      $Grades = Grade::all();
      return view('pages.My_classes.my_classes',compact('My_Classes','Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(StoreClassroom $request)
  {

      $List_Classes = $request->List_Classes;


      try {
          $validated = $request->validated();

          foreach ($List_Classes as $List_Class) {

              $My_Classes = new Classroom();

              $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

              $My_Classes->Grade_id = $List_Class['Grade_id'];

              $My_Classes->save();

          }

          toastr()->success(trans('messages.success'));
          return redirect()->route('Classrooms.index');

      } catch (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }


  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request){
      $Classrooms = Classroom::findOrFail($request->id)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Classrooms.index');
  }

  public function delete_all(Request $request){
      $delete_all_id = explode(",",$request->delete_all_id);
      Classroom::whereIn('id',$delete_all_id)->Delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Classrooms.index');
  }
  public function Filter_Classes(Request $request){

      $grades = Grade::all();
      $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
      return view('pages.My_Classes.my_classes',compact('grades'))->withDetails($Search);
  }

}

?>
