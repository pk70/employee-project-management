<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProjectAssign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function index()
    {

        $project = Project::with(['projectAssign'])->get();

        return view('project')->with(['projects' => $project]);
    }
    /**
     * Display the user's profile form.
     */
    public function create(): View
    {
        $users = User::where('type', 'employee')->get();
        return view('project-create')->with(['users' => $users]);
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'assign_user' => 'required|array',
        ]);

        $project = Project::create(['name' => $request->name, 'created_by' => Auth::user()->id]);
        if ($project->id) {
            foreach ($request->assign_user as $key => $value) {
                ProjectAssign::create(
                    [
                        'id_project' => $project->id,
                        'assigned_user_id' => $value,
                        'user_name' => User::where('id', $value)->pluck('name')->first()
                    ]
                );
            }
        }

        return Redirect::route('admin.project')->with('status', 'created');
    }
}
