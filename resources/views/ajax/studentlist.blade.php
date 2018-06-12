@foreach($contacts as $value)

<tr id="{{$value->id}}">
    <td>{{$value->id}}</td>
    <td>{{$value->cell_phone}}</td>
    <td>{{$value->email}}</td>
    <td>{{$value->created_at_shamsi}}</td>
    <td>{{$value->gender}}</td>
    <td>{{$value->username}}</td>
    <td>{{$value->family}}</td>
    <td>{{$value->name}}</td>








    <td>

            <a href="#" class="btn btn-info btn-sm" id="view" data-id="{{$value->id}}">تغییر رمز</a>
            <a href="#" class="btn btn-success btn-sm" id="edit" data-id="{{$value->id}}">ویرایش</a>
            <a href="#" class="btn btn-danger btn-sm" id="del" data-id="{{$value->id}}">حذف</a>

    </td>
</tr>

@endforeach