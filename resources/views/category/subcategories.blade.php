<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1;
    ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>{{$dash}}{{ucwords($subcategory->name)}}</td>
        <td>{{ucwords($subcategory->parent->name)}}</td>
        <td><a href="" data-id="{{$subcategory->id}}" class="delete_button btn btn-danger btn-circle"><i class="fa fa-trash"></i></a></td>
    </tr>
    @if ($subcategory->children->count() > 0)
            @include('category.subcategories', ['subcategories' => $subcategory->children])
    @endif
@endforeach