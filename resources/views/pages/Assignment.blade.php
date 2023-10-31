<x-layout title="Assignment | My Classroom">
 
    <div class="d-flex">
    <x-Sidebar photo="{{$admin->photo}}" name="{{$admin->name}}"></x-Sidebar>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Assignment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>    
          <div class="modal-body">
          
            <form action="http://localhost/laravel_MyClassroom/public/assignment/create" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title">
                </div>
    
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Description</label>
                  <input type="text" class="form-control" name="description">
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Due</label>
                    <input type="date" class="form-control" name="due_date">
                  </div>

                  <div class="dropdown">
                    <label for="mapel-select">Mata Pelajaran:</label>
                    <select class="form-control" id="mapel-select" name="mata_pelajaran_id">
                        <option value="">Select a mapel</option>
                        @foreach ($mapel as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                        @endforeach
                    </select>
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
    
      <div class=" col-md-10">
    
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @foreach($errors->all() as $msg)
      <div class="alert alert-danger">{{$msg}}</div>
      @endforeach
      
    
    <div class="mt-5 ms-5 col-md-12 ">
    
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-success mb-1 mt-3"><i class="fas fa-user-plus"></i> Add New</button>
        
        <form action="http://localhost/laravel_MyClassroom/public/assignment" method="GET" class="col-md-9 mt-3">
          <div class="mb-3 d-flex">
            <i class="fas fa-search mt-2 me-3"></i>
            <input type="search" name="search" class="form-control col-md-5" placeholder="Type here">
            <button class="btn btn-outline-success ms-3">Search</button>
          </div>
        </form>
        
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>  
              @php
              $counter = ($assignment->currentPage() - 1) * $assignment->perPage() + 1;
                @endphp     
               @foreach ($assignment as $index => $item)
               <tr>
                <th scope="row">{{ $counter++ }}</th>
                <td>{{$item->title}}</td>
                <td>
                <a href="http://localhost/laravel_MyClassroom/public/assignment/{{$item->id}}" class="me-1 text-warning fw-bold text-decoration-none">Open</a>
                <a href="http://localhost/laravel_MyClassroom/public/assignment/edit/{{$item->id}}" class="me-1 fas fa-pen text-primary text-decoration-none"></a>
                <a href="http://localhost/laravel_MyClassroom/public/assignment/delete/{{$item->id}}" class="ms-1 fas fa-trash text-danger"></a>  
                <td>
              </tr>
              @endforeach
            </tbody>
          </table>
    
          {{$assignment->links()}}
    </div>
    </div>
    
    </x-layout>