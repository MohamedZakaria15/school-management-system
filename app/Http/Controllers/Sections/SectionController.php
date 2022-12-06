<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSection;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;

use App\Models\Sections;
use Illuminate\Http\Request;
use SebastianBergmann\Diff\Exception;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
//        $Sections = Sections::findOrFail(1);
//        return $Sections->teachers;

        $Grades = Grade::with(['Sections'])->get();
        $list_grades=Grade::all();
        $teachers=Teacher::all();
        return view('pages.sections.Sections',compact('Grades','list_grades','teachers'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSection $request)
    {

        try {
            $validated = $request->validated();
            $Sections = new Sections();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar,'en' => $request->Name_Sectoin_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status =1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));

            return redirect()->route('Sections.index');


        }
        catch (\Exception $exception)
        {
          return redirect()->back()->withErrors(['error' => $exception->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(StoreSection $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSection $request)
    {
        try {
            $validated = $request->validated();
            $Sections = Sections::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }

            $Sections->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
  Sections::findOrFail($request->id)->delete();
  toastr()->error(trans('messages.Delete'));
  return redirect()->route('Sections.index');
    }
    public function getClasses($id){
        $list_classes = Classroom::where("Grade_id",$id)->pluck("Name_Class","id");
        return $list_classes;
     }
}
