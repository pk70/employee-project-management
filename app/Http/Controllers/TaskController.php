<?php

namespace App\Http\Controllers;

use Serializable;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\Project;
use App\Models\TaskInfo;
use Illuminate\View\View;
use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Stevebauman\Location\Facades\Location;

class TaskController extends Controller
{
    /**
     * Display the tasks list.
     */
    public function index(): view
    {

        $tasks = Task::with(['taskHistory', 'taskInfo'])->get();

        return view('task')->with(['tasks' => $tasks]);
    }
    /**
     * Display the user's profile form.
     */
    public function create(): View
    {
        $projects = Project::all();
        return view('task-create')->with(['projects' => $projects]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $project = Project::with(['projectAssign'])->where('id', $id)->first();

        $users = User::where('type', 'employee')->get();
        return view('project-edit')->with(['project' => $project, 'users' => $users]);
    }
    /**
     * Display the user's profile form.
     */
    public function view($id): View
    {
        $task = Task::with(['taskHistory', 'taskinfo'])->where('id', $id)->first();
        //echo "<pre>";print_r($task);exit;
        return view('task-view')->with(['task' => $task]);
    }

    /**
     * Update the project's information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'assign_user' => 'required|array',
            'id_project' => 'required|int|exists:projects,id',
        ]);
        //todo
        $project = Project::where('id', $request->id_project)
            ->update(['name' => $request->name]);
        if ($request->id_project) {
            foreach ($request->assign_user as $key => $value) {
                ProjectAssign::updateOrCreate(
                    [
                        'id_project' => $request->id_project,
                        'assigned_user_id' => $value
                    ],
                    ['assigned_user_id' => $value]
                );
            }
        }

        return Redirect::route('admin.project')->with('status', 'updated');
    }


    /**
     * create project.
     */
    public function store(Request $request): RedirectResponse|string
    {


        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'id_project' => 'required|int',
            'task_image' => 'nullable|mimes:jpg,png',
            'location_information' => 'nullable',
        ]);

        $image_name = null;

        try {

            $task = Task::create([
                'task_name' => $request->task_name,
                'created_by' => Auth::user()->id,
                'id_project' => $request->id_project
            ]);
            if ($request->has('task_image')) {
                $file = $request->file('task_image');
                $image_name = $task->id . "_" . $file->getClientOriginalName();
                $file->move(storage_path(),  $image_name);
            }

            TaskInfo::create([
                'id_tasks' => $task->id,
                'file_path' => ($image_name != null ? storage_path() . "/" . $image_name : null),
                'location_information' => $this->getUserLocation()
            ]);

            return Redirect::route('admin.task')->with('status', 'created');
        } catch (\Exception $th) {
            return $th->getMessage();
            unlink(storage_path() . "/" . $image_name);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function start($id): RedirectResponse
    {
        TaskHistory::create([
            'id_tasks' => $id,
            'task_start' => Carbon::now(),
            'status' => 1
        ]);

        return Redirect::route('admin.task.view', ['id' => $id]);
    }
    /**
     * Display the user's profile form.
     */
    public function stop($id): RedirectResponse
    {
        TaskHistory::where('id_tasks', $id)->update([
            'task_end' => Carbon::now(),
            'status' => 2
        ]);

        return Redirect::route('admin.task.view', ['id' => $id]);
    }
    /**
     * Display the user's profile form.
     */
    public function breakStart($id): RedirectResponse
    {

        TaskHistory::where('id_tasks', $id)->update([
            'break' => 'yes',
            'break_start' => Carbon::now(),
        ]);

        return Redirect::route('admin.task.view', ['id' => $id]);
    }
    /**
     * Display the user's profile form.
     */
    public function breakEnd($id): RedirectResponse
    {

        TaskHistory::where('id_tasks', $id)
            ->where('break', 'yes')->update([
                'break' => 'resume',
                'break_end' => Carbon::now(),
            ]);

        return Redirect::route('admin.task.view', ['id' => $id]);
    }

    public function getUserLocation()
    {
        $ip = '103.239.147.187'; //For static IP address get
        //$ip = request()->ip(); //For static IP address get
        $data = Location::get($ip);
        return serialize($data);
    }

    public function getDownload($filname)
    {

        $filepath = storage_path() . "/" . $filname;

        $headers = array(
            'Content-Type: application/*',
        );

        return response()->download($filepath, $filname, $headers);
    }
}
