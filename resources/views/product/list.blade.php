@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if($errors->any())
                        <div class="alert alert-danger" style="margin-top:25px">
                        {{$errors->first()}}
                        </div>
                    @endif
                    <h1 class="page-header">Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"><a href="{{url('create-product')}}" class="btn btn-primary">ADD NEW</a></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Product List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Category Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($product->count() > 0)
                                                     @foreach($product as $p)
                                                        <tr>
                                                           <td>{{ucwords($p->name)}}</td>
                                                           <td>{{$p->quantity}}</td>
                                                           <td>{{$p->price}}</td>
                                                           <td>{{ucwords($p->category->name)}}</td>
                                                           <td><a href="{{url('update-product/'.$p->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                           <a href="" data-id="{{$p->id}}" class="delete_button btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">No Data Found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function() {
    var table = $('#example').DataTable( {
     } );
} );

$(document).on('click', '.delete_button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this product!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // If user clicks on "Yes, delete it!" button
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{url('delete-product')}}",
                        data: {id:id},
                        success: function (data) {
                                location.reload();
                            }         
                    });
                    
                }
            });
});
</script>