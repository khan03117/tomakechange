@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="w-100 text-start">
                       <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                               <div class="col-md-3">
                                   <label for="">Upload Image</label>
                                   <input type="file" name="image"  class="form-control" />
                               </div>
                               <div class="col-md-3">
                                   <label for="">Enter Title</label>
                                   <input type="text" name="title"  class="form-control" />
                               </div>
                               <div class="col-md-3">
                                   <label for="">Select page</label>
                                  <select class="form-select" name="type">
                                      <option value="gallery">Gallery</option>
                                      <option value="foundation">Foundation</option>
                                  </select>
                               </div>
                               <div class="col-md-2">
                                   <label for="" class="d-block mb-2">Action</label>
                                   <input type="submit"  class="btn btn-sm w-100 btn-primary" />
                               </div>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered table-hover table-rep-plugin">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>page</th>
                                <th>Created At</th>
                                <th>is Shown</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <img src="{{$item->image}}" class="img-fluid" width="100">
                                    </td>
                                    <td>
                                        {{ $item['title'] }}
                                    </td>
                                    <td>
                                        {{ $item['type'] }}
                                    </td>
                                   
                                    <td>
                                        {{ date('d-M-Y h:i A', strtotime($item['created_at'])) }}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" onclick="changeviewgallery('{{$item->id}}')" id="flexSwitchCheckDefault" @checked($item['is_shown'] == "1")>
                                         
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <form action="{{route('gallery.destroy', $item->id)}}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->id}}" class="btn btn-primary btn-sm">
                                                Edit
                                            </button>
                                        </div>
                                        
                                                <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Gallery Update</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form action="{{route('gallery.update', $item->id)}}" enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group mb-4">
                                                                <label for="">Enter title</label>
                                                                <input type="text" value="{{$item->title}}" class="form-control" name="title" />
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label for="">Enter Image</label>
                                                                <input type="file" class="form-control" name="image" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Action</label>
                                                                <input type="submit" class="btn btn-primary w-100" />
                                                            </div>
                                                        </form>
                                                      </div>
                                                   
                                                    </div>
                                                  </div>
                                                </div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!!$items->links()!!}
                    <script>
                        const changeviewgallery = (id) => {
                            $.post("{{route('handlegalleryimage')}}", {id : id}, function(res){
                                console.log(res);
                            })
                        }
                    </script>
                   
                </div>
            </div>
        </div>
    </section>
@endsection
