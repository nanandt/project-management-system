<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\ProjectFile;
use App\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $items = ProjectFile::where('projects_id', $id)->get();



        return view('pages.project.project-file', compact('items', 'project'));
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
    public function store(Request $request, $id)
    {
        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file_name) {
                $originalName = $file_name->getClientOriginalName();
                $file[] = [
                    'projects_id' => $id,
                    'file_name' => $originalName,
                    'file_path' => $file_name->storeAs('public/assets/file_project', $originalName),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            ProjectFile::insert($file);
        }

        return redirect()->route('project-file', $id);
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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProjectFile::findOrFail($id);
        $projects_id = $item->projects_id;
        $path = '/public/assets/file_project/' . $item->file_name;
        Storage::delete($path);
        $item->delete();

        return redirect()->route('project-file', $projects_id);
    }

    public function download($file_name)
    {
        return response()->download(storage_path('/app/public/assets/file_project/' . $file_name));
    }
}
