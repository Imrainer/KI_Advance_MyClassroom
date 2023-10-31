<x-layout title="{{$assignment->title}} | My Classroom">
 
    <div class="d-flex">
    <x-Sidebar photo="{{$admin->photo}}" name="{{$admin->name}}"></x-Sidebar>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Lampiran</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>    
            <div class="modal-body">
            
              <form action="http://localhost/laravel_MyClassroom/public/lampiran/create" method="POST" enctype="multipart/form-data">
                @csrf
                    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">file</label>
                    <input type="file" class="form-control" name="file" id="exampleInputEmail1">
                </div>
      
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">assignment_id</label>
                    <input type="text" class="form-control" name="assignment_id" value="{{$assignment->id}}">
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
    <h1 class="p-3 text-primary">{{$assignment->title}}</h1>
    <h5 class="ms-3 text-muted"> {{$assignment->mata_pelajaran->name}}<br>
     {{$assignment->mata_pelajaran->nama_sekolah}}</h5>

    <div class="content">
        <h5 class="ms-3 mt-3">Description:</h5>
        <p class="text-muted ms-3">{{$assignment->description}}</p>
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary ms-3">Tambahkan lampiran </button>

        @if ($assignment->lampiran->isNotEmpty())
       <div class="d-flex flex-wrap">
        @foreach ($assignment->lampiran as $lampiran)
            @if ($lampiran->assignment_id == $assignment->id)
            <div class="ms-3 col-md-3 d-flex mt-5">
              <a href="http://localhost/laravel_MyClassroom/public/lampiran/delete/{{$lampiran->id}}" class=" ms-1 fas fa-trash text-danger mt-5"></a>
                
                <img src="{{ asset('storage/' . $lampiran->file) }}" class=" p-1" width="200px" alt="Lampiran Tugas"> 
             
              </div>
            @endif
        @endforeach
      </div>
    @else
    <div class="container">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary">Tambahkan lampiran </button>
    </div>
    @endif

  </div>
</div>

    </x-layout>