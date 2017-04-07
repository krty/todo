
@extends('layouts.app')

@section('content')
    <div class="panel panel-default" style="margin-top:15px">
        <div class="panel-heading">
                New Task
        </div>
        <!-- New Task Form -->
        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group"  style="margin-top:15px">
                <label for="task" class="col-sm-2 control-label" >Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
            </div>
        </form>
    </div>
    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>
                                <!-- Mark Done Task-->
                              <td>
                                   {!! Form::open(array('url' => 'task/' . $task->id . '/active')) !!}
                                   {!! Form::hidden('done', false) !!}
                                   {!! Form::checkbox('done',null,$task->done, array('id'=>'done')) !!}
                                  <button type="submit" name="step[0]" value="submit">Done</button>
                                   {!! Form::close() !!}
                              </td>

                               <!-- Delete Button -->
                                <td>
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete Task</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection