<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //show
    public function show(Request $request)
    {
       return Task::all();
    }

     //show
     public function create(Request $request)
     {
         $this->validate($request, [
            'value'=> 'required'
         ]);

        Task::create([
            'task' => $request->value,
            'date' => now()
        ]);
     }

     public function destroy(Request $request)
     {
         # code...
         $this->validate($request, [
            'id'=> 'required'
         ]);

         Task::where('id', $request->id)->delete();
     }

     public function update(Request $request)
     {
         # code...
         $this->validate($request, [
            'id'=> 'required'
         ]);

         
            $check = Task::where('id', $request->id)->get([
                'checkRead'
            ]);

            $validCheck = null;
            
            foreach ($check as $c) {
                $validCheck = $c;

            }

            if ($validCheck->checkRead == 1) {
                Task::where('id', $request->id)->update([
                    'checkRead' => 0
                ]);
            }
            else if ($validCheck->checkRead == 0) {
                Task::where('id', $request->id)->update([
                    'checkRead' => 1
                ]);
            }
     }
}
