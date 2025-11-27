 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('livewire.admin.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Brand List</h6>
      <a href="{{route('brand.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Brand</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($brands)>0)
              <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->title}}</td>
                    <td>{{$brand->slug}}</td>
                    <td>
                        @if($brand->status=='active')
                            <span class="badge badge-success">{{$brand->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$brand->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
{{--                        <form method="POST" action="{{route('brand.destroy',[$brand->id])}}">--}}
{{--                          @csrf--}}
{{--                          @method('delete')--}}
{{--                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$brand->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>--}}
{{--                        </form>--}}
                        <button wire:click.prevent="destroy({{$brand->id}})" onclick="event.preventDefault(); deleteBrand({{$brand->id}}); return false;" class="btn btn-danger btn-sm dltBtn" data-id={{$brand->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>

                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$brands->links()}}</span>
        @else
          <h6 class="text-center">No brands found!!! Please create brand</h6>
        @endif
      </div>
    </div>
</div>

 @push('styles')
     <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
     <style>
         div.dataTables_wrapper div.dataTables_paginate{
             display: none;
         }
         .zoom {
             transition: transform .2s; /* Animation */
         }

         .zoom:hover {
             transform: scale(3.2);
         }
     </style>
 @endpush
 @push('scripts')

     <!-- Page level plugins -->
     <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

     <script>
         // Initialize DataTable only once
         let dataTableInstance = null;

         function initDataTable() {
             if ($('#banner-dataTable').length) {
                 // Destroy existing instance if any
                 if ($.fn.DataTable.isDataTable('#banner-dataTable')) {
                     $('#banner-dataTable').DataTable().destroy();
                     dataTableInstance = null;
                 }

                 if (!dataTableInstance) {
                     dataTableInstance = $('#banner-dataTable').DataTable( {
                         "columnDefs":[
                             {
                                 "orderable":false,
                                 "targets":[3,4]
                             }
                         ]
                     } );
                 }
             }
         }

         // Initialize on page load
         $(document).ready(function() {
             // Wait a bit to ensure DOM is ready
             setTimeout(function() {
                 initDataTable();
             }, 100);
         });

         // Prevent double initialization
         if (typeof Livewire !== 'undefined') {
             Livewire.hook('message.processed', (message, component) => {
                 // Don't re-initialize, DataTable handles updates automatically
             });
         }

         // Sweet alert for delete confirmation
         function deleteBrand(brandId) {
             swal({
                 title: "Are you sure?",
                 text: "Once deleted, you will not be able to recover this data!",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
                 .then((willDelete) => {
                     if (willDelete) {
                     @this.destroy(brandId);
                     } else {
                         swal("Your data is safe!");
                     }
                 });
         }
     </script>
 @endpush


{{--@endpush--}}
