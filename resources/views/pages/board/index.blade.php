@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">{{ $item->project_name }} Board</h3>
          </div>
        </div>
        <div class="row">
          <div class="col p-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="{{ route('my-project.index') }}">My Project</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  {{ $item->project_name }} Board
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <button
            class="btn btn-primary btn-sm text-primary" type="button" data-toggle="modal" data-target="#createBoard" 
            >
            <i class="fas fa-plus"></i> Create Board
          </button>
        </div>
      </div>
      
      <div class="scrolling-wrapper">
        @foreach ($boards as $board)
        <!-- Board card -->
        <div class="card bg-light align-top" style="width: 320px;">
          <div class="card-body">
            <div class="row">
              <p
              style="font-weight: 600; font-size: 17px;"
              class="text-dark"
              >
              {{ $board->board_name }}
            </p>
          </div>
          <!-- Board task -->
          
          @forelse ($board->board_task as $task)
          <div class="row mb-3">
            <div class="board-content">
              <div class="row mb-4">
                <div class="col-8">
                  <a href="" style="text-decoration: none" 
                  data-toggle="modal"
                  data-remote="{{ route('show-task', $task->id) }}"
                  data-title="{{ $task->task_name }}"
                  data-target=".bd-example-modal-lg">
                  <p>
                    {{ $task->task_name }}
                  </p>
                </a>
              </div>
              <div class="col-4 text-right">
                <button
                class="btn btn-sm btn-transparent text-black"
                >
                <i class="fas fa-thumbtack"></i>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <p class="assigned-to mb-2">
                Assigned To
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="assigned-profile">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="30"
                alt=""
                />
              </div>
            </div>
          </div>
        </div>
        
      </div>
      @empty 
      <div class="row mb-3">
        <div class="board-content">
          <div class="row">
            <div class="col-12 pt-2">
             
              <p class="text-center">
                Tasks is empty
              </p>
         
          </div>
      </div>
    </div>
    
  </div>
  
  @endforelse
  
  <!-- Button create task -->
  <div class="row justify-content-center">
    <a
    style="text-decoration:none;" class="text-black-50" href="#" type="button" 
    data-toggle="modal" 
    data-target="#createTask" 
    data-remote="{{ route('show-create-task', $board->id) }}"
    data-title="Create Task"
    >
    <i class="fas fa-plus"></i> Create Task
  </a>
</div>
</div>
</div>



<!-- End of board -->

@endforeach
</div>
</div>
</div>
</section>

</div>





<!-- Create Board Modal -->
<div class="modal fade" id="createBoard" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Create Board</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('create-board',$item->id) }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="board_name" class="form-control" placeholder="Board Name">
        </div>
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
      </form>
    </div>
  </div>
</div>
</div>



@endsection



