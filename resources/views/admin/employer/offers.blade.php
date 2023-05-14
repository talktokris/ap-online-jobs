@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Employer Offers </h1>
    </div>
    <section class="section">
        {{-- {{$offers->employer}} --}}
        <table id="demands-table" class="table table-condensed">
            <thead>
                <tr>
                    <th >ID</th>
                    <th >Employer Name</th>
                    <th >Domestic Maid</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <td></td>
                        <td><a href="{{route('employer.public',$offer->employer->public_id)}}">{{$offer->employer->name}}</a></td>
                        <td>
                            @foreach ($offer->applicants as $applicant)
                                {{$applicant->gw_dm->name}} <a target="_blank" class="btn btn-xs btn-primary" href="{{route('profile.public', $applicant->gw_dm->public_id)}}">View Details</a> 
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
@section('javascript')

@endsection