@include('partials.header')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    @if($errors->any())
                        <div class="alert alert-danger" style="margin-top:25px">
                        {{$errors->first()}}
                        </div>
                    @endif
                    <h1 class="page-header">Add Product</h1>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Add & Edit Page
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{url('insert-update-product')}}" id="productform">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <label>Product Name</label>
                                        <input type="text" name="name" value="{{isset($product->name) ? $product->name:''}}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Price</label>
                                        <input type="number" step="any" name="price" value="{{isset($product->price) ? $product->price:''}}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Qty</label>
                                        <input type="number" min="0" name="quantity" value="{{isset($product->quantity) ? $product->quantity:''}}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Category Name</label>
                                        <select class="js-example-basic-single col-lg-12" name="category_id">
                                            <option value="">Please select Category</option>
                                            @if($category->count() > 0)
                                               @foreach($category as $c)
                                                <option value="{{$c->id}}" {{($product->category_id == $c->id) ? "selected":''}}>{{$c->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="hidden" name="id" value="{{isset($product->id) ? $product->id:''}}">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url('product')}}" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@include('partials.footer')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
      $(document).ready(function () {
        $('#productform').validate({
            rules: {
                name: {
                    required: true
                },
                price: {
                    required: true
                },
                quantity: {
                    required: true
                },
                category_id: {
                    required: true
                },
            }
        });
    });
</script>