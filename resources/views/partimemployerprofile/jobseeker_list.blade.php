@extends('partimemployerprofile.index')
@section('partimemployerprofiles')
<style>
    .backgroundcolor{
        background: #E05024
    }
    .btn-color-blue{
        background: #2176bd;
    }
    .btn-color-orange{
        background: #E05024
    }
    .form-control:focus {
        border-color: inherit;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .input-field{
        margin-left: -30px;
    }
    .btn-backgroundcolor-green{
        background: #85CE36;
    }

</style>
<div class="container-fluid">
    <form method="get" class="filter" action="{{route('jobseekerlist',$user_id)}}">
        <div class="row input-field">
            <div class="form-group col-sm-4">
                <select name="city" class="form-control">
                    <option value="" disable="true" selected="true">Select City</option>
                    @foreach($city as $k => $item)
                    <option value="{{ $item->id }}" @if(isset($_GET['city']) && $_GET['city'] == $item->id) selected  @endif >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <button type="submit" class="btn btn-xs btn-color-blue">Search</button>
                <a href="{{route('jobseekerlist',$user_id)}}" type="buttton" class="btn btn-color-orange btn-xs">Reset</a>
            </div>
        </div>
    </form>
  <div class="row">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" class="backgroundcolor">S.N</th>
            <th scope="col" class="backgroundcolor">Name</th>
            <th scope="col" class="backgroundcolor">Country</th>
            <th scope="col" class="backgroundcolor">State</th>
            <th scope="col" class="backgroundcolor">City</th>
            <th scope="col" class="backgroundcolor">Work As</th>
            <th scope="col" class="backgroundcolor">Action</th>
          </tr>
        </thead>
        <tbody>
        
        @if(!empty($job_seeker_list))
        <?php $count = ($job_seeker_list->currentpage()-1)*$job_seeker_list->perpage()+1; ?>
            @foreach ($job_seeker_list as $list)
                @if($pt_employer->state==$list->state)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{$list->user->name}}</td>
                    <td>{{$list->company_country_data->name}}</td>
                    <td>{{$list->company_state_data->name}}</td>
                    <td>{{$list->company_city_data->name}}</td>
                    @if($list->work_as=='1')
                    <td>Maid</td>
                    @elseif($list->work_as=='2')
                    <td>Driver</td>
                    @elseif($list->work_as=='3')
                    <td>Home Nurse</td>
                    @else
                    <td>No Data</td>
                    @endif
                    <td>
                    <a target="_blank" class="btn btn-xs btn-backgroundcolor-green" href="{{route('jobseekerdetail',$list->user->id)}}">View </a> 
                    </td>
                </tr>
                {{-- @else
                <td colspan="8">
                    No Record Found
                </td>--}}
                @endif 
            @endforeach
          @else
            <td colspan="8">
                No Records Found
            </td>
          @endif
        </tbody>
      </table>
      @if(!empty($job_seeker_list))
      <div class="pagination">
        {{ $job_seeker_list->links()}}
    </div>
    @endif
  </div>
</div>
@endsection
