
<div class="top_bar">
    <div class="container">
        <div class="row">
            <nav class="nav nav-pills nav-fill navigation-menu">
                <a class="nav-item nav-link" href="#">GLC</a>
                <!-- <a class="nav-item nav-link" href="#">Govt. Jobs</a> -->
                <a class="nav-item nav-link" href="{{route('login')}}">Retired personnel</a>
                <a class="nav-item nav-link" href="#">International Jobs</a>
                <a class="nav-item nav-link" href="#modalLoginFormTwo" data-toggle="modal">Part Time Jobs</a>
                <a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#modal-1">Part Time Services</a>
                <a class="nav-item nav-link" href="{{route('gallery')}}">Gallery</a>
                <a class="nav-item nav-link" href="{{route('CadidateStatusView')}}">Application Status </a>
            </nav>
        </div><!--  /.row  -->
    </div><!--  /.container  -->
</div><!--  /.top_bar  -->

<div class="modal fade" id="modal-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Part time jobs and Nurses</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
          {{-- <a href="#modal-2" data-toggle="modal" data-dismiss="modal">Next ></a> --}}
          <span><input type="checkbox" value="1" name="radiobtn" id="maid_option1" onclick="lookingForMaid()"><label for="option1" style="margin-left: 20px;" >Maids</label><br></span>
          <span><input type="checkbox" value="1" name="radiobtn" id="driver_option2" onclick="lookingForDriver()"><label for="option2" style="margin-left: 20px;"> Driver</label><br></span>
          <span><input type="checkbox" value="1" name="radiobtn" id="nurses_option3" onclick="lookingForHomeNurse()"><label for="option3" style="margin-left: 20px;"> Home Nurse</label></span>
      </div>
      <div class="modal-footer">
        {{-- <a href="#modalLoginFormOne" type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" onClick='checkButton()'>Continue</a> --}}
        <a href="" type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" onClick='checkButton()'>Continue</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
