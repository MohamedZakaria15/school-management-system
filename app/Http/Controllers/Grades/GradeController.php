<?php

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrade;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.grades.grades',compact('Grades'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrade $request)
    {
        $validated = $request ->validated();
        $Grade = new Grade();
        $Grade->Name = ['en'=> $request->Name_en,'ar'=>$request->Name];
        $Grade->Notes = $request ->Notes;
        $Grade->save();


        toastr()->success('Data has been saved successfully');
        return redirect()->route('Grades.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrade $request)
    {
        if(Grade::where('Name->en',$request->Name)->orWhere('Name_ar',$request->Name_ar)->exists())
        {
            return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        }
        try {
            $validated = $request->validated();
            $Grades=Grade::findOrfail($request->id);
            $Grades->update([
                $Grades->Name = ['ar' => $request->Name,'en' =>$request->Name_en],
                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        }
        catch (\Exception $exception){
        return redirect()->back()->withErrors(['error'=> $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request = Grade::findOrfail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('Grades.index');
    }
}
