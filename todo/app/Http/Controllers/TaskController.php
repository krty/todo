<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Task;
use Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
    	 $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    	$task = new Task;
		$task->name = $request->name;
		$task->done = false;
		$task->save();
	    return redirect('/');
		
    }

    public function show()
    {
    	$tasks = Task::orderBy('created_at', 'asc')->get();
	    return view('tasks', [
	        'tasks' => $tasks
	    ]);
    }

	public function done($id,Request $r)
	{
		$task = Task::findOrFail($id);
	    if(Input::get('done') == "on")
	    {
	        $input['done'] = true;
	        $task->update($input);
	    }
	    else{
	        $input['done'] = false;
	        $task->update($input);
	    }
			return redirect('/');
	}

    public function delete($id) 
    {
	    Task::findOrFail($id)->delete();
	    return redirect('/');
	}
}
