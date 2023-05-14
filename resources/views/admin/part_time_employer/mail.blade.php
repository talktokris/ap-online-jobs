<style>
    .errors{
        color:red;
    }
</style>
@if(!empty($employer->email))
<div class="container" style="margin-top: -39px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form">         
                <div class="card-body">
                    <form method="POST" action="{{ route('sendmail', $employer->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row" style="margin-bottom: -13px;">
                            <div class="col-sm-12">
                                <label for="subject">Subject<span class="text-danger">*</span></label>
                                <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" placeholder="Subject Here" required>
                            </div>
                            @php
                            $mail_message="<p>Dear sir/madam</p>";  @endphp <br>
                            @php
                            $mail_message .="Thank you registration in onlinejobs";
                            @endphp
                            <div class="col-sm-12">
                                <label for="message">Message<span class="text-danger">*</span></label>
                            <textarea name="message" id="editor1" cols="30" rows="10" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" required>
                                Dear sir/madam<br />Thank you for registration in onlinejobs.Please find your login crendential:<br>Username:{{$employer->email}} <br>Password: DefPassEmp<br>link: http://onlinejobs.my <br>Regards,<br>Online Jobs Team
                            </textarea>
                            </div><hr>
                            <div class="col-sm-12 form-group mb-1">
                                <button type="submit" class="btn btn-warning btn-block">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div>This user does not have email.</div>
@endif

<script>
    CKEDITOR.replace( 'editor1' );
</script>

