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
                    <h1 class="page-header">Category</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div style="margin-bottom:20px;"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Category List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Category Name</th>
                                                <th>Parent Category</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($categories))
                                                <?php $_SESSION['i'] = 0; ?>
                                                @foreach($categories as $category)
                                                    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                                                    <tr>
                                                        <?php $dash=''; ?>
                                                        <td>{{$_SESSION['i']}}</td>
                                                        <td>{{ucwords($category->name)}}</td>
                                                        <td>
                                                            @if(isset($category->parent_id))
                                                                {{ucwords($category->subcategory->name)}}
                                                            @else
                                                                None
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="" data-id="{{$category->id}}" class="delete_button btn btn-danger btn-circle"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @if($category->children->count() > 0)
                                                        @include('category.subcategories',['subcategories' => $category->children])
                                                    @endif

                                                @endforeach
                                                <?php unset($_SESSION['i']); ?>
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
                        url: "{{url('delete-category')}}",
                        data: {id:id},
                        success: function (data) {
                                location.reload();
                            }         
                    });
                    
                }
            });
});
</script>