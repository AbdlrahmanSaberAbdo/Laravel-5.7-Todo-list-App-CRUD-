<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
    <title>To-do list apps</title>
  </head>
  <body>
  <div class="container">
    <div class="col-md-offset-2 col-md-8">
      <div class="row">
         <h1>Todo List</h1>
      </div>

      {{-- Display success message --}}
      @if(Session::has('success'))
        <div class="alert alert-success">
          <strong>Success: </strong>{{Session::get('success')}}
        </div>
      @endif
      {{-- Display Error message --}}
      @if(count($errors) > 0)
        <div class="alert alert-danger">
          <strong>Error: </strong>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row">
        <form action="{{route('task.store')}}" method="POST">
          {{ csrf_field() }}
          <div class="col-md-9">
            <input type="text" name="newTaskName" class="form-control">
          </div>
          <div class="col-md-3">
            <input type="submit" value="Craete new task" class="btn btn-primary">
          </div>
        </form>
      </div>

      <div class="row tasks">
        @if(count($storedTasks) > 0)
          <table class="table table-bordered">
            <thead>
              <th>Task Number</th>
              <th>Name</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach($storedTasks as $storedTask)
                <tr>
                  <td>{{$storedTask->id}}</td>
                  <td>{{$storedTask->name}}</td>
                  <td><a class="btn btn-info" href="{{route('task.edit', [$storedTask->id])}}">Edit</a></td>
                  <td>
                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{route('task.destroy', [$storedTask->id])}}" method="POST">
                      @csrf
                      @method("DELETE")
                      <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
        <div class="row text-center">
          {{$storedTasks->links()}}
        </div>
      </div>
    </div>
  </div>

<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
