@foreach($data as $k=>$v)
    <tr @if($k%2==0) class="active" @else class='success' @endif>
      <td>{{$v->id}}</td>
      <td>{{$v->name}}</td>
      <td>{{$v->age}}</td> 
      <td>{{$v->card}}</td>
      <td>{{$v->head}}</td>
      <td>{{($v->is_hubei==1?'√':'×')}}</td> 
      <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width='66' height='66'>@endif</td> 
      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
      <td>  <a href="{{url('people/destroy'.$v->id)}}">删除</a> |
            <a href="{{url('people/edit'.$v->id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
    <tr><td colspan='7'>{{$data->appends(['name' =>$name])->links()}}</td></tr>