<x-layout title="Submission | Jelajah Nusantara">
 
    <div class="d-flex">
    <x-Sidebar photo="{{$admin->photo}}" name="{{$admin->name}}"></x-Sidebar>
    
      <div class=" col-md-10">
    
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @foreach($errors->all() as $msg)
      <div class="alert alert-danger">{{$msg}}</div>
      @endforeach
      
    
    <div class="mt-5 ms-5 col-md-12 ">
    
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-success mb-1 mt-3"><i class="fas fa-user-plus"></i> Add New</button>
        
        <form action="http://localhost/laravel_MyClassroom/public/submission" method="GET" class="col-md-9 mt-3">
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
                  <th scope="col">Nama Assignment</th>
                  <th scope="col">Nama Siswa</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              @php
              $counter = ($submission->currentPage() - 1) * $submission->perPage() + 1;
              @endphp
              @foreach ($submission as $index => $item)
              <tr>
                  <th scope="row">{{ $counter++ }}</th>
                  <td>{{ $item->assignment->title }}</td>
                  <td>{{ $item->user->name }}</td>
                  <td>
                    @php
                    $submissionScores = $score->where('submission_id', $item->id);
                    @endphp
                    @if ($submissionScores->isNotEmpty())
                        @foreach ($submissionScores as $submissionScore)
                            {{ $submissionScore->score }}
                        @endforeach
                    @else
                        Belum Dinilai
                    @endif
                  </td>
                  <td>
                      <a href="http://localhost/laravel_MyClassroom/public/submission/{{$item->id}}"
                          class="me-1 text-primary fw-bold text-decoration-none">Open</a>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      
    
          {{$submission->links()}}
    </div>
    </div>
    
    </x-layout>