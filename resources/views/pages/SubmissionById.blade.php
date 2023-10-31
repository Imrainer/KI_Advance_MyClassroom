<x-layout title="{{$submission->user->name}} | My Classroom">
 
    <div class="d-flex">
    <x-Sidebar photo="{{$admin->photo}}" name="{{$admin->name}}"></x-Sidebar>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Nilai</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>    
            <div class="modal-body">
            
              <form action="http://localhost/laravel_MyClassroom/public/score/score" method="POST" enctype="multipart/form-data">
                @csrf
                    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Score</label>
                    <input type="text" class="form-control" name="score" id="exampleInputEmail1">
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Comment</label>
                  <input type="text" class="form-control" name="comment" id="exampleInputEmail1">
              </div>
      
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">submission_id</label>
                  <input type="text" class="form-control" name="submission_id" value="{{$submission->id}}">
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">user_id</label>
                  <input type="text" class="form-control" name="user_id" value="{{$submission->user->id}}">
                </div>
  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                  
              </form> 
            </div>
      
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Nilai</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>    
            <div class="modal-body">
            
              <form action="http://localhost/laravel_MyClassroom/public/score/edit/{{$scoreId}}" method="POST" enctype="multipart/form-data"> @csrf @method('put')
                @csrf
                    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Score</label>
                    <input type="text" class="form-control" value="{{ $score ? $score->score : '' }}" name="score" id="exampleInputEmail1">
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Comment</label>
                  <input type="text" class="form-control" name="comment" value="{{ $score ? $score->comment : '' }}" id="exampleInputEmail1">
              </div>
      
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">submission_id</label>
                  <input type="text" class="form-control" name="submission_id" value="{{$submission->id}}">
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">user_id</label>
                  <input type="text" class="form-control" name="user_id" value="{{$submission->user->id}}">
                </div>
  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                  
              </form> 
            </div>
      
            </div>
          </div>
        </div>
      </div>

      <div class="kontener ms-4 border shadow-lg col-md-9">
        <h1 class="p-3 text-dark">{{$submission->assignment->title}}</h1>

        @if (empty($score->score))
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary ms-3 col-md-2">Nilai</button>
    @else
        <a data-bs-toggle="modal" data-bs-target="#modaledit" class="ms-1 btn btn-warning text-light">Edit Nilai</a>
        <a href="http://localhost/laravel_MyClassroom/public/score/delete/{{$score->id}}" class="ms-1 btn btn-danger">Hapus Nilai</a>
    @endif

        <h5 class="p-3 text-muted">{{$submission->user->name}}<br>
    
        <div class="content">
            <h5 class="pt-3">Lampiran:</h5>
    
            @if ($submission->assignment->lampiran->isNotEmpty())
            <div class="d-flex flex-wrap">
            @foreach ($submission->assignment->lampiran as $lampiran)
                <img src="{{ asset('storage/' . $lampiran->file) }}" class="p-1" width="400px" alt="Lampiran Tugas">
            @endforeach
            </div>
            @else
            <div class="container">
                <a href={{$submission->link}}>
            </div>
            @endif
        </div>
    </div>
    
    </x-layout>